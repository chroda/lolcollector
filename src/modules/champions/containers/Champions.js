import React from 'react';
import { connect } from 'react-redux';
import loadChampions from '../actions/loadChampions.js';
import Spinner from '../../core/components/Spinner.js';
import Alert from '../../core/components/Alert.js';
import ChampionPanel from '../components/ChampionPanel.js';

class Champions extends React.Component {
  componentDidMount() {
    console.log(loadChampions());
    this.props.dispatch(loadChampions());
  }
  render() {
    const {
      champions,
      isLoading,
      errorMessage
    } = this.props;
    if (isLoading) {
      return <Spinner />;
    }
    if (errorMessage) {
      return <Alert type="danger">{errorMessage}</Alert>;
    }
    //console.log(this.props);
    return <ChampionPanel champions={champions} />;
  }
}

const mapStateToProps = state => ({
  champions: state.champions.data,
  isLoading: state.champions.isLoading,
  errorMessage: state.champions.errorMessage
});

export default connect(mapStateToProps)(Champions);
