import React from 'react';

const Heading = ({
  size,
  children
}) => {
  switch (size) {
    case 1:
      return <h1 style={{ marginTop: 0, marginBottom: 20 }}>{children}</h1>;
    case 2:
      return <h2 style={{ marginTop: 0, marginBottom: 20 }}>{children}</h2>;
    case 3:
      return <h3 style={{ marginTop: 0, marginBottom: 20 }}>{children}</h3>;
    case 4:
      return <h4 style={{ marginTop: 0, marginBottom: 15 }}>{children}</h4>;
    case 5:
      return <h5 style={{ marginTop: 0, marginBottom: 15 }}>{children}</h5>;
    case 6:
      return <h6 style={{ marginTop: 0, marginBottom: 15 }}>{children}</h6>;
  }
};

Heading.propTypes = {
  size: React.PropTypes.number.isRequired
};

export default Heading;
