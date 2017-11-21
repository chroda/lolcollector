import React, { PropTypes } from 'react'
import PostListContainer from '../containers/PostListContainer'
import PostForm from './PostForm'

export default function Posts({ children }) {
  return (
    <div className="row">
      <div className="col-sm-8">
        <PostListContainer />
      </div>
      <div className="col-sm-4">
        {children}
      </div>
    </div>
  )
}

Posts.propTypes = {
  children: PropTypes.node.isRequired
}
