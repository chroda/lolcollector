import React from 'react';

const Container = ({ fluid, children }) => (
  <div className={`container${fluid ? '-fluid' : ''}`} style={{paddingTop:70,paddingBottom:70}}>
    {children}
  </div>
);

Container.propTypes = {
  fluid: React.PropTypes.bool
};

export default Container;
