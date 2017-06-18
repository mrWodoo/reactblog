import React from 'react'
import Layout from 'Layout/Layout'
import { Parallax } from 'react-parallax';
import DateHelper from 'Helper/Date'
import { Breadcrumb, MenuItem } from 'react-materialize'
import { Link } from 'react-router-dom'

require('postDetails.scss')

class ControllerDefaultPostDetails extends React.Component {
    constructor(props) {
        super(props);

        if (controllerOutput && controllerOutput.posts) {
            for (var i in controllerOutput.posts) {
                var post = controllerOutput.posts[i];

                if (parseInt(post.id) === parseInt(props.match.params.postId)) {
                    this.state = {
                        post: post
                    };
                    break;
                }
            }
        } else if (controllerOutput && controllerOutput.post) {
            this.state = controllerOutput
        }
    }

    render() {
        return <Layout>
            <Parallax bgImage={this.state.post.image} strength={400} bgHeight="800">
                <div className="container">
                    <h1 className="post--title">{this.state.post.title}</h1>
                </div>
            </Parallax>

            <div className="container">
                <Breadcrumb>
                    <MenuItem><Link to="/">strona główna</Link></MenuItem>
                    <MenuItem>{this.state.post.title}</MenuItem>
                </Breadcrumb>

                <div>Napisano <DateHelper timestamp={this.state.post.createdAtTimestamp}/></div>

                {this.state.post.content}
            </div>
        </Layout>
    }
}

module.exports = ControllerDefaultPostDetails