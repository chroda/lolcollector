import React from 'react';

const NavBar = ({ fixed, inverse, children }) => (
  <nav className={`navbar ${fixed ? `navbar-fixed-${fixed}` : ''} navbar-${inverse ? `inverse` : 'default'}`}>
    {children}
  </nav>
);

NavBar.propTypes = {
  fixed: React.PropTypes.oneOf(['top', 'bottom']),
  inverse: React.PropTypes.bool
};

export default NavBar;
