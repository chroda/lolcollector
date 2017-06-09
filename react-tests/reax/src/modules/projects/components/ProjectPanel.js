import React from 'react';
import Project from '../components/Project.js';

const ProjectPanel = ({ projects }) => (
  <div className="panel panel-default">
    <div className="panel-heading">
      Projects
    </div>
    <div className="panel-body">
      <button className="btn btn-success" type="button" onClick={() => alert('Not implemented yet')}>
        <span className="glyphicon glyphicon-plus" />
      </button>
    </div>
    <table className="table table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Version</th>
        </tr>
      </thead>
      <tbody>
        {projects.map(({ name, version }) => <Project key={name} name={name} version={version} />)}
      </tbody>
    </table>
  </div>
);

ProjectPanel.propTypes = {
  projects: React.PropTypes.array.isRequired
};

export default ProjectPanel;
