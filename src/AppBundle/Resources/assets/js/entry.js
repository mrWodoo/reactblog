import React from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Switch, Route, withRouter } from 'react-router-dom'
import Main from 'Main'

class App extends React.Component {
    render() {
        return <Main />
    }
}

ReactDOM.render((
    <BrowserRouter>
        <App />
    </BrowserRouter>
), document.getElementById('root'))