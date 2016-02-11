import React, { PropTypes } from 'react';
import Container from '@hnordt/reax-container';

const App = ({ children }) => <Container>{children}</Container>;

App.propTypes = {
  children: PropTypes.node.isRequired
};

export default App;
