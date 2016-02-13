const webpack = require('webpack');

module.exports = {
  entry: './src/index.js',
  output: {
    path: './public',
    filename: 'index.js'
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel',
        query: {
          presets: ['es2015', 'react'],
          plugins: ['transform-object-assign']
        }
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      __DEV__: process.env.BUILD_DEV
    })
  ]
};
