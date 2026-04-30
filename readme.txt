=== WP Remove Generator Meta Tag ===
Contributors: thisismyurl
Tags: generator, security, header, version, hardening
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 16.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Removes the WordPress version meta generator tag from your site head and feed output.

== Description ==

By default WordPress prints a `<meta name="generator" content="WordPress X.Y.Z">` tag in the `<head>` of every page on your site, plus matching generator strings in every feed format. That tag tells anyone scanning the public web exactly which version of WordPress you run — useful for attackers looking for known-vulnerable releases, useless for everyone else.

This plugin removes the generator tag from:

* The `<head>` of every page.
* Every feed format WordPress emits — RSS2, RSS, RDF, Atom, comments feeds, OPML, and the Atom Publishing endpoint.
* Any plugin or SEO tool that calls `get_the_generator()` directly.

It does this with a small, single-file PHP plugin. There are no settings, no admin pages, no enqueued assets, and no third-party services. Activate it and the tag is gone.

== Installation ==

1. Install through the WordPress plugin directory or upload the plugin folder to `/wp-content/plugins/`.
2. Activate it from the **Plugins** menu in WordPress admin.
3. Reload any page on the front end and search the HTML source for `generator`. The tag should be absent.

== Frequently Asked Questions ==

= How do I confirm it's working? =

Before activation, view the source of any page on your site and search for the word `generator`. You should see a meta tag exposing your WordPress version. After activation, reload the page (clear any caching layer first) and search again — the tag should be gone.

= Does this break any plugins or themes? =

No. Removing the generator tag is a documented WordPress capability and many SEO and security plugins do the same thing. If another plugin already removes it, this plugin is a harmless no-op.

= Does this make my site secure? =

It removes one small piece of public information that attackers can use to fingerprint your installation. It is not a security plugin on its own — keep WordPress, your themes, and your plugins updated, use a strong password and two-factor authentication, and consider a hardening plugin for broader protection.

= I'm using an SEO plugin that already removes this. Should I uninstall one of them? =

Either one works. The plugins won't conflict, but running both is unnecessary if your SEO plugin already covers it.

== Changelog ==

= 16.0.0 =
* Full rewrite from scratch for 2026.
* Modern PHP (`declare(strict_types=1)`, namespaces, `Requires PHP: 7.4`).
* Now also removes the generator string from feed output, not just `<head>`.
* Removed the bundled "common framework," donate prompt, and admin settings page.
* Single-file plugin with no enqueued assets and no admin UI.
* Plugin is now WordPress Coding Standards (WPCS) clean.

= 15.01 =
* Tested for WordPress 4.1.
* Added OOP class structure.
* Migrated to common plugin structure.

= 2.0.1 =
* Minor code cleanup.

= 2.0 =
* Reviewed for WP guidelines, removed footer comment, removed control panels.

= 1.0.0 =
* First release.

== Upgrade Notice ==

= 16.0.0 =
Full rewrite. Now removes the generator tag from feeds in addition to `<head>`. No settings or admin UI. If you used the donate page from earlier versions, that page no longer exists.
