const initialState = {
  data: [],
  isLoading: false,
  errorMessage: null
};

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case 'LOAD_PROJECTS_REQUEST':
      return Object.assign({}, state, {
        data: [],
        isLoading: true,
        errorMessage: null
      });
    case 'LOAD_PROJECTS_SUCCESS':
      return Object.assign({}, state, {
        data: action.payload,
        isLoading: false,
        errorMessage: null
      });
    case 'LOAD_PROJECTS_FAILURE':
      return Object.assign({}, state, {
        data: [],
        isLoading: false,
        errorMessage: action.payload.message
      });
    default:
      return state;
  }
};

export default reducer;
