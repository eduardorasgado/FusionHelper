import React, { Component } from 'react';
import ReactDOM from "react-dom";
import Reporter from "./Reporter";

// Cargando el componente principal del reporter
// usando react dom
if (document.getElementById('reporter')) {
    ReactDOM.render(<Reporter />, document.getElementById('reporter'));
}
