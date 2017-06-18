import React from 'react'
import SimplifiedPost from 'Post/SimplifiedPost'
import Layout from 'Layout/Layout'
import { Pagination, Preloader } from 'react-materialize'
import { Route, Redirect } from 'react-router-dom'

require('preloader.scss')

class ControllerDefaultIndex extends React.Component {
    constructor(props) {
        super(props);

        if (controllerOutput && controllerOutput.posts) {
            this.state = controllerOutput;
        } else {
            let that = this;
            that.state = {
                loading: true
            };

            // Fetch posts for page
            fetch('/api/index/fetchPosts/1')
                .then(function(response){
                    return response.json()
                })
                .then(function(data) {
                    that.setState({
                        posts   : data.posts,
                        loading : false,
                    });
                })
                .catch(function(error) {
                    //@TODO handle error
                    that.setState({
                        loading: false
                    });
                });
        }


        this.handlePaginationGoTo = this.handlePaginationGoTo.bind(this);
    }

    handlePaginationGoTo(page) {
        if (page < 1) {
            page = 1;
        }

        this.props.history.push('/page/' + page)

        this.setState((prevState) => ({
            loading     : true
        }));

        const that = this;

        // Fetch posts for page
        fetch('/api/index/fetchPosts/' + page)
            .then(function(response){
                return response.json()
            })
            .then(function(data) {
                that.setState((prevState) => ({
                    posts   : data.posts,
                    loading : false,
                    pagination  : {
                        currentPage : page,
                        pages       : prevState.pagination.pages
                    },
                }));
            })
            .catch(function(error) {
                //@TODO handle error
                that.setState({
                    loading: false
                });
            });
    }

    render() {
        let preloader = null

        if (this.state.loading) {
            preloader = <div className="preloader-container">
                <div className="preloader">
                    <span className="preloader--loader"><Preloader size='big'/></span>
                    <span className="preloader--text">Wczytywanie zawartości...</span>
                </div>
            </div>
        }



        let posts = null;

        if (this.state.posts) {
            posts = this.state.posts.map((post) =>
                <SimplifiedPost
                    key={post.id}
                    id={post.id}
                    title={post.title}
                    shortContent={post.shortContent}
                    image={post.image} />
            );
        }

        let pagination = null;

        if (this.state.pagination && this.state.pagination.pages > 1) {
            pagination = <Pagination
                items={this.state.pagination.pages}
                activePage={this.state.pagination.currentPage}
                maxButtons={5}
                onSelect={this.handlePaginationGoTo}/>
        }

        return <Layout>
            <div className="container">
                {preloader}
                {posts}
                {pagination}
            </div>
        </Layout>;
    }
}

module.exports = ControllerDefaultIndex