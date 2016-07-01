import React from 'react';
import { Provider } from 'react-redux';
import store from './store.js';
import router from './router.js';

const provider = (
  <Provider store={store}>
    {router}
  </Provider>
);

export default provider;
