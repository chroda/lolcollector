import { callAPI } from '../../../helpers.js';

const loadProjects = () => ({
  type: 'LOAD_PROJECTS',
  promise: callAPI('get', '/projects.json')
});

export default loadProjects;
