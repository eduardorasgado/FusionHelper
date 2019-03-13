import React, { Component } from 'react';

class Header extends Component {
    constructor(props) {
        super(props)

        this.state = {
            meses: [[1,"Enero"], [2,"Febrero"], [3,"Marzo"], [4,"Abril"], [5,"Mayo"], [6,"Junio"], [7,"Julio"], [8,"Agosto"], [9,"Septiembre"],
                [10,"Octubre"], [11,"Noviembre"], [12,"Diciembre"]],
            mesElegido: null
        }
    }

    onMesChange(event) {
        this.setState({
            mesElegido: event.target.value
        })
    }

    render() {
        return (
                <div className="row justify-content-center">
                    <div className="col-md-10">
                        <div className="card">
                            <div className="card-header"><h3>Fusion Reporter</h3></div>
                            <div className="card-body">
                                {
                                    this.state.meses.map(([index, mes], i) => (
                                        <div key={ i }>
                                            <input type="radio"
                                                   checked={ parseInt(this.state.mesElegido) === index }
                                                   onChange={ event => this.onMesChange(event) }
                                                   value={ index } />
                                            { mes }
                                        </div>
                                    ))
                                }
                            </div>
                        </div>
                    </div>
                </div>
        );
    }
}

export default Header;