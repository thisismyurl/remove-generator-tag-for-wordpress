# WP Remove Generator Meta Tag

Single-file WordPress plugin that strips the WordPress version meta generator tag from your site head **and** every feed format.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/)
[![Rating](https://img.shields.io/wordpress/plugin/r/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/#reviews)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL_v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0)

---

## Why this exists

I keep running into hardened WordPress sites where someone forgot to strip the generator tag, and version fingerprinting still gets sites compromised in 2026. I built this plugin for the same reason I built the first version of it back in 2010: it should already be a default in core, and it isn't.

Originally published 2010. Rewritten 2026 for current WordPress.

## What it does

- Removes `<meta name="generator">` from `<head>` on every front-end page.
- Removes the generator string from every feed format WordPress emits — RSS2, RSS, RDF, Atom, comments feeds, OPML, and the Atom Publishing endpoint.
- Filters `get_the_generator_*` so SEO and security plugins that call the helper directly also receive an empty string.

## What it does *not* do

- Strip `?ver=X.Y.Z` from enqueued asset URLs. That has real cache-busting trade-offs and belongs in a separate plugin.
- Render an admin page, settings screen, or notices.
- Enqueue CSS, JS, or images.
- Phone home, log telemetry, or contact any third-party service.

Small, single-purpose plugin. No settings page, no admin chrome, no tracking. Activate it and it works. Deactivate it and it leaves no trace.

## Requirements

- WordPress 6.4 or later.
- PHP 7.4 or later.

## Installation

1. Install through the [WordPress plugin directory](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/) or upload the plugin folder to `wp-content/plugins/`.
2. Activate it from **Plugins** in WordPress admin.
3. Reload any front-end page and search the HTML source for `generator`. The tag should be absent. Check `/feed/` the same way.

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

The plugin hooks at boot — no `init`, no `wp_loaded`, no settings to read. WordPress core registers `wp_generator` and `the_generator` early in the request lifecycle, so detaching them at file load is the cheapest path. The `get_the_generator_*` filter set covers every helper variant (`html`, `xhtml`, `atom`, `rss2`, `rss`, `comment`, `export`) so anything calling the helper directly receives an empty string instead of the version.

## Development

```sh
composer install
composer run lint:phpcs
```

PHPCS runs against the WordPress-Extra ruleset with PHPCompatibilityWP set to PHP 7.4+. CI runs the same on every push. The plugin is one file; reading the source is the documentation.

## Changelog

See [`readme.txt`](readme.txt) for the full WordPress.org changelog.

## License

GPL v2 or later. See [LICENSE](LICENSE).

## Author

Built and maintained by Christopher Ross — 25 years working with WordPress, currently running a senior-dev consulting practice at This Is My URL. More plugins, writing, and case studies at [thisismyurl.com](https://thisismyurl.com/).
