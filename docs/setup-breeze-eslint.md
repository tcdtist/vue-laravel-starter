# Setup: Install Breeze and ESLint

## Install Laravel Breeze

We install [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze-and-inertia) starter kit.

```bash
composer require laravel/breeze --dev
```

We choose [Vue](https://vuejs.org/) version of Breeze with [Inertia](https://inertiajs.com/). Let's run the follow command:

```bash
php artisan breeze:install vue
```

After running a lot of commands in the background, it should bring us Laravel homepage, with this screen after you click Register in the top-right.

<img src="https://laraveldaily.com/uploads/2023/07/food-delivery-breeze-install.png" width=600 />

Of course, registration doesn't work yet, because we haven't run migrations, but we will take care of that in the next lesson, when setting up roles and permissions.

</br>

## Install/Configure ESLint

While this is not a requirement, but I do advise to use Linters. They provide consistent code styling and formatting for your Vue and JS files.

While ESLint is a relatively easy requirement for the project, ha ESLint is installed with Prettier via npm command:

```npm
npm install --save-dev @rushstack/eslint-patch @vue/eslint-config-prettier eslint eslint-plugin-vue prettier
```

</br>

## Configure ESLint

Now let's define our configuration for ESLint and Prettier.

Create a new **.eslintrc.cjs** file in your project directory:

```javascript
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  extends: [
    'plugin:vue/vue3-recommended',
    'eslint:recommended',
    '@vue/eslint-config-prettier'
  ],
  parserOptions: {
    ecmaVersion: 'latest'
  },
  rules: {
    eqeqeq: ['error', 'always'],
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'vue/multi-word-component-names': 'off',
    'no-undef': 'off'
  }
}
```

Create a new **.prettierrc.json** file in your project directory.

```json
{
  "$schema": "https://json.schemastore.org/prettierrc",
  "semi": false,
  "tabWidth": 2,
  "singleQuote": true,
  "printWidth": 100,
  "trailingComma": "none"
}
```

Create a new **.editorconfig** file in your project directory and install [vscode extension](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig).

```json
root = true

[*]
charset = utf-8
end_of_line = lf
indent_size = 2
indent_style = space
insert_final_newline = true
trim_trailing_whitespace = true

[*.php]
indent_size = 4

[*.md]
trim_trailing_whitespace = false
```

And finally, define the lint command to your **package.json** file.

```json
"scripts": {
    "format": "prettier 'resources/{js,vue}/**/*.{js,vue}' --write",
    "lint": "eslint ./ --ext .vue,.js,.cjs --fix --ignore-path .gitignore"
}
```

</br>

For more information, visit [Laravel Vue Inertia: Food Ordering Project Step-By-Step](https://laraveldaily.com/lesson/laravel-vue-inertia-food-delivery/setup-install-breeze-eslint)
