import React, { PropTypes } from 'react';
import Panel from '@hnordt/reax-panel';
import PanelBody from '@hnordt/reax-panel-body';
import Button from '@hnordt/reax-button';
import Icon from '@hnordt/reax-icon';
import Project from './Project';

const ProjectPanel = ({ projects }) => (
  <Panel title="Project">
    <PanelBody>
      <Button type="success" onClick={() => alert('Not implemented yet')}>
        <Icon name="plus" />
      </Button>
    </PanelBody>
    <table className="table table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Version</th>
        </tr>
      </thead>
      <tbody>
        {projects.map(({ name, version }) => (
          <Project
            key={name}
            name={name}
            version={version}
          />
        ))}
      </tbody>
    </table>
  </Panel>
);

ProjectPanel.propTypes = {
  projects: PropTypes.array.isRequired
};

export default ProjectPanel;
