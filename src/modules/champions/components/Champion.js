import React from 'react';

const Champion = ({ id }) => (
  <tr>
    <td>{id}</td>
  </tr>
);

Champion.propTypes = {
  name: React.PropTypes.string.isRequired,
  version: React.PropTypes.string.isRequired
};

export default Champion;
