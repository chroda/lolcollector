import { callAPIRiot } from '../../../helpers.js';

const loadProjects = () => ({
  type: 'LOAD_CHAMPIONS',
  promise: callAPIRiot('champion')
});

export default loadProjects;
