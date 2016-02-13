import App from './app/App';
import ProjectsContainer from './projects/ProjectsContainer';
import NotFound from './app/NotFound';

const routes = [
  {
    path: '/',
    component: App,
    indexRoute: {
      component: ProjectsContainer
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
