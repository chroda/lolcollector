import React, { Component } from 'react'
import Spinner from 'reax-commons/lib/components/Spinner'
import Alert from 'reax-commons/lib/components/Alert'
import { connect } from 'react-redux'
import PostList from '../components/PostList'
import { getPosts } from '../'

class PostListContainer extends Component {
  componentDidMount() {
    const { getPosts } = this.props
    getPosts()
  }
  render() {
    const { posts } = this.props
    if (posts.loading) {
      return <Spinner />
    }
    if (posts.error) {
      return <Alert type="danger">Failed to load posts</Alert>
    }
    if (!posts.data) {
      return <Alert type="warning">No posts found</Alert>
    }
    return <PostList posts={posts.data} />
  }
}

function mapStateToProps({ posts }) {
  return { posts }
}

export default connect(mapStateToProps, { getPosts })(PostListContainer)
