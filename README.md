# WP Remove Generator Meta Tag

[![WordPress](https://img.shields.io/badge/WordPress-6.4%2B-blue)](https://wordpress.org/plugins/remove-generator-tag-for-wordpress/) [![License](https://img.shields.io/badge/License-GPL--2.0-blue)](LICENSE)

Single-file WordPress plugin that strips the WordPress version meta generator tag from your site head **and** every feed format.

## Why this exists

I keep running into hardened WordPress sites where someone forgot to strip the generator tag, and version fingerprinting still gets sites compromised in 2026. I built this plugin for the same reason I built the first version back in 2010: it should already be a default in core, and it isn't.

Originally published in 2010. Rewritten in 2026 for current WordPress.

## What it does

- Removes `<meta name="generator">` from `<head>` on every front-end page.
- Removes the generator string from every feed format WordPress emits — RSS2, RSS, RDF, Atom, comments feeds, OPML, and the Atom Publishing endpoint.
- Filters `get_the_generator_*` so SEO and security plugins that call the helper directly also receive an empty string.

## What it doesn't do

- Strip `?ver=X.Y.Z` from enqueued asset URLs. That has real cache-busting trade-offs and belongs in a separate plugin.
- Render an admin page, settings screen, or notices.
- Enqueue CSS, JS, or images.
- Phone home, log telemetry, or contact any third-party service.

It's a small, single-purpose plugin. No settings page, no admin chrome, no tracking. Activate it and it works. Deactivate it and it leaves no trace.

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

The plugin hooks at boot — no `init`, no `wp_loaded`, no settings to read. WordPress core registers `wp_generator` and `the_generator` early in the request lifecycle, so detaching them at file load is the cheapest path. The `get_the_generator_*` filter set covers every helper variant (`html`, `xhtml`, `atom`, `rss2`, `rss`, `comment`, `export`), so anything calling the helper directly receives an empty string instead of the version.

## Development

```sh
composer install
composer run lint:phpcs
```

PHPCS runs against the WordPress-Extra ruleset with PHPCompatibilityWP set to PHP 7.4+. CI runs the same on every push. The plugin is one file; reading the source is the documentation.

## Changelog

See [releases](../../releases) or [readme.txt](readme.txt).

---

## Support and donations

I build these tools because WordPress sites in the wild keep hitting the same problems, and a small, focused plugin is usually the right fix. They're free to use, with no tracking and no ads.

If one of them saves you time, here are the genuine ways to help:

- **Sponsor the work.** [GitHub Sponsors](https://github.com/sponsors/thisismyurl) is the simplest way, and the Sponsor button at the top of this repo lists it alongside Bitcoin, Dogecoin, PayPal, and Interac e-transfer. Any amount helps, and none of it is expected.
- **Contribute code or ideas.** A pull request, a bug report, or a tested edge case is worth as much as a donation. See [CONTRIBUTING.md](CONTRIBUTING.md) to get started.
- **Share it.** A note on [WordPress.org](https://profiles.wordpress.org/thisismyurl/), [GitHub](https://github.com/thisismyurl), or [LinkedIn](https://linkedin.com/in/thisismyurl) helps other people find work that might save them the same afternoon.

### Report issues and questions

- **Found a bug or want a feature?** Open an issue on the [Issues](../../issues) tab. Include your WordPress and PHP versions and the steps to reproduce it.
- **Have a question?** Start a thread on the [Discussions](../../discussions) tab.

### Contributing code

Code contributions are welcome. The short version:

1. Fork the repository and clone your fork.
2. Create a branch with a clear name, like `feature/short-descriptive-name`.
3. Make your change and test it against the edge cases.
4. Run the coding-standards check before you open the pull request.
5. Open a pull request that explains what changed and why.

The full workflow and standards live in [CONTRIBUTING.md](CONTRIBUTING.md). Contributing is never required, but it is always appreciated.

## About This Is My URL

This plugin is built and maintained by [This Is My URL](https://thisismyurl.com/), the WordPress development and technical SEO practice of Christopher Ross. I help teams build WordPress sites that stay secure, fast, and maintainable, and I write small, focused plugins like this one for the problems those sites keep running into.

### My background

- On the web since 1996, and in WordPress since 2007
- WordPress.org plugin developer with 19 plugins published since 2009
- Technical SEO practitioner focused on performance, security, and search visibility
- Lead instructor and curriculum architect at the M.L. Campbell Training Center, the Sherwin-Williams® international training facility for its industrial wood division

### Ways to connect

- **Website:** [thisismyurl.com](https://thisismyurl.com/)
- **WordPress.org:** [profiles.wordpress.org/thisismyurl](https://profiles.wordpress.org/thisismyurl/)
- **GitHub:** [github.com/thisismyurl](https://github.com/thisismyurl)
- **LinkedIn:** [linkedin.com/in/thisismyurl](https://linkedin.com/in/thisismyurl)

## Contributors

- **Christopher Ross** ([@thisismyurl](https://github.com/thisismyurl)) — author and maintainer
- Thanks to everyone who has reported issues, tested edge cases, and contributed code

## License

GPL-2.0-or-later — see [LICENSE](LICENSE) or [gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).

---
*This project follows the [10 Core Pillars](PILLARS.md). Support quality work [here](https://github.com/sponsors/thisismyurl).*
