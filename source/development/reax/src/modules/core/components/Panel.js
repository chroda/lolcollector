import React from 'react';

const Panel = ({
  type,
  title,
  rightTitle,
  children
}) => (
  <div className={`panel panel-${type}`}>
    {title && (
      <div className="panel-heading">
        <h3 className="panel-title">
          {rightTitle && (
            <div className="pull-right">
              {rightTitle}
            </div>
          )}
          {title}
        </h3>
      </div>
    )}
    {children}
  </div>
);

Panel.propTypes = {
  type: React.PropTypes.oneOf([
    'default',
    'primary',
    'success',
    'info',
    'warning',
    'danger'
  ]),
  title: React.PropTypes.node,
  rightTitle: React.PropTypes.node
};

Panel.defaultProps = {
  type: 'default'
};

export default Panel;
