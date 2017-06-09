import React, { PropTypes } from 'react'
import Header from './Header'

export default function App({ children }) {
  return (
    <div>
      <div className="container">
        <Header />
        {children}
      </div>
    </div>
  )
}

App.propTypes = {
  children: PropTypes.node.isRequired
}
