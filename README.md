# LolCollector
A website to collection about League Of Legends MOBA game.

## Install

`npm install -g webpack webpack-dev-server && npm install`

## Build

### Production

`webpack -p && PORT=80 node server.js`

### Development

`BUILD_DEV=1 webpack-dev-server --content-base public/ --inline --history-api-fallback`
