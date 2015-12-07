export const async = () => next => action => {
  const { type, meta, promise } = action;
  if (!promise) {
    return next(action);
  }
  if (!meta || meta.dispatchRequest !== false) {
    next(Object.assign({}, action, { type: `${type}_REQUEST` }));
  }
  return promise.then(data => {
    return next(Object.assign({}, action, { type: `${type}_SUCCESS`, payload: data }));
  }).catch(error => {
    return next(Object.assign({}, action, { type: `${type}_FAILURE`, payload: error, error: true }));
  });
};
