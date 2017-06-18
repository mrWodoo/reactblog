import React from 'react';
import PropTypes from 'prop-types'

class DateHelper extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            timestamp       : props.timestamp,
            startTimestamp  : controllerOutput.time
        };
    }

    componentDidMount() {
        let that = this;
        this.interval = setInterval(function() {
            that.setState((prevState) => ({
                startTimestamp: prevState.startTimestamp + that.props.updateInterval
            }))
        }, that.props.updateInterval * 1000);
    }

    componentWillUnmount() {
        clearInterval(this.interval)
    }

    render() {
        let dateOutput = null;
        let diff = this.state.startTimestamp - this.state.timestamp;

        if (diff < 60) {
            dateOutput = 'Mniej niż minutę temu'
        } else if (diff >= 60 && diff < 60 * 5) {
            dateOutput = 'Chwilę temu'
        } else {
            const dateObject = new Date(this.state.timestamp * 1000);
            dateOutput = dateObject.getFullYear() +
                '-' + ((dateObject.getMonth() < 10) ? 0 : '') + dateObject.getMonth() +
                '-' + ((dateObject.getDay() < 10) ? 0 : '') + dateObject.getDay() +
                ' ' + ((dateObject.getHours() < 10) ? 0 : '') + dateObject.getHours() +
                ':' + ((dateObject.getMinutes() < 10) ? 0 : '') + dateObject.getMinutes()
        }

        return <span>{dateOutput}</span>
    }
}

DateHelper.propTypes = {
    timestamp       : PropTypes.number.isRequired,
    updateInterval  : PropTypes.number
};

DateHelper.defaultProps = {
    updateInterval: 1
};

module.exports = DateHelper