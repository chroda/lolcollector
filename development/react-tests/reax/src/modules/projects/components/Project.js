import React from 'react';

const Project = ({ name, version }) => (
  <tr>
    <td>{name}</td>
    <td>{version}</td>
  </tr>
);

Project.propTypes = {
  name: React.PropTypes.string.isRequired,
  version: React.PropTypes.string.isRequired
};

export default Project;
