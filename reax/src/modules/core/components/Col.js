import React from 'react';

const Col = ({
  xs,
  sm,
  md,
  lg,
  children
}) => (
  <div className={`
    ${xs ? `col-xs-${xs}` : ''}
    ${sm ? `col-sm-${sm}` : ''}
    ${md ? `col-md-${md}` : ''}
    ${lg ? `col-lg-${lg}` : ''}
  `}>
    {children}
  </div>
);

Col.propTypes = {
  xs: React.PropTypes.number,
  sm: React.PropTypes.number,
  md: React.PropTypes.number,
  lg: React.PropTypes.number
};

export default Col;
