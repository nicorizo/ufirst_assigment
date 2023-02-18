import React from 'react';
import Card from 'react-bootstrap/Card';
import {Col, Row} from "react-bootstrap";
import {Bar, BarChart, CartesianGrid, Legend, Tooltip, XAxis, YAxis} from "recharts";

const Graph = ({title, data}) => {
    return (
        <Row className={'mb-3'}>
            <Col>
                <Card className={'text-center'}>
                    <Card.Title className={'my-3'}>{title}</Card.Title>
                    <Card.Body className={'d-flex justify-content-center'}>
                        <BarChart width={730} height={250} data={data}>
                            <CartesianGrid strokeDasharray="3 3"/>
                            <XAxis dataKey="name"/>
                            <YAxis/>
                            <Tooltip/>
                            <Legend/>
                            <Bar dataKey="amount" fill="#82ca9d"/>
                        </BarChart>
                    </Card.Body>
                </Card>
            </Col>
        </Row>
    );
}

export default Graph;