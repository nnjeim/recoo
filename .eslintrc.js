module.exports = {
  extends: [
    'airbnb',
    'plugin:import/react',
    'plugin:import/recommended',
  ],
  env: {
    es6: true,
    browser: true,
    node: true,
  },
  globals: {
    window: true,
    document: true,
  },
  plugins: [
    'react',
    'jsx-a11y',
    'import',
  ],
  rules: {
    'react/jsx-filename-extension': [1, { extensions: ['.js', '.jsx'] }],
    'react/jsx-props-no-spreading': 'off',
    'import/extensions': 0,
  },
  settings: {
    'import/resolver': {
      webpack: {
        config: './webpack.dev.js',
      },
      node: {
        extensions: [
          '.js',
          '.jsx',
        ],
      },
    },
  },
  parser: '@babel/eslint-parser',
  parserOptions: {
    sourceType: 'module',
    ecmaVersion: 2018,
    allowImportExportEverywhere: true,
    ecmaFeatures: {
      jsx: true,
      experimentalObjectRestSpread: true,
    },
  },
};
