import React from 'react';

const Container = ({
  fluid,
  children
}) => (
  <div className={`container${fluid ? '-fluid' : ''}`}>
    {children}
  </div>
);

Container.propTypes = {
  fluid: React.PropTypes.bool
};

export default Container;
