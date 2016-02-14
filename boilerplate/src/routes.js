import App from './app/App';
import ProjectsContainer from './projects/ProjectsContainer';
import NotFound from './app/NotFound';

import Testing from './app/Testing';

const routes = [
  {
    path: '/',
    component: App,
    indexRoute: {
      component: Testing
    },
    childRoutes: [
      {
        path: 'projects',
        component: ProjectsContainer
      },
      {
        path: '*',
        component: NotFound
      }
    ]
  }
];

export default routes;
