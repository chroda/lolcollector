import React from 'react';

const Alert = ({
  type,
  children
}) => (
  <div className={`alert alert-${type}`}>
    {children}
  </div>
);

Alert.propTypes = {
  type: React.PropTypes.oneOf([
    'success',
    'info',
    'warning',
    'danger'
  ]).isRequired
};

export default Alert;
