import React from 'react';

const FormGroup = ({
  hasSuccess,
  hasWarning,
  hasError,
  children
}) => (
  <div className={`
      form-group
      ${hasSuccess ? 'has-success' : ''}
      ${hasWarning ? 'has-warning' : ''}
      ${hasError ? 'has-error' : ''}
  `}>
    {children}
  </div>
);

FormGroup.propTypes = {
  hasSuccess: React.PropTypes.bool,
  hasWarning: React.PropTypes.bool,
  hasError: React.PropTypes.bool
};

export default FormGroup;
