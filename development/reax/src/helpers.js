import Promise from 'promise';
import request from 'superagent';

export const callAPI = (type, path, params) => {
  if (['get', 'post', 'put', 'delete'].indexOf(type) === -1) {
    throw new Error('Invalid type');
  }
  if (!path) {
    throw new Error('Invalid path');
  }
  return new Promise((resolve, reject) => {
    return request[type](`/api/${path}`)[type === 'get' ? 'query' : 'send'](params).end((error, response) => {
      if (error) {
        return reject(error.response.body);
      }
      return resolve(response.body);
    });
  });
};

export const callAPIRiot = (path, params, region, version) => {
  if (!path) {
    throw new Error('Invalid path');
  }
  const api_key = '2a0a5c1e-7355-42dc-8e2b-f25d5ee9771f';
  if(!region){
    region='br';
  }
  if(!version){
    switch (path){
      case 'champion'       :version ='v1.2';break;
      case 'current-game'   :version ='v1.0';break;
      case 'featured-games' :version ='v1.0';break;
      case 'game'           :version ='v1.3';break;
      case 'league'         :version ='v2.5';break;
      case 'lol-static-data':version ='v1.2';break;
      case 'lol-status'     :version ='v1.0';break;
      case 'match'          :version ='v2.2';break;
      case 'matchlist'      :version ='v2.2';break;
      case 'stats'          :version ='v1.3';break;
      case 'summoner'       :version ='v1.4';break;
      case 'team'           :version ='v2.4';break;
    }
  }
  let api_path = `https://${region}.api.pvp.net/api/lol/${region}/${version}/${path}?api_key=${api_key}`;

  return new Promise((resolve, reject) => {
    return request['get'](api_path)['query'](params).end((error, response) => {
      if (error) {
        return reject(error.response.body);
      }
      return resolve(response.body[Object.keys(response.body, 0)]);
      return resolve(response.body);
    });
  });
};
