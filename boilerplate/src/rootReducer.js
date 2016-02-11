import { combineReducers } from 'redux';
import { reducer as form } from 'redux-form';
import api from '@hnordt/reax-api';

const rootReducer = combineReducers({
  form,
  api
});

export default rootReducer;
