import React from 'react';
import {Col, Container, Row} from "react-bootstrap";
import Graph from "./Graph";
import Card from "react-bootstrap/Card";

const Main = ({graphics, appTitle}) => {
    return (
        !graphics.length ? <Container className={'text-center mt-5'}><h1>Loading...</h1></Container> :
            <Container className={'mt-5'}>
                <Row className={'mb-3'}>
                    <Col>
                        <Card.Title className={'text-center my-5'}>{appTitle}</Card.Title>
                    </Col>
                </Row>
                {
                    graphics.map((graph, key) => (
                        <Graph data={graph.data} title={graph.title} key={key}/>
                    ))
                }
            </Container>
    );
}
export default Main;