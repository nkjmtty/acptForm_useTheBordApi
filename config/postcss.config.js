module.exports = ctx => ({
  map: ctx.options.map,
  plugins: {
    'postcss-import': {},
    'postcss-nesting': {},
    'postcss-custom-properties': {},
    'postcss-calc': {},
    'postcss-color-function': {},
    'postcss-selector-matches': {},
    'postcss-custom-media': {},
    'postcss-discard-comments': ctx.env === 'development'? {}: {removeAll:true},
    'autoprefixer': {
        "browsers": [
          "ie >= 11",
          "ios >= 8",
          "android >= 4.0"
        ],
        "grid": true
    },
    "css-mqpacker": ctx.env === 'development'? false: {},
    "cssnano": ctx.env === 'production'? {}: false
  }
})
