import React, { Component } from 'react';
import { connect } from 'react-redux';
import { mapAPIStateToProps, callAPI } from '@hnordt/reax-api';
import Projects from './Projects';

class ProjectsContainer extends Component {
  componentDidMount() {
    this.props.loadProjects();
  }
  render() {
    return <Projects {...this.props} />;
  }
}

const mapStateToProps = state => mapAPIStateToProps(state.api.projects, 'projects', 'array');

const mapDispatchToProps = dispatch => ({
  loadProjects: () => dispatch(callAPI('projects', 'GET', '/api/projects.json'))
});

export default connect(mapStateToProps, mapDispatchToProps)(ProjectsContainer);
