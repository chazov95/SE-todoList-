var elixir = require("laravel-elixir");

elixir(function(mix) {

    mix.js('resources/assets/coffee/test.coffee', 'public/js')
        .webpackConfig({
            module: {
                rules: [
                    { test: /\.coffee$/, loader: 'coffee-loader' }
                ]
            }
        });

});

