import { callRESTAPI } from 'reax-commons/lib/utils/api'

export function getPosts() {
  return callRESTAPI('/posts')
}

export function getPost(id) {
  return callRESTAPI(`/posts/${id}`)
}

export function createPost(title, body) {
  return callRESTAPI('/posts', { title, body })
}

export function updatePost(id, title, body) {
  return callRESTAPI(`/posts/${id}`, { id, title, body })
}

export function deletePost(id) {
  return callRESTAPI(`/posts/${id}`, null)
}
