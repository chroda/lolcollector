import { combineReducers } from 'redux';
import { reducer as form } from 'redux-form';
import projects from './modules/projects/reducer.js';
import champions from './modules/champions/reducer.js';

const rootReducer = combineReducers({
  form,
  projects,
  champions
});

export default rootReducer;
