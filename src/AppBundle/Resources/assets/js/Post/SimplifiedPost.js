import React from 'react'
import {Card, CardTitle} from 'react-materialize'
import { Link } from 'react-router-dom'

class SimplifiedPost extends React.Component {
    render() {
        return <Card
            key={this.props.id}
            className='small'
            header={<CardTitle image={this.props.image}>{this.props.title}</CardTitle>}
            actions={[<Link to={'/post/' + this.props.id}>{this.props.title}</Link>]}>

            {this.props.shortContent}
        </Card>
    }
}

module.exports = SimplifiedPost;