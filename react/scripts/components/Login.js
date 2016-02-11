/*
  Login
  <Login/>
*/

import React from 'react';
import autobind from 'autobind-decorator';
import Firebase from 'firebase';
const ref = new Firebase('https://lolcollector.firebaseio.com/');

@autobind
class Login extends React.Component {
  constructor() {
    super();

    this.state = {
      uid : ''
    }
  }

  componentWillMount() {
    var token = localStorage.getItem('lolcollector_usersession');

  }

  authenticate(provider) {
    ref.authWithOAuthPopup(provider, this.authHandler);
  }



  logout() {
    ref.unauth();
    localStorage.removeItem('lolcollector_usersession');
    this.setState({
      uid : null
    });
  }

  authHandler(err, authData) {
    if(err) {
      console.error(err);
      return;
    }

    // save the login token in the browser
    localStorage.setItem('lolcollector_usersession',authData.token);

      var data = {};

      // claim it as our own if there is no owner already
      if(!data.user) {
        ref.set({
          users : { user : authData.uid }
        });
      }

      // update our state to reflect the current store owner and user
      this.setState({
        uid : authData.uid,
        user : data.user || authData.uid
      });

  }

  render() {
    let loginButton = <button className="btn btn-primary navbar-btn" onClick={this.authenticate.bind(this, 'facebook')} >Log In with Facebook</button>;
    let logoutButton = <button className="btn btn-danger navbar-btn" onClick={this.logout}>Log Out!</button>;

    // first check if they arent logged in
    var token = localStorage.getItem('lolcollector_usersession');
    if(!token) {
      return (
        <div>{loginButton}</div>
      )
    }

    // then check if they arent the owner of the current store
    if(this.state.uid !== this.state.user) {
      console.log(this.state)
      console.log(this)
      return (
        <div>
          <p>Sorry, you aren't the owner of this store</p>
          {logoutButton}
        </div>
      )
    }

    return (
      <div>
        {logoutButton}
      </div>
    )
  }
};

export default Login;
