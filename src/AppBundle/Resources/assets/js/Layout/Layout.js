import React from 'react'
import {Navbar, NavItem, Icon} from 'react-materialize'

class Layout extends React.Component {
    constructor(props) {
        super(props);
        this.state = controllerOutput;
    }

    render() {
        return <div>
            <Navbar brand="ReactJS.blog" right>
                <NavItem href='get-started.html'><Icon>search</Icon></NavItem>
            </Navbar>

            {this.props.children}
        </div>
    }
}

module.exports = Layout;