import React, {useState, useEffect} from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import {parseDataToGraph} from "./Util/Util";
import Main from "./components/Main";
import fileData from '../../public/files/data/epa-http.json'

function AppStatic(props) {
    const [graphics, setGraphics] = useState([]);

    useEffect(() => {
        if (fileData.length) {
            //'Http Method Distribution'
            setGraphics(prevState => [...prevState, httpMethodDistributionGraphData(fileData)]);
            //'Http Code Distribution'
            setGraphics(prevState => [...prevState, httpCodeDistributionGraphData(fileData)]);
            //Response 200 Code and Size < 1000 Distribution
            setGraphics(prevState => [...prevState, responseBySizeAndCodeGraphData(fileData)]);
            //Request per Minute
            setGraphics(prevState => [...prevState, requestPerMinuteGraphData(fileData)]);
        }
    }, [fileData]);

    return <Main graphics={graphics} appTitle={'Static APP'}/>

}


const httpMethodDistributionGraphData = (fileData) => {
    let distribution = {};
    for (let logEntry of fileData) {
        const key = logEntry.request.method;
        distribution[key] = distribution[key] !== undefined && distribution[key] + 1 || 1;
    }
    return {
        title: 'Http Method Distribution',
        data: parseDataToGraph(distribution)
    };
}

const httpCodeDistributionGraphData = (fileData) => {
    let distribution = {};
    for (let logEntry of fileData) {
        const key = logEntry.response_code;
        distribution[key] = distribution[key] !== undefined && distribution[key] + 1 || 1;
    }
    return {
        title: 'Http Method Distribution',
        data: parseDataToGraph(distribution)
    };
}

const responseBySizeAndCodeGraphData = (fileData) => {
    let distribution = {};
    for (let logEntry of fileData) {
        if (!(parseInt(logEntry.document_size) > 1000 || parseInt(logEntry.response_code) !== 200)) {
            const key = logEntry.document_size;
            distribution[key] = distribution[key] !== undefined && distribution[key] + 1 || 1;
        }
    }
    return {
        title: 'Response 200 Code and Size < 1000 Distribution',
        data: parseDataToGraph(distribution)
    };
}

const requestPerMinuteGraphData = (fileData) => {
    let distribution = {};
    for (let logEntry of fileData) {
        const key = logEntry.datetime.hour + ':' + logEntry.datetime.minute;
        distribution[key] = distribution[key] !== undefined && distribution[key] + 1 || 1;
    }
    return {
        title: 'Request per Minute',
        data: parseDataToGraph(distribution)
    };
}

export default AppStatic;
