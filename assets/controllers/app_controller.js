import {Controller} from '@hotwired/stimulus';
import React from "react";
import App from "../App/App";
import {createRoot} from 'react-dom/client';


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="app" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        const root = createRoot(this.element); // createRoot(container!) if you use TypeScript
        root.render(<App/>);
    }
}
