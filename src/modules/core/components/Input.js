import React from 'react';

const Input = props => {
  const input = <input {...props} className="form-control" />;
  if (props.leftAddon || props.rightAddon) {
    return (
      <div className="input-group">
        {props.leftAddon && (
          <span className="input-group-addon">
            {props.leftAddon}
          </span>
        )}
        {input}
        {props.rightAddon && (
          <span className="input-group-addon">
            {props.rightAddon}
          </span>
        )}
      </div>
    );
  }
  return input;
};

// TODO: map props
Input.propTypes = {
  leftAddon: React.PropTypes.node,
  rightAddon: React.PropTypes.node
};

Input.defaultProps = {
  type: 'text'
};

export default Input;
