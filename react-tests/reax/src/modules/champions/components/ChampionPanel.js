import React from 'react';
import Champion from '../components/Champion.js';

const ChampionPanel = ({ champions }) => (
  <div className="panel panel-default">
    <div className="panel-heading">
      Champions ({champions.length})
    </div>
    <div className="panel-body">
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Active</th>
            <th>BotEnabled</th>
            <th>FreeToPlay</th>
            <th>BotMmEnabled</th>
            <th>RankedPlayEnabled</th>
          </tr>
        </thead>
        <tbody>
          {champions.map(champion,index =>
            <Champion
            {...champion}
            key={index} {...this.props} />
        )}
        </tbody>
      </table>
    </div>
  </div>
);

ChampionPanel.propTypes = {
  champions: React.PropTypes.array.isRequired
};

export default ChampionPanel;
