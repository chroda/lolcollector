import App from './app/components/App'
import Posts from './posts/components/Posts'
import PostFormContainer from './posts/containers/PostFormContainer'
import NotFound from './app/components/NotFound'

const routes = [
  {
    path: '/',
    component: App,
    indexRoute: {
      onEnter: (nextState, replace) => replace('/posts')
    },
    childRoutes: [
      {
        path: 'posts',
        component: Posts,
        indexRoute: {
          component: PostFormContainer
        },
        childRoutes: [
          {
            path: ':id/edit',
            component: PostFormContainer
          }
        ]
      },
      {
        path: '*',
        component: NotFound
      }
    ]
  }
]

export default routes
