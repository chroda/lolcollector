import App from './modules/app/components/App.js';
import Projects from './modules/projects/containers/Projects.js';

const routes = [
  {
    path: '/',
    component: App,
    indexRoute: { component: Projects },
    childRoutes: [
      { path: 'projects', component: Projects }
    ]
  }
];

export default routes;
