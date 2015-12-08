import { callAPI, callAPIRiot } from '../../../helpers.js';

const loadProjects = () => ({
  type: 'LOAD_PROJECTS',
  promise: callAPI('get','projects.json')
  //promise: callAPIRiot('champion')
});

export default loadProjects;
