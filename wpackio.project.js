const pkg = require('./package.json');

module.exports = {
  appName: 'wpackioRepro',
  type: 'plugin',
  slug: 'wpackio-repro',
  bannerConfig: {
    name: 'wpackioRepro',
    author: '',
    license: 'MIT',
    link: 'MIT',
    version: pkg.version,
    copyrightText:
      'This software is released under the MIT License\nhttps://opensource.org/licenses/MIT',
    credit: true,
  },
  files: [
    {
      name: 'app',
      entry: {
        main: ['./src/app.js'],
      },
    },
  ],
  // It will all work if I choose to use a custom babel config, setting
  // `useBabelConfig` to `true`
  useBabelConfig: false,
  // This never gets applied
  jsBabelPresetOptions: {
    plugins: ['@babel/plugin-transform-runtime'],
  },
  // And this one never gets called
  jsBabelOverride: defaults => {
    throw new Error('This will never be called');
    return { ...defaults, plugins: ['@babel/plugin-transform-runtime'] };
  },
  outputPath: 'dist',
  hasReact: false,
  hasSass: false,
  hasLess: false,
  hasFlow: false,
  externals: {
    jquery: 'jQuery',
  },
  alias: undefined,
  errorOverlay: true,
  optimizeSplitChunks: true,
  watch: './inc|includes/**/*.php',
  packageFiles: [
    'inc/**',
    'vendor/**',
    'dist/**',
    '*.php',
    '*.md',
    'readme.txt',
    'languages/**',
    'layouts/**',
    'LICENSE',
    '*.css',
  ],
  packageDirPath: 'package',
};
