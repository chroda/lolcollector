import React from 'react';
import ReactSelect from 'react-select';

const Select = props => (
  <ReactSelect
    {...props}
    value={props.value || ''}
    placeholder={props.placeholder || ''}
    clearable={false}
    onChange={value => {
      if (!props.onChange) {
        return;
      }
      if (value && value.length === 0) {
        return props.onChange(null);
      }
      return props.onChange(value);
    }}
    onBlur={() => {
      if (props.onBlur) {
        props.onBlur(props.value);
      }
    }} />
);

// TODO: map props

export default Select;
