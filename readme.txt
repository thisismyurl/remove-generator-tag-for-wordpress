=== WP Remove Generator Meta Tag ===
Contributors: thisismyurl
Tags: generator, security, header, version, hardening
Requires at least: 6.4
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 16.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Removes the WordPress version meta generator tag from your site head and from every feed format.

== Description ==

I keep running into hardened WordPress sites where someone forgot to strip the generator tag, and version fingerprinting still gets sites compromised in 2026. I built this plugin for the same reason I built the first version of it back in 2010: it should already be a default in core, and it isn't.

By default WordPress prints `<meta name="generator" content="WordPress X.Y.Z">` in the `<head>` of every page, plus matching generator strings in every feed format. That tag tells anyone scanning the public web exactly which version of WordPress you run. Useful for attackers cross-referencing known-vulnerable releases. Useless for everyone else.

This plugin removes the generator output from:

* The `<head>` of every front-end page.
* Every feed format WordPress emits — RSS2, RSS, RDF, Atom, comments feeds, OPML, and the Atom Publishing endpoint.
* Any plugin or SEO tool that calls `get_the_generator()` directly.

Small, single-purpose plugin. No settings page, no admin chrome, no tracking. Activate it and it works. Deactivate it and it leaves no trace.

Originally published 2010, rewritten 2026 for current WordPress.

= About the author =

Built and maintained by Christopher Ross — 25 years working with WordPress, currently running a senior-dev consulting practice at This Is My URL. More plugins, writing, and case studies at [thisismyurl.com](https://thisismyurl.com/).

== Installation ==

1. Install through the WordPress plugin directory or upload the plugin folder to `/wp-content/plugins/`.
2. Activate it from the **Plugins** menu in WordPress admin.
3. Reload any front-end page and search the HTML source for `generator`. The tag should be absent.

== Frequently Asked Questions ==

= How do I confirm it's working? =

Before activation, view the source of any page on your site and search for the word `generator`. You should see a meta tag exposing your WordPress version. After activation, clear any caching layer, reload, and search again. The tag should be gone. Check one of your feeds (`/feed/`) the same way.

= Will this conflict with my SEO or security plugin? =

No. Removing the generator tag is a documented WordPress capability and several SEO and hardening plugins do the same thing. If another plugin already removes it, this one is a harmless no-op. Running both is unnecessary but safe.

= Does this make my site secure? =

It removes one small piece of public information attackers use to fingerprint your install. That is the entire claim. It is not a security plugin on its own. Keep WordPress, themes, and plugins updated, use strong passwords and two-factor authentication, and reach for a dedicated hardening plugin if you want broader coverage.

= What about the version string in enqueued asset URLs (`?ver=X.Y.Z`)? =

Out of scope. This plugin only handles the generator meta tag and feed generator strings. Asset version stripping is a separate concern with real cache-busting trade-offs, and I'd rather do one thing correctly than two things halfway.

== Changelog ==

= 16.0.0 =
* Full rewrite from scratch for 2026.
* Modern PHP (`declare(strict_types=1)`, namespaces, `Requires PHP: 7.4`).
* Now also removes the generator string from feed output, not just `<head>`.
* Filters `get_the_generator_*` so plugins calling the helper directly also receive an empty string.
* Removed the bundled "common framework," donate prompt, and admin settings page.
* Single-file plugin with no enqueued assets and no admin UI.
* WordPress Coding Standards (WPCS) clean.

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
Full rewrite. Now strips the generator string from feeds as well as `<head>`. No settings or admin UI in this version. If you used the donate page from earlier releases, that page no longer exists.
