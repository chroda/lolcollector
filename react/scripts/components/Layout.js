import React from 'react';

import Login from './Login';

const App = ({ children }) => (
  <div>
    <nav className="navbar navbar-default navbar-fixed-top">
      <div className="navbar-header">
        <div className="navbar-brand">
          LoLCollector
        </div>
      </div>
      <ul className="nav navbar-nav">
        <li><a href="./projects" target="_self">projects</a></li>
        <li>
          <Login />
        </li>
      </ul>
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

export default App;
