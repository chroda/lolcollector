import React from 'react';

const Icon = ({
  type,
  name
}) => (
  <span className={`${type} ${type}-${name}`} />
);

Icon.propTypes = {
  type: React.PropTypes.oneOf([
    'glyphicon',
    'fa'
  ]),
  name: React.PropTypes.string.isRequired
};

Icon.defaultProps = {
  type: 'glyphicon'
};

export default Icon;
