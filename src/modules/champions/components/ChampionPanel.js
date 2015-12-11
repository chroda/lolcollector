import React from 'react';
import Champion from '../components/Champion.js';

const ChampionPanel = ({ champions }) => (
  <div className="panel panel-default">
    <div className="panel-heading">
      Champions
    </div>
    <div className="panel-body">
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
          </tr>
        </thead>
        <tbody>
          {champions.map(({ id }) => <Champion key={id} />)}
        </tbody>
      </table>
    </div>
  </div>
);

ChampionPanel.propTypes = {
  champions: React.PropTypes.array.isRequired
};

export default ChampionPanel;
