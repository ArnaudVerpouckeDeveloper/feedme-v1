const path = require("path");

module.exports = {
    "transpileDependencies": [
        "vuetify"
    ],
    outputDir: path.resolve(__dirname, "../feedme/public/spa"),
    assetsDir: "./",
    configureWebpack: config => {
        config.output.filename = '[name].js'
        config.output.chunkFilename = '[name].js'
    },
    css: {
        extract: {
            filename: '[name].css',
        },
    },
}