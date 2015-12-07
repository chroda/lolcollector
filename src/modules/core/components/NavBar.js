import React from 'react';

const NavBar = ({ fixed, inverse, children }) => (
  <div className={`navbar ${fixed ? `navbar-fixed-${fixed}` : ''} navbar-${inverse ? `inverse` : 'default'}`}>
    {children}
  </div>
);

NavBar.propTypes = {
  fixed: React.PropTypes.oneOf(['top', 'bottom']),
  inverse: React.PropTypes.bool
};

export default NavBar;
