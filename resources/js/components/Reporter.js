import React, { Component } from 'react';

// Este es el componente principal del reporter
class Reporter extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Bienvenido al reporter</div>

                            <div className="card-body">
                                Reporteador
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Reporter;