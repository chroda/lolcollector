import React from 'react';
import { Router, browserHistory } from 'react-router';
import routes from './routes';

const router = <Router history={browserHistory} routes={routes} />;

export default router;
