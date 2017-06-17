import React from 'react'
import SimplifiedPost from 'Post/SimplifiedPost'
import Layout from 'Layout/Layout'

class ControllerDefaultIndex extends React.Component {
    constructor(props) {
        super(props);
        this.state = controllerOutput;
    }

    render() {
        const posts = this.state.posts.map((post) =>
            <SimplifiedPost
                key={post.id}
                id={post.id}
                title={post.title}
                shortContent={post.shortContent}
                image={post.image} />
        );

        return <Layout>
            <div className="container">
                {posts}
            </div>
        </Layout>;
    }
}

module.exports = ControllerDefaultIndex