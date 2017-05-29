import React, { Component } from 'react'
import { reset } from 'redux-form'
import Panel from 'reax-commons/lib/components/Panel'
import PanelHeading from 'reax-commons/lib/components/PanelHeading'
import PanelTitle from 'reax-commons/lib/components/PanelTitle'
import PanelBody from 'reax-commons/lib/components/PanelBody'
import { connect } from 'react-redux'
import PostForm from '../components/PostForm'
import { createPost, updatePost } from '../api'
import { getPosts } from '../'

class PostFormContainer extends Component {
  handleSubmit({ title, body }) {
    const { params, dispatch } = this.props
    if (params.id) {
      return updatePost(params.id, title, body)
    }
    return createPost(title, body).then(() => {
      dispatch(getPosts())
      dispatch(reset('post'))
    })
  }
  render() {
    const { post, onSubmit } = this.props
    return (
      <Panel>
        <PanelHeading>
          <PanelTitle>
            {post ? 'Edit' : 'New'} Post
          </PanelTitle>
        </PanelHeading>
        <PanelBody>
          <PostForm {...post} onSubmit={this.handleSubmit.bind(this)} />
        </PanelBody>
      </Panel>
    )
  }
}

function mapStateToProps({ posts }, { params }) {
  return {
    post: posts.data && posts.data.find(({ id }) => id === Number(params.id))
  }
}

export default connect(mapStateToProps)(PostFormContainer)
