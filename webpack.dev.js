/* eslint-disable */
const {merge} = require('webpack-merge');
const common = require('./webpack.common.js');
const LiveReloadPlugin = require('webpack-livereload-plugin');

const liveReload = process.env.ENV_LIVE;
const plugins = [];
const config = {
  mode: 'development',
  watch: false,
  watchOptions: {
    aggregateTimeout: 100,
  },
  plugins
};

if (liveReload) {
  plugins.push(new LiveReloadPlugin());
  config.watch = true;
}


module.exports = merge(common, config);
