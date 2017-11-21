import React from 'react';

const Button = ({
  type,
  submit,
  block,
  onClick,
  children
}) => (
  <button
    className={`btn btn-${type} ${block ? 'btn-block' : ''}`}
    type={submit ? 'submit' : 'button'}
    onClick={onClick}>
    {children}
  </button>
);

Button.propTypes = {
  type: React.PropTypes.oneOf([
    'default',
    'primary',
    'success',
    'info',
    'warning',
    'danger'
  ]),
  submit: React.PropTypes.bool,
  block: React.PropTypes.bool,
  onClick: React.PropTypes.func
};

Button.defaultProps = {
  type: 'default'
};

export default Button;
