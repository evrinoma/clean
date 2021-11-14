'use strict'
const path = require('path');
const webpack = require('webpack');
const autoprefixer = require('autoprefixer');
const ManifestPlugin = require('webpack-manifest-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const HtmlWebpackInlineSourcePlugin = require('html-webpack-inline-source-plugin');
const {VueLoaderPlugin} = require('vue-loader');
const CopyPlugin = require('copy-webpack-plugin');
//const EntrypointAssetsPlugin = require('entrypoint-assets-webpack-plugin');

module.exports = (env) => {
    const config = {
        mode: (env === 'dev') ? 'development' : (env === 'prod') ? 'production' : 'none',
        devtool: (env === 'dev') ? 'inline-source-map': 'none',
        entry: {
            app: path.join(__dirname, 'front/entrypoints/app.entry.js'),
            login: path.join(__dirname, 'front/entrypoints/login.entry.js'),
            status: path.join(__dirname, 'front/entrypoints/status.entry.js'),
        },
        node: {
            fs: 'empty'
        },
        output: {
            filename: (env === 'dev') ? '[name].js' : '[name]-[chunkhash].js',
            publicPath: 'build/',
            path: path.resolve(__dirname, 'public/build'),
        },
        performance: {hints: false},
        module: {
            rules: [
                {
                    test: /\.vue$/,
                    loader: 'vue-loader',
                    options: {
                        loaders: {
                            "scss": [
                                "vue-style-loader",
                                "css-loader",
                                {
                                    loader: 'postcss-loader',
                                    options: {
                                        plugins: [
                                            autoprefixer({
                                                overrideBrowserslist: ['ie >= 11', 'last 4 version']
                                            })
                                        ],
                                        sourceMap: true
                                    }
                                },
                                "sass-loader",
                            ],
                            "sass": [
                                "vue-style-loader",
                                "css-loader",
                                {
                                    loader: 'postcss-loader',
                                    options: {
                                        plugins: [
                                            autoprefixer({
                                                overrideBrowserslist: ['ie >= 11', 'last 4 version']
                                            })
                                        ],
                                        sourceMap: true
                                    }
                                },
                                "sass-loader?indentedSyntax"
                            ]
                        }
                    }
                }, {
                    test: /\.css$/,
                    use: [
                        'vue-style-loader',
                        'style-loader',
                        'css-loader',
                        {
                            loader: 'postcss-loader',
                            options: {
                                plugins: [
                                    autoprefixer({
                                        overrideBrowserslist: ['ie >=11', 'last 4 version']
                                    })
                                ],
                                sourceMap: true
                            }
                        },
                    ],
                }, {
                    test: /\.s(c|a)ss$/,
                    use: [
                        {loader: "vue-style-loader"},
                        {loader: "css-loader"},
                        {
                            loader: 'postcss-loader',
                            options: {
                                plugins: [
                                    autoprefixer({
                                        overrideBrowserslist: ['ie >= 11', 'last 4 version']
                                    })
                                ],
                                sourceMap: true
                            }
                        },
                        {
                            loader: "sass-loader",
                            // Requires sass-loader@^8.0.0
                            options: {
                                implementation: require('sass'),
                                sassOptions: {
                                    indentedSyntax: true // optional
                                },
                                includePaths: [
                                    path.join(__dirname, 'node_modules/element-ui/packages/theme-chalk/src')
                                ]
                            },

                           /* old
                            options: {
                                includePaths: [
                                    path.join(__dirname, 'node_modules/element-ui/packages/theme-chalk/src')
                                ]
                            }*/
                        },
                    ],
                }, {
                    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                    use: [{
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: 'fonts/',
                            publicPath: '/build/fonts/'
                        }
                    }]
                }, {
                    test: /\.(jpg|jpeg|png|svg)$/,
                    use: [{
                        loader: 'file-loader',
                        options: {
                            name: '[path][name].[ext]',
                            outputPath: (url, resourcePath, context) => {
                                let fileName = path.parse(url).base;
                                let newPath = /front\/components\/([^\/]+)\/images\//.exec(url);
                                if(newPath) { // если картинка в assets/components/ComponentName/images/picture.tiff
                                    console.log(`\x1b[1;37;44m${fileName} from ${url} copy to ${path.join('images', newPath[1], fileName)}\x1b[0m\n`);
                                    return path.join('images', newPath[1], fileName);
                                } else if( /front\/assets\/images/.test(url) ) {  // если картинка в assets/images/ComponentName/picture.tiff
                                    console.log(`\x1b[1;37;44m${fileName} from ${url} copy to ${url.replace(/front\/assets\/images/, "images" )}\x1b[0m\n`);
                                    return url.replace( /front\/assets\/images/, "images" );
                                }
                                console.log(`\x1b[1;37;44m${fileName} from ${url} copy to ${path.join('images', fileName)}\x1b[0m\n`);
                                return path.join('images', fileName);
                            },
                            publicPath: (url, resourcePath, context) => {
                                let fileName = path.parse(url).base;
                                let newPath = /front\/components\/([^\/]+)\/images\//.exec(url);
                                if(newPath) {
                                    console.log(`\x1b[1;36;44mFor public ${fileName} use - ${path.join('/build/images', newPath[1], fileName)}\x1b[0m\n`);
                                    return path.join('/build/images', newPath[1], fileName);
                                } else if( /front\/assets\/images/.test(url) ) {
                                    console.log(`\x1b[1;36;44mFor public ${fileName} use - ${url.replace(/front\/assets\/images/, "build/images" )}\x1b[0m\n`);
                                    return url.replace( /front\/assets\/images/, "build/images" );
                                }
                                console.log(`\x1b[1;36;44mFor public ${fileName} use - ${path.join('/build/images', fileName)}\x1b[0m\n`);
                                return path.join('/build/images', fileName);
                            }
//                            outputPath: 'images/',
//                            publicPath: '/build/images/'
                        }
                    }]
                }, {
                    test: /\.js$/,
                    exclude: /(node_modules|bower_components)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['env']
                        }
                    }
                }
            ]
        },
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
                'jquery': path.join(__dirname, 'node_modules/jquery/dist/jquery'),
                '@public': path.resolve(__dirname, 'public'),
                '@vendor': path.resolve(__dirname, 'vendor')
            },
            extensions: [
                ".js",
                ".vue"
            ]
        },
        plugins: [
           new CopyPlugin({
                patterns: [
                    {
                        from: path.join(__dirname, 'front/assets/images'),
                        to: path.resolve(__dirname, 'public/build/images')
                    }
                ],
                options: {
                    concurrency: 100,
                },
            }),
            new VueLoaderPlugin(),
            new ManifestPlugin({
                publicPath: 'build/',
                basePath: 'build/'
            }),
            new CleanWebpackPlugin( {
                  dry: false, // not simulate
                  verbose: true, // logs to Console
                  cleanOnceBeforeBuildPatterns: [
                    '**/*', 
                    '!/fonts/*' // исключаем /fonts/
                  ]
                }), // выполняется относительно webpack output.path
            // 'build', {
                // root: path.resolve(__dirname, 'public'),
                // watch: true,
                // exclude: ['fonts']
            // }),
            new webpack.DefinePlugin({
                'process.env': {
                    'NODE_ENV': JSON.stringify(process.env.NODE_ENV)
                }
            }),
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'Promise': 'es6-promise', // Thanks Aaron (https://gist.github.com/Couto/b29676dd1ab8714a818f#gistcomment-1584602)
                'fetch': 'imports?this=>global!exports?global.fetch!whatwg-fetch'
            }),
            new HtmlWebpackPlugin({
                inlineSource: '.(js|css)$' // embed all javascript and css inline
            }),
            new HtmlWebpackInlineSourcePlugin(),
        ],
        optimization: {
            minimize: (env !== 'dev'),
        }
    };

    return config;
};
