/* eslint-disable */
const Dotenv = require('dotenv-webpack');
const ESLintPlugin = require('eslint-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const path = require('path');
const tailwindcss = require('tailwindcss');
const webpack = require('webpack');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');

const destFolder = 'public/js';

module.exports = {
  entry: {
    index: path.join(__dirname, 'resources/js/index.js'),
    app: path.join(__dirname, 'resources/scss/app.scss'),
  },
  output: {
    path: path.resolve(__dirname, destFolder),
    filename: '[name].js',
    chunkFilename: '[chunkhash].js',
    publicPath: '/'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-react']
          }
        }
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  tailwindcss('./tailwind.config.js'),
                  autoprefixer(),
                  process.env.NODE_ENV === 'production'
                    ? cssnano({
                      preset: 'default',
                    })
                    : null,
                ].filter(Boolean),
              },
            },
          },
          'sass-loader',
        ],
      },
      {
        test: /\.(svg|png|jpg|jpeg|gif)$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: '../images',
          },
        },
      },
      {
        test: /\.(woff(2)?|ttf|eot|otf)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: '../css/fonts'
            }
          }
        ]
      },
    ],
  },
  optimization: {
    splitChunks: {
      chunks: 'async',
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/](alpinejs|axios|mitt|pusher-js|laravel-echo)[\\/]/,
          name: 'vendor',
          chunks: 'all',
        },
      },
    },
  },
  resolve: {
    extensions: ['.js', '.jsx'],
    alias: {
      '@js': path.resolve(__dirname, 'resources/js'),
    },
  },
  plugins: [
    new ESLintPlugin({
      extensions: ['js', 'jsx', 'ts', 'tsx'],
    }),
    new MiniCssExtractPlugin({
      filename: '../css/[name].css',
    }),
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: [
        '**/*.gz',
        '**/*.js',
        '**/*.json',
        '**/*.txt',
        '**/*.map',
        '**/*.css',
        '**/*.svg',
        '**/*.ttf',
      ],
    }),
    new WebpackManifestPlugin({
      fileName: '../mix-manifest.json',
      map: (file) => {
        /* randon uuid */
        let id = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        for (let i =0; i < 20; i++) {
          id += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        /* map output */
        const ext = file.name.split('.').pop();
        file.name = `/${ext}/${file.name}`;
        file.path = `/${ext}${file.path}?id=${id}`;
        if (ext === 'css') {
          file.path = file.path.replace('/css/..', '');
        }
        return file;
      },
      writeToFileEmit: true
    }),
    new Dotenv({
      systemvars: true,
    }),
  ],
};

