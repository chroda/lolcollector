import { applyMiddleware, createStore } from 'redux';
import thunk from 'redux-thunk';
import { async } from './middleware.js';
import logger from './logger.js';
import rootReducer from './rootReducer.js';

const createStoreWithMiddleware = applyMiddleware(thunk, async, logger)(createStore);
const store = createStoreWithMiddleware(rootReducer);

export default store;
