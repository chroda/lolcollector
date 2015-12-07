import { combineReducers } from 'redux';
import { reducer as form } from 'redux-form';
import projects from './modules/projects/reducer.js';

const rootReducer = combineReducers({
  form,
  projects
});

export default rootReducer;
