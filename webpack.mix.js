let mix = require('laravel-mix');
let build = require('./tasks/build.js');
let tailwindcss = require('tailwindcss');
let fs = require('fs');
let download = require('download');
let Package = require('./package.json');
const glob = require("glob-all");
require('laravel-mix-purgecss');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/');
mix.setResourceRoot('/assets/');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/_assets/**/*.css', 'source/_assets/**/*.png', 'source/_assets/**/*.svg', 'source/_assets/**/*.jpg']),
    ]
});

if (!fs.existsSync('./source/_assets/js/klaro.js')) {
    download(Package.urlDependencies.klaro, './source/_assets/js/klaro.js').then(() => {
        console.log('Klaro.js downloaded');
    });
}


mix.js('source/_assets/js/main.js', 'js/main.js')
    .scripts(['source/_assets/js/consentConfig.js', 'source/_assets/js/klaro.js/klaro.js'], 'source/assets/js/klaro.js')
    .less('source/_assets/less/main.less', 'css/main.css')
    .options({
        postCss: [
            tailwindcss('tailwind.js'),
        ]
    })
    mix.purgeCss({
        enabled: mix.inProduction(),
        globs: glob.sync([
          path.join(__dirname, "./source/**/*.blade.php"),
          path.join(__dirname, "./source/**/*.blade.md"),
          path.join(__dirname, "./source/**/*.md"),
        //   path.join(__dirname, "./source/**/*.js"), // since klaro.js is in a folder called klaro.js this causes the library to read a folder like a file
        ]),
        extensions: ["php", "js", "md"],
        whitelistPatterns: [
            /button/,
            /hero/, 
            /cover/,
            /type/,
            /transition/,
        ]
      })
    .version();
