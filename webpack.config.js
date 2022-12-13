const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    //min-css-extract-plugin goes in the plugins array
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    "style-loader",
                    "css-loader",
                    {
                        loader: "postcss-loader",
                        options: {
                            postcssOptions: {
                                plugins: [
                                    [
                                        "postcss-preset-env",
                                        {
                                            // Options
                                        },
                                    ],
                                ],
                            },
                        },
                    },
                    {
                        // compiles Sass to CSS
                        loader: "sass-loader",
                    },
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename:
                mode === "production"
                    ? "css/[name].[contenthash].chunk.css"
                    : "css/[name].css",
        }),
    ],
    //css-minimizer-webpack-plugin goes in the optimization object in minimizer array
    optimization: {
        minimizer: ["...", new CssMinimizerPlugin()],
    },
};
