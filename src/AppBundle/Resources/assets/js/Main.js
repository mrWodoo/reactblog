import React from 'react'
import ControllerDefaulIndex from 'Controller/Default/Index'
import ControllerDefaultPostDetails from 'Controller/Default/PostDetails'
import { BrowserRouter, Switch, Route } from 'react-router-dom'


class Main extends React.Component {
    render() {
        return <Switch>
            <Route exact path='/' component={ControllerDefaulIndex}/>
            <Route path='/page/:page' component={ControllerDefaulIndex}/>
            <Route path='/post/:postId' component={ControllerDefaultPostDetails}/>
        </Switch>
    }
}

module.exports = Main