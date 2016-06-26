import * as api from './api'

export const GET_POSTS = 'GET_POSTS'

const initialState = {}

export default function reducer(state = initialState, action) {
  if (action.type === GET_POSTS) {
    return action.payload
  }
  return state
}

export function getPosts() {
  return {
    type: GET_POSTS,
    payload: api.getPosts()
  }
}
