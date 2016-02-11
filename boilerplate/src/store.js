import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';
import rootReducer from './rootReducer';

const store = createStore(
  rootReducer,
  applyMiddleware(
    thunk,
    createLogger({
      duration: true,
      predicate: () => __DEV__
    })
  )
);

export default store;
