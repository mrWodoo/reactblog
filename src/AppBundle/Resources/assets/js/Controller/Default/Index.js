import React from 'react'
import SimplifiedPost from 'Post/SimplifiedPost'
import Layout from 'Layout/Layout'
import { Pagination, Preloader } from 'react-materialize'

require('preloader.scss')

class ControllerDefaultIndex extends React.Component {
    constructor(props) {
        super(props);

        this.state = {}
        this.handlePaginationGoTo = this.handlePaginationGoTo.bind(this);
    }

    componentDidMount() {
        if (controllerOutput && controllerOutput.posts) {
            this.setState(controllerOutput)
        } else {
            let that = this;
            this.setState({
                loading: true
            });

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
    }

    handlePaginationGoTo(page) {
        if (page < 1) {
            page = 1;
        }

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

                this.props.history.push('/page/' + page)
            })
            .catch(function(error) {
                //@TODO handle error
                that.setState({
                    loading: false
                });
            });
    }

    render() {
        console.log(this.state)
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
                    image={post.image}
                    createdAt={post.createdAtTimestamp}/>
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