import React from 'react';

import Login from './Login';

const Layout = ({ children }) => (
  <div>

    <nav className="navbar navbar-default navbar-fixed-top">
      <div className="container-fluid">
        <div className="navbar-header">
          <a className="navbar-brand" href="/">LoLCollector</a>
        </div>
        <ul className="nav navbar-nav">
          <li className="active"><a href="/">Link 1</a></li>
        </ul>
        <ul className="nav navbar-nav navbar-right">
          <li>
            <Login />
          </li>
        </ul>
      </div>
    </nav>
    <div className="container-fluid">
      {children}
    </div>
    <nav className="navbar navbar-fixed-bottom navbar-inverse">
      <div className="container-fluid">
        <div className="collapse navbar-collapse">
          <ul className="nav navbar-nav navbar-right">
            <li><a href="http://chroda.com.br" target="_blank">Made with love by chroda</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
);

export default Layout;
