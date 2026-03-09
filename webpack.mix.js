let mix = require('laravel-mix');
let path = require('path');
let postCss = require('@tailwindcss/postcss');
let fs = require('fs');
let glob = require('glob');

mix.setResourceRoot('../');
mix.setPublicPath(path.resolve('./'));

mix.disableNotifications();

mix.webpackConfig({
  watchOptions: {
    ignored: [
      path.posix.resolve(__dirname, './node_modules'),
      path.posix.resolve(__dirname, './css'),
      path.posix.resolve(__dirname, './js'),
      path.posix.resolve(__dirname, './blocks') // prevent watch loop
    ]
  },
  externals: {
    '@wordpress/blocks': 'wp.blocks',
    '@wordpress/i18n': 'wp.i18n',
    '@wordpress/block-editor': 'wp.blockEditor',
    '@wordpress/components': 'wp.components',
    '@wordpress/element': 'wp.element',
    '@wordpress/data': 'wp.data'
  }
});

mix.js('resources/js/app.js', 'js');

mix.postCss("resources/css/app.css", "css", postCss);

mix.postCss("resources/css/editor-style.css", "css", postCss);
// Auto-compile all blocks in resources/blocks/*/index.js to blocks/*.js
glob.sync('resources/blocks/*/index.js').forEach(file => {
  const blockName = path.basename(path.dirname(file));
  mix.js(file, `blocks/${blockName}.js`);
});

// mix.browserSync({
//     proxy: 'http://tailpress.test',
//     host: 'tailpress.test',
//     open: 'external',
//     port: 8000,
//     files: ["*.php", "**/*.php"]
// });

if (mix.inProduction()) {
    mix.version();
} else {
    mix.options({ manifest: false });
}
