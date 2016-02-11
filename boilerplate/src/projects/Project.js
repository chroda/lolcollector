import React, { PropTypes } from 'react';

const Project = ({
  name,
  version
}) => (
  <tr>
    <td>{name}</td>
    <td>{version}</td>
  </tr>
);

Project.propTypes = {
  name: PropTypes.string.isRequired,
  version: PropTypes.string.isRequired
};

export default Project;
