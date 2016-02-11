import React, { Component, PropTypes } from 'react';
import Async from '@hnordt/reax-async';
import Row from '@hnordt/reax-row';
import Col from '@hnordt/reax-col';
import ProjectPanel from './ProjectPanel';
import ProjectForm from './ProjectForm';

const AsyncProjectPanel = Async(ProjectPanel);

const Projects = ({
  projects,
  isLoading,
  error
}) => (
  <Row>
    <Col md={8}>
      <AsyncProjectPanel
        projects={projects}
        isLoading={isLoading}
        error={error && 'Failed to load projects'}
      />
    </Col>
    <Col md={4}>
      <ProjectForm />
    </Col>
  </Row>
);

Projects.propTypes = {
  projects: PropTypes.array.isRequired,
  isLoading: PropTypes.bool.isRequired,
  error: PropTypes.bool
};

export default Projects;
