import React, { Component } from 'react';
import Header from './Header';

// Este es el componente principal del reporter
class Reporter extends Component {
    constructor(props) {
        super(props);
        this.state = {
            numero: 0,
        }
    }

    componentDidMount() {
        this.interval = setInterval(() => {
            this.setState({
                numero: this.state.numero + 1
            })
        }, 1000);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    render() {
        return (
            <div>
                <Header/>
            </div>
        );
    }
}

export default Reporter;