import React, { Component } from 'react';

class Header extends Component {
    constructor(props) {
        super(props);

        this.state = {
            meses: [[1,"Enero"], [2,"Febrero"], [3,"Marzo"], [4,"Abril"], [5,"Mayo"], [6,"Junio"], [7,"Julio"], [8,"Agosto"], [9,"Septiembre"],
                [10,"Octubre"], [11,"Noviembre"], [12,"Diciembre"]],
            mesElegido: 1,
            tipoReporte: [[1, "Reporte de Eventos por tipo de incidente"], [2, "Incidentes por áreas o proyectos"],
                        [3, "Tiempo de respuesta por tipo de evento"], [4,"Tiempo de resupesta por departamento"],
                        [5, "Inventario de equipos de computo e impresoras"], [6, "Inventario de equipos de computo por área o proyecto"]],
            tipoReporteElegido: 1
        }
    }

    onMesChange(event) {
        this.setState({
            mesElegido: event.target.value
        })
    }

    onTipoReporteChange(event) {
        this.setState({
            tipoReporteElegido: event.target.value
        })
    }

    render() {
        return (
                <div className="row justify-content-center">
                    <div className="col-md-10">
                        <div className="card">
                            <div className="card-header"><h3>Fusion Reporter</h3></div>
                            <div className="card-body">
                                Seleccionar el mes:<br/>
                                {
                                    this.state.meses.map(([index, mes], i) => (
                                        <div className="form-check-inline" key={ i }>
                                            <label className="form-check-label">
                                            <input  className="form-check-input"
                                                    type="radio"
                                                   checked={ parseInt(this.state.mesElegido) === index }
                                                   onChange={ event => this.onMesChange(event) }
                                                   value={ index }
                                            />
                                            { mes }
                                            </label>
                                        </div>
                                    ))
                                }

                                <p>El mes seleccionado es: { (this.state.meses[this.state.mesElegido-1])[1] }</p>

                                Seleccionar el tipo de reporte:<br/>
                                {
                                    this.state.tipoReporte.map(([index, tipo], i) => (
                                        <div className="form-check" key={ i }>
                                            <label className="form-check-label">
                                                <input  className="form-check-input"
                                                        type="radio"
                                                        checked={ parseInt(this.state.tipoReporteElegido) === index }
                                                        onChange={ event => this.onTipoReporteChange(event) }
                                                        value={ index }
                                                />
                                                { tipo }
                                            </label>
                                        </div>
                                    ))
                                }

                                <p>El tipo de reporte seleccionado es: { (this.state.tipoReporte[this.state.tipoReporteElegido-1])[1] }</p>
                            </div>
                        </div>
                    </div>
                </div>
        );
    }
}

export default Header;