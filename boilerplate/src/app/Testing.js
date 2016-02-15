import React from 'react';
import { createStore } from 'redux'

const counter = (state = 0, action) => {
  switch (action.type) {
    case 'INCREMENT':
      return state + 1
    case 'DECREMENT':
      return state - 1
    default:
      return state
  }
}

const store = createStore(counter)
const render = () => {
  document.body.innerText = store.getState();

  render(provider, document.getElementById('app'));
}
store.subscribe(render);

const incrementOne = () => {
  store.dispatch({ type: 'INCREMENT' });
}

const Testing = () => (
  <div>
    the current state is:
    <br/>
    <button onClick={incrementOne()} >+</button>
    <button onClick={store.dispatch({ type: 'DECREMENT' })} >-</button>
  </div>
);

export default Testing;
