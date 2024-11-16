# Setup: Install Husky, Conventional Commits and Pint

## Install dependecies

First initialize a git repository with the follow command:

```npm
git init
```

</br>
We install required dependencies. Let's run the follow npm command:

```npm
npm install -D husky lint-staged @commitlint/cli @commitlint/config-conventional
```

</br>
And finally, We install the Pint packege to format and review php code. Let's run the follow command:

```bash
composer require laravel/pint --dev
```

</br>

## Config husky tasks

First run the follow command:

```npm
npx husky install
```

Create the husky tasks with the follow commands:

```npm
npx husky add .husky/pre-commit "npm run pre-commit"
npx husky add .husky/commit-msg 'npx --no -- commitlint --edit "$1"'
```

define the pre-commit command to your **package.json** file.

```json
"scripts": {
  "format-php": "./vendor/bin/pint --preset laravel ./**/*.php",
  "pre-commit": "lint-staged --allow-empty"
}
```

Create a new .commitlintrc file

```json
{
  "extends": [
    "@commitlint/config-conventional"
  ]
}
```

## Install Pint package

Let's run the follow command:

```bash
composer require laravel/pint --dev
```

Finally, add the follow script command in your package.json file

```json
 "lint-staged": {
    "resources/{js,vue}/**/*.{js,vue}": [
      "eslint --fix --ignore-path .gitignore",
      "prettier --write"
    ],
    "**/*.php": "./vendor/bin/pint --preset laravel"
  }
```
