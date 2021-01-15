/**
 * Archivo de configuracion de webpack para la construccion de modulos con React
 * 
 * Este archivo se tiene que modificar cada vez que se requiera construir un modulo front nuevo
 * 
 * @see https://nodejs.org/api/path.html
 * @see https://webpack.js.org/plugins/html-webpack-plugin/
 * @see https://webpack.js.org/plugins/mini-css-extract-plugin/
 * @see https://es.reactjs.org/
 * @see https://babeljs.io/
 */
const path = require("path");
const HtmlWebPackPlugin = require("html-webpack-plugin");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");


/**
 * Configuracion de webpack
 * 
 * Aqui configuramos las rutas en donde se compilara el codigo React
 * 
 * @path src
 */
module.exports = {
  entry: ["@babel/polyfill","./src/home.js"],
  output: {
    path: path.resolve(__dirname, "public/app/js/"),
    filename: "home.js",
  },
  devtool: 'inline-source-map',
  resolve: {
    extensions: [".js", ".jsx"],
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
        },
      },
      {
        test: /\.html$/,
        use: [
          {
            loader: "html-loader",
          },
        ],
      },
      {
        test: /\.css$/,
        loader: [MiniCSSExtractPlugin.loader, "css-loader"],
      },
      {
        test: /\.scss$/,
        loader: [MiniCSSExtractPlugin.loader, "sass-loader"],
      },
      {
        test: /\.(png|svg|jpg|jpeg|gif)$/,
        use: ["file-loader"],
      },
    ],
  },
  plugins: [
    new MiniCSSExtractPlugin(),
  ],
};
