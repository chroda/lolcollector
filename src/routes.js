import App from './modules/app/components/App.js';
import Champions from './modules/champions/containers/Champions.js';
// import Projects from './modules/projects/containers/Projects.js';

const routes = [
  {
    path: '/',
    component: App,
    indexRoute: { component: Champions },
    // childRoutes: [
    //   { path: 'projects', component: Projects }
    // ]
  }
];

export default routes;
