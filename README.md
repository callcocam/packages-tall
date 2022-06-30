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
    .copy('resources/js/scroll.js', 'public/js/asset/scroll.js')
    .react();

if (mix.inProduction()) {
    mix.js('packages/tall-theme/resources/js/app.js', 'packages/tall-theme/resources/js/assets/tall.js');
    mix.version();
}

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
#ALTER MODE USER  AS VIEWS

```
use Illuminate\Foundation\Auth\User as Authenticatable;
to
use Tall\Acl\Models\User as Authenticatable;



```

#PUBLICAR AS FACTORIES E SEEDERS

```
./vendor/bin/sail artisan vendor:publish --tag=tenant-factories --force
 or 
sail artisan vendor:publish --tag=tenant-factories --force

```

#RODAR AS MIGRATIONS E SEEDERS
Use a tag --seed para criar dados fakes
```
banco novo --> ./vendor/bin/sail artisan migrate --seed
reacriar banco --> ./vendor/bin/sail artisan migrate:fresh --seed

```

#PUBLICAR AS CONFIG

```

sail artisan vendor:publish --tag=tall-theme-config --force

```

#PUBLICAR AS VIEWS

```

sail artisan vendor:publish --tag=tall-theme-views --force

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
