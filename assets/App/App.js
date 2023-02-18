import React, {useState, useEffect} from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Graph from "./components/Graph";
import {Container} from "react-bootstrap";
import {parseDataToGraph} from "./Util/Util";
import Main from "./components/Main";



function App(props) {
    const [graphics, setGraphics] = useState([]);

    useEffect(() => {
        //'Http Method Distribution'
        fetch('/get_request_http_method_distribution')
            .then(response => response.json())
            .then(distribution => {
                    const data = {
                        title: 'Http Method Distribution',
                        data: parseDataToGraph(distribution.distribution)
                    };
                    setGraphics(prevState => [...prevState, data]);
                }
            );

        //'Http Code Distribution'
        fetch('/get_response_http_code_distribution')
            .then(response => response.json())
            .then(distribution => {
                    const data = {
                        title: 'Http Code Distribution',
                        data: parseDataToGraph(distribution.distribution)
                    };
                    setGraphics(prevState => [...prevState, data]);
                }
            );
        //Response 200 Code and Size < 1000 Distribution
        fetch('/log_get_response_by_code_and_size_distribution')
            .then(response => response.json())
            .then(distribution => {
                    const data = {
                        title: 'Response 200 Code and Size < 1000 Distribution',
                        data: parseDataToGraph(distribution.distribution)
                    };
                    setGraphics(prevState => [...prevState, data]);
                }
            );
        //Request per Minute
        fetch('/log_get_request_per_minute')
            .then(response => response.json())
            .then(distribution => {
                    const data = {
                        title: 'Request per Minute',
                        data: parseDataToGraph(distribution.distribution)
                    };
                    setGraphics(prevState => [...prevState, data]);
                }
            );
    }, []);

    return <Main appTitle={'Server APP'} graphics={graphics}/>
}

export default App;
