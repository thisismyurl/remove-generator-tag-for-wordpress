# WP Remove Generator Meta Tag

Single-file WordPress plugin that removes the WordPress version meta generator tag from your site head **and** feed output.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/)
[![Rating](https://img.shields.io/wordpress/plugin/r/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/#reviews)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL_v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0)

---

## Why this exists

By default, every page WordPress renders includes a `<meta name="generator" content="WordPress X.Y.Z">` tag in `<head>`, plus matching generator strings in every feed format. That tag tells anyone scanning the public web exactly which version of WordPress your site runs — useful for attackers looking for known-vulnerable releases, useless for everyone else.

This plugin removes the tag and its feed equivalents with a small, single-file PHP plugin.

## What it does

- Removes the tag from the `<head>` of every page.
- Removes the generator string from every feed format WordPress emits — RSS2, RSS, RDF, Atom, comments feeds, OPML, and the Atom Publishing endpoint.
- Filters `get_the_generator()` calls so plugins or SEO tools that invoke the helper directly also see an empty string.
- Single file. No settings, no admin UI, no enqueued assets, no third-party services.

## Requirements

- WordPress 6.4 or later.
- PHP 7.4 or later.

## Installation

1. Install through the [WordPress plugin directory](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/) or upload the plugin folder to `wp-content/plugins/`.
2. Activate it from **Plugins** in WordPress admin.
3. Reload any front-end page and search the HTML source for `generator`. The tag should be absent.

## How it works

```php
// In wp-remove-generator-meta.php
remove_action( 'wp_head', 'wp_generator' );

foreach ( $feed_hooks as $hook ) {
    remove_action( $hook, 'the_generator' );
}

foreach ( $generator_filters as $filter ) {
    add_filter( $filter, __NAMESPACE__ . '\\suppress_generator_string', 10, 0 );
}
```

The plugin hooks at boot — no `init`, no `wp_loaded`, no settings to read. WordPress core defines `wp_generator` and `the_generator` early in the request lifecycle, so detaching them at file load is the cheapest path.

## Development

```sh
composer install
composer run lint:phpcs
```

PHPCS is configured to the WordPress-Extra ruleset with PHPCompatibilityWP for PHP 7.4+ checks. CI runs the same on every push.

## Changelog

See [`readme.txt`](readme.txt) for the full WordPress.org changelog.

## License

GPL v2 or later. See [LICENSE](LICENSE).

## Author

Christopher Ross — [thisismyurl.com](https://thisismyurl.com/)
