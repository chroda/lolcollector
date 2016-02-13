# Reax Redux Boilerplate

Redux boilerplate for React

## Install

```sh
npm install -g webpack webpack-dev-server
npm install
```

## Build

### Production

```sh
webpack -p
PORT=80 node server.js
```

### Development

```sh
BUILD_DEV=1 webpack-dev-server --content-base public/ --inline --history-api-fallback
```
