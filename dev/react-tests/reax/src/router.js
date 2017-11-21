import React from 'react';
import { Router } from 'react-router';
import history from './history.js'
import routes from './routes.js';

const router = <Router history={history} routes={routes} />;

export default router;
