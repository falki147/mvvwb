const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyPlugin = require("copy-webpack-plugin");
const { version } = require('./package.json');
const { po, mo } = require("gettext-parser");

const isProduction = process.env.NODE_ENV == "production";

const config = {
  entry: {
    index: [ "./js/index.js", "./style/style.scss" ],
  },
  output: {
    path: path.resolve(__dirname, "dist"),
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "style.css",
    }),
    new CopyPlugin({
      patterns: [
        {
          from: "assets",
        },
        {
          from: "src",
          transform: content => content.toString().replace(/\{\{version\}\}/g, version),
        },
        {
          from: "translations",
          to: "[path][name].mo",
          transform: content => mo.compile(po.parse(content)),
        },
      ],
    }),
  ],
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        loader: "babel-loader",
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: { url: false },
          },
          "postcss-loader",
          "sass-loader",
          {
            loader: "string-replace-loader",
            options: {
              search: /\{\{version\}\}/g,
              replace: version,
            },
          },
        ],
      },
    ],
  },
  performance: {
    assetFilter: (assetFilename) => {
      // Exclude sreenshot from assets as it only is needed for the wordress admin site
      if (assetFilename.endsWith("screenshot.jpg")) {
        return false;
      }

      return !/\.map$/.test(assetFilename);
    },
  },
};

module.exports = () => {
  if (isProduction) {
    config.mode = "production";
  } else {
    config.mode = "development";
  }
  return config;
};
