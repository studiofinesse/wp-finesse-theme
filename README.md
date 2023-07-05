# WP Finesse Theme
> Base theme from which to develop customer WordPress projects

## Development

```sh
# Compile assets & watch for changes
npm start

# Start a specific asset task
npm start -- [task]

# See all available asset tasks
npm start -- --tasks

# Compile production-ready assets
npm build
```

## Browsersync

Enable with a `browsersync.json` [config](https://browsersync.io/docs/options) in this project's root e.g.

```json
{
    "proxy": "localhost:8080"
}
```