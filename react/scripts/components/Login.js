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

  authenticate(provider) {
    console.log("Trying to auth with " + provider);
    ref.authWithOAuthPopup(provider, this.authHandler);
  }

  componentWillMount() {
    console.log("Checking to see if we can log them in");
    var token = localStorage.getItem('token');
    if(token) {
      ref.authWithCustomToken(token,this.authHandler);
    }
  }

  logout() {
    ref.unauth();
    localStorage.removeItem('token');
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
    localStorage.setItem('token',authData.token);

    const storeRef = 'users';

    storeRef.on('value', (snapshot)=> {
      var data = snapshot.val() || {};

      // claim it as our own if there is no owner already
      if(!data.owner) {
        storeRef.set({
          owner : authData.uid
        });
      }

      // update our state to reflect the current store owner and user
      this.setState({
        uid : authData.uid,
        owner : data.owner || authData.uid
      });

    });
  }

  renderLogin() {
    return (
      <nav className="login">
        <button className="facebook"onClick={this.authenticate.bind(this, 'facebook')} >Log In with Facebook</button>
        <button className="twitter"onClick={this.authenticate.bind(this, 'twitter')} >Log In with Twitter</button>
      </nav>
    )
  }


  render() {
    let logoutButton = <button onClick={this.logout}>Log Out!</button>

    // first check if they arent logged in
    if(!this.state.uid) {
      return (
        <div>{this.renderLogin()}</div>
      )
    }

    // then check if they arent the owner of the current store
    if(this.state.uid !== this.state.owner) {
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
