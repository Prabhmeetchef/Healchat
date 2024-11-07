const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.css('resources/css/app.css', 'public/css')
   .options({
      postCss: [tailwindcss('./tailwind.config.js')],
   });
