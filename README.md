#TAL FORM TABLE

#ALTERANDO O MIX PARA INCLUIR o MIX DO PACOTE
```
mix
.js('resources/js/app.js', 'public/js')
.js('vendor/callcocam/packages-tall/tall-theme/resources/js/app.js', 'public/js/assets')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('vendor/callcocam/packages-tall/tall-theme/resources/css/app.css', 'public/css/assets', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
     .copy('vendor/callcocam/packages-tall/tall-theme/resources/js/scroll.js', 'public/js/asset/scroll.js')
    .react();
```

#INSTALL SORTABLE 

```
https://github.com/livewire/sortable

./vendor/bin/sail npm i livewire-sortable --save-dev

```

#INSTALL PACKAGES JS 

```
./vendor/bin/sail npm i @tailwindcss/aspect-ratio

./vendor/bin/sail npm i tw-elements


```
#ALTER MODE USER

```
use Illuminate\Foundation\Auth\User as Authenticatable;
para
use Tall\Acl\Models\User as Authenticatable;

Registra a Factory Menu em config/app.php 'aliases'

  'Menu' => Tall\Menus\Facades\Menu::class,


```

#ADD PHPMYADMIN DOCKERCOMPOSER

```
pode ser abaixo  do serviço do mysql

phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    links:
        - mysql
    ports:
        - 8001:80
    environment:
        - PMA_ARBITRARY=1
        - UPLOAD_LIMIT=100m
    networks:
        - sail

```

```

#ALTERAR A TABLE SESSIONS

```

Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
   //$table->foreignId('user_id')->nullable()->index();
    $table->foreignUuid('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});

tambem pode dar alguns comflitos com a tabela de users
```

```

#PUBLICAR AS FACTORIES E SEEDERS

```
./vendor/bin/sail artisan vendor:publish --tag=tenant-factories --force
 or 
sail artisan vendor:publish --tag=tenant-factories --force

```

#PUBLICAR OS JS FILES PRINCIPALMENTE PARA O ADMIN

```
./vendor/bin/sail artisan vendor:publish --tag=tall-theme-js --force
 or 
sail artisan vendor:publish --tag=tall-theme-js --force

```

#RODAR AS MIGRATIONS E SEEDERS
Use a tag --seed para criar dados fakes
```
banco novo --> ./vendor/bin/sail artisan migrate --seed
recriar banco --> ./vendor/bin/sail artisan migrate:fresh --seed

Será gerado um user:
    email: test@example.com
    password: password

```

#PUBLICAR AS CONFIG

```

./vendor/bin/sail  artisan vendor:publish --tag=tall-theme-config --force

```

#PUBLICAR AS VIEWS

```

./vendor/bin/sail artisan vendor:publish --tag=tall-theme-views --force

```

#PUBLICAR AS VIEWS

```

./vendor/bin/sail artisan vendor:publish --tag=tall-theme-img --force


```

## Migrating from Vite to Laravel Mix

### Install Laravel Mix

First, you will need to install Laravel Mix using your npm package manager of choice:

```shell
npm install --save-dev laravel-mix
```

### Configure Mix

Create a `webpack.mix.js` file in the root of your project:

```
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
```

### Update NPM scripts

Update your NPM scripts in `package.json`:

```diff
  "scripts": {
-     "dev": "vite",
-     "build": "vite build"
+     "dev": "npm run development",
+     "development": "mix",
+     "watch": "mix watch",
+     "watch-poll": "mix watch -- --watch-options-poll=1000",
+     "hot": "mix watch --hot",
+     "prod": "npm run production",
+     "production": "mix --production"
  }
```

#### Inertia

Vite requires a helper function to import page components which is not required with Laravel Mix. You can remove this as follows:

```diff
- import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

  createInertiaApp({
      title: (title) => `${title} - ${appName}`,
-     resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
+     resolve: (name) => require(`./Pages/${name}.vue`),
      setup({ el, app, props, plugin }) {
          return createApp({ render: () => h(app, props) })
              .use(plugin)
              .mixin({ methods: { route } })
              .mount(el);
      },
  });
```

### Update environment variables

You will need to update the environment variables that are explicitly exposed in your `.env` files and in hosting environments such as Forge to use the `MIX_` prefix instead of `VITE_`:

```diff
- VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
- VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
+ MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
+ MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

You will also need to update these references in your JavaScript code to use the new variable name and Node syntax:

```diff
-    key: import.meta.env.VITE_PUSHER_APP_KEY,
-    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
+    key: process.env.MIX_PUSHER_APP_KEY,
+    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
```

### Remove CSS imports from your JavaScript entry point(s)

If you are importing your CSS via JavaScript, you will need to remove these statements:

```js
- import '../css/app.css';
```

### Replace `@vite` with `mix()`

You will need to replace the `@vite` Blade directive with `<script>` and `<link rel="stylesheet">` tags and the `mix()` helper:

```diff
- @viteReactRefresh
- @vite('resources/js/app.js')
+ <link rel="stylesheet" href="{{ mix('css/app.css') }}">
+ <script src="{{ mix('js/app.js') }}" defer></script>
```

### Remove Vite and the Laravel Plugin

Vite and the Laravel Plugin can now be uninstalled:

```shell
npm remove vite laravel-vite-plugin
```

Next, you may remove your Vite configuration file:

```shell
rm vite.config.js
```


### Configure tailwind.config

```shell

const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    presets:[
        require('./vendor/wireui/wireui/tailwind.config.js'),
        require('./vendor/callcocam/packages-tall/tailwind.config.js'),
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};

```