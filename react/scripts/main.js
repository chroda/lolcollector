import React  from 'react';
import ReactDOM  from 'react-dom';
import { Router, Route } from 'react-router';
import { createHistory } from 'history';

import Home from './components/Home';
import Layout from './components/Layout';
import NotFound from './components/NotFound';
// import StorePicker from './components/StorePicker';
// import App from './components/App';

/*
  Routes
*/
//
// var routes = (
//   <Router history={createHistory()}>
//     <Route path="/" component={Home}/>
//     <Route path="/user/:userId" component={App}/>
//     <Route path="*" component={NotFound}/>
//   </Router>
// )

const routes = [
  {
    path: '/',
    component: Layout,
    indexRoute: { component: Home },
    childRoutes: [
      { path: '*', component: NotFound }
    ]
  }
];

const router = <Router history={createHistory()} routes={routes} />;

ReactDOM.render(router, document.querySelector('#main'));
