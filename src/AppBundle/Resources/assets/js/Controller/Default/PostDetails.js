import React from 'react'
import Layout from 'Layout/Layout'

class ControllerDefaultPostDetails extends React.Component {
    constructor(props) {
        super(props);

        if (controllerOutput && controllerOutput.posts) {
            for (var i in controllerOutput.posts) {
                var post = controllerOutput.posts[i];

                if (post.id == props.match.params.postId) {
                    this.state.post     = post;
                    this.state.comments = null;
                    break;
                }
            }
        } else if (controllerOutput && controllerOutput.post) {
            this.state = controllerOutput;
        }
    }

    render() {
        return <Layout>
            <div className="container">
                {this.props.name}
            </div>
        </Layout>
    }
}

module.exports = ControllerDefaultPostDetails