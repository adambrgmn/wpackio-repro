const { getBabelPresets } = require('@wpackio/scripts');

module.exports = api => {
  // create cache based on NODE_ENV
  api.cache.using(() => process.env.NODE_ENV);

  const babelConfig = {
    presets: getBabelPresets({}),
    plugins: ['@babel/plugin-transform-runtime'],
  };

  return babelConfig;
};
