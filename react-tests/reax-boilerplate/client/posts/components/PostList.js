import React, { PropTypes } from 'react'
import { Link } from 'react-router'

export default function PostList({ posts }) {
  return (
    <ul className="list-group">
      {posts.map(({ id, title, body }) => (
        <li key={id} className="list-group-item">
          <strong>{title}</strong>
          <br />
          {body}
          <br />
          <small>
            <Link to={`/posts/${id}/edit`}>Edit</Link>
          </small>
        </li>
      ))}
    </ul>
  )
}

PostList.propTypes = {
  posts: PropTypes.arrayOf(PropTypes.shape({
    id: PropTypes.number.isRequired,
    title: PropTypes.string.isRequired,
    body: PropTypes.string.isRequired
  })).isRequired
}
