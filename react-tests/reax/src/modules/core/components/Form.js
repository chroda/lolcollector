import React from 'react';

const Form = ({
  onSubmit,
  children
}) => (
  <form noValidate onSubmit={event => {
    event.preventDefault();
    if (onSubmit) {
      onSubmit();
    }
  }}>
    {children}
  </form>
);

Container.propTypes = {
  onSubmit: React.PropTypes.func
};

export default Form;
