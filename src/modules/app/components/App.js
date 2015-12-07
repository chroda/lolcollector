import React from 'react';
import { Link } from 'react-router';
import NavBar from '../../core/components/NavBar.js';
import Container from './Container.js';

const App = ({ children }) => (
  <div>
    <NavBar fixed='top'>
      <div className="navbar-header">
        <div className="navbar-brand">
          LoLCollector
        </div>
      </div>
      <ul className="nav navbar-nav">
        <li><Link activeClassName="active" to="/clientes">Clientes</Link></li>
        <li><Link activeClassName="active" to="/produtos">Produtos</Link></li>
      </ul>
    </NavBar>
    <Container fixed='both'>
      {children}
    </Container>
    <NavBar fixed='bottom' inverse />
  </div>
);

export default App;
