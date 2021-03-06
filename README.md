# WPackIO Repro

## Setup

This is a standard plugin that can be dropped into any WordPress installation. And WPackIO is initialized the standard way.

1. First clone or in any other way put these files inside the plugins directory of a WordPress installation
2. Then run the following scripts to install dependencies and build files

```sh
// First install all js dependencies
yarn
// or
npm install

// Then install php dependencies
composer install

// Finally build production files
yarn build
// or
npm build
```

3. Activate the plugin

By default the built files will work since `useBabelConfig` is set to `true`. If you change `useBabelConfig` to `false` and try to rebuild the files the app wont work anymore (atleast on the front end).

## Issue

I have an issue where my built files complain about `regeneratorRuntime` gone
missing.

```js
Uncaught ReferenceError: regeneratorRuntime is not defined
    at Object.<anonymous> (app.js:1)
    at i (bootstrap:78)
    at Object.<anonymous> (main-c1ba787b.js?ver=1.0.0:18)
    at i (bootstrap:78)
    at t (bootstrap:45)
    at Array.r [as push] (bootstrap:32)
    at main-c1ba787b.js?ver=1.0.0:18
```

The strange this though is that the error only gets thrown on the front end, not on the admin pages. I suspect that this has something to do with WordPress using babel while building there js and therefore `regeneratorRuntime` is already injected.

## Solution

It's not an uncommon issue in the world of transpiled JavaScript. But the solution is quite simple:

```js
const babelConfig = {
  // ...other configs,
  plugins: [
    // ...other plugins,
    '@babel/plugin-transform-runtime',
  ],
};
```

But while investigating this issue I found another issue as well – the `jsBabelPresetOptions` and `jsBabelOverride` props inside `wpackio.project.js` never gets applied. Therefore the only way to add the new plugin to an existing project is to create my own `babel.config.js` and apply it there.

I would argue that WPackIO should add `@babel/plugin-transform-runtime` by default, much like [`create-react-app` does](https://github.com/facebook/create-react-app/blob/4b8b38bf7c55326f8d51ea9deeea76d7feee307d/packages/babel-preset-react-app/create.js#L169).
