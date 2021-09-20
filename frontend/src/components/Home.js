import React from 'react';
import { withRouter } from "react-router-dom";
import {
  Col,
  Button,
  Form,
  FormGroup,
  Label,
  Input,
  Row,Card,
  CardBody
} from "reactstrap";

import { Link } from "react-router-dom";
import Config from '../config/config';
const axios = require('axios').default;

class Home extends React.Component {
  constructor(props) {
      super(props);
      this.state = {
          isLoading: false,
          expression: '',
          expressionState: false,
          errorMessage: '',
      };
      this.handleChange = this.handleChange.bind(this);
      
  }
  
  handleChange(event) {
    this.setState({value: event.target.value});
  }
  
    verifyLength = (value, length) => {
        if (value.length >= length) {
            return true;
        }
        return false;
    };
    // function that verifies if value contains only numbers
    verifyNumber = value => {
        var numberRex = new RegExp("^[0-9]+$");
        if (numberRex.test(value)) {
            return true;
        }
        return false;
    };

    change = (event, stateName, type, stateNameEqualTo, maxValue) => {
        switch (type) {
            case "length":
                if (this.verifyLength(event.target.value, stateNameEqualTo)) {
                    this.setState({ [stateName + "State"]: "has-success" });
                } else {
                    this.setState({ [stateName + "State"]: "has-danger" });
                }

                break;
            case "number":
                if (this.verifyNumber(event.target.value, stateNameEqualTo)) {
                    this.setState({ [stateName + "State"]: "has-success" });
                } else {
                    this.setState({ [stateName + "State"]: "has-danger" });
                }
                break;
            default:
                break;
        }
        this.setState({ [stateName]: event.target.value });
    };
    
  validateForm() {
    var valid = true;
    if (this.state.expression === "") {
      this.setState({ expressionState: "has-danger" });
      valid = false;
    }
   
    return valid;
  }
  
  async handleSubmit(event) {
      //validation goes here
    if(this.validateForm()) {
        const {
            expression
        } = this.state;
       await this.calculateExpression({
          expression: expression,
       });
    }
  }
  
  async calculateExpression(data) {

    axios({
      method: 'post',
      url: Config.POST_URL + '/calculator/run.php/Calculator/cal_expression_app',
      data: data,
      headers: {
         'Content-Type': 'application/json'
      }, 
    }).then( response => {
        if (response.data) {
             console.log(response.data);
             // now show success/errormessage in the DOM
        }
    } ).catch( ( error ) => {
        console.log( error );
        //// now show errormessage in the DOM
    } )
    

  }

  render() {
      
  return (
  <>
        <div className="content">
          <Col md={8} className="ml-auto mr-auto">
            <h2 className="text-center">Math Expression</h2>
          </Col>

          <Row className="mt-5">
            <Col xs={12} md={12}>
              <Card>
                <CardBody>

                  <Form>
                    <FormGroup row>
                      <Label for="name" sm={2}>
                         Expression
                      </Label>
                      <Col sm={10}>
                        <Input
                          type="text"
                          name="expression"
                          id="expression"
                          placeholder="expression"
                          onChange={e => this.change(e, "expression", "length", 3)}
                        />
                        {this.state.nameState === "has-danger" ? (
                           <label className="error">This field is required.</label>
                        ) : null}
                      </Col>
                    </FormGroup>

                    <FormGroup check row>
                      <Col sm={{ size: 12, offset: 2 }}>
                        <Button color="primary" onClick={() => this.handleSubmit()} >Calculate</Button> &nbsp;
                        <Link to='/'>
                            <Button color="primary" >Cancel</Button>
                        </Link>
                      </Col>
                    </FormGroup>
                  </Form>
                </CardBody>
              </Card>
            </Col>
          </Row>
        </div>
    </>
  );
  }
}
 
export default withRouter(Home);
