import { callAPIRiot } from '../../../helpers.js';

const loadProjects = () => ({
  type: 'LOAD_PROJECTS',
  promise: callAPIRiot('champion')
});

export default loadProjects;
