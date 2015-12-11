import React from 'react';

const Champion = ({ id, active, botEnabled, freeToPlay, botMmEnabled, rankedPlayEnabled }) => (
  <tr>
    <td>{id}</td>
    <td>{active}</td>
    <td>{botEnabled}</td>
    <td>{freeToPlay}</td>
    <td>{botMmEnabled}</td>
    <td>{rankedPlayEnabled}</td>
  </tr>
);

Champion.propTypes = {
  id: React.PropTypes.number.isRequired,
  active: React.PropTypes.bool
};

export default Champion;
