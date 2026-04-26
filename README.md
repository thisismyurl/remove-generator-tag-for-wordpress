# WP Remove Generator Meta Tag

Removes the WordPress version `<meta name="generator">` tag from your site `<head>`. Originally published on the WordPress.org plugin directory in 2010 and maintained through 2016. Still functional on modern WordPress because the underlying `wp_head` hook signature has not changed.

[![WordPress.org](https://img.shields.io/wordpress/plugin/installs/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/)
[![Rating](https://img.shields.io/wordpress/plugin/r/remove-generator-tag-for-wordpress.svg)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/#reviews)

## Why this exists

WordPress publishes its version number in the `<head>` of every page by default. Telling the world which WordPress version you run is a small but unnecessary security signal — anyone scanning for known-vulnerable versions can find sites to target with a single curl request.

This plugin removes that meta tag with a single line of code wrapped in a clean OOP class.

## Features

- Removes `<meta name="generator" content="WordPress X.Y.Z" />` from your `<head>`.
- Zero configuration. Activate it and it works.
- No admin pages, no settings, no payload.
- Multilingual support included (English, German, French).

## Requirements

- WordPress 3.2.0 or later (tested through 4.1; works on modern WP).
- PHP 5.3+.

## Installation

1. Upload the plugin folder to `wp-content/plugins/` or install via the WordPress.org directory.
2. Activate the plugin from **Plugins** in WordPress admin.
3. Reload any page on the front end and view-source — the generator tag is gone.

## How to verify it works

Before installing, view the HTML source of any page on your site and search for `generator`. You should see a meta tag exposing your WordPress version.

After installing, reload the page (clearing cache if needed) and search for `generator` again. The tag should be absent.

## Status

Maintenance mode. Active installs: ~200 across the WordPress community.
The plugin is intentionally minimal and does not need active development.

For active development of WordPress + SEO tooling, see [thisismyurl.com](https://thisismyurl.com/).

## License

GPL v2 or later.

## Contributors

- Christopher Ross — original author
- Meagan Hanes — co-maintainer

