<?php
/**
 * Plugin Name:       WP Remove Generator Meta Tag
 * Plugin URI:        https://thisismyurl.com/plugins/remove-generator-meta-tag/
 * Description:       Removes the WordPress version meta generator tag from the site head and feed output.
 * Version:           16.6148.2110
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Christopher Ross
 * Author URI:        https://thisismyurl.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       remove-generator-tag-for-wordpress
 *
 * @package ThisIsMyURL\RemoveGenerator
 */

declare( strict_types = 1 );

namespace ThisIsMyURL\RemoveGenerator;

defined( 'ABSPATH' ) || exit;

const VERSION = '16.6147';

/**
 * Detach every WordPress generator emitter at boot.
 *
 * Core prints the generator tag in `<head>` via `wp_generator()` and in feed
 * output via `the_generator()` on a handful of per-format hooks. Removing
 * both is what users actually expect when they install a "remove generator"
 * plugin — not just hiding the head tag while leaving the feeds leaky.
 */
function bootstrap(): void {
	remove_action( 'wp_head', 'wp_generator' );

	$feed_hooks = [
		'rss2_head',
		'commentsrss2_head',
		'rss_head',
		'rdf_header',
		'atom_head',
		'comments_atom_head',
		'opml_head',
		'app_head',
	];

	foreach ( $feed_hooks as $hook ) {
		remove_action( $hook, 'the_generator' );
	}

	$generator_filters = [
		'get_the_generator_html',
		'get_the_generator_xhtml',
		'get_the_generator_atom',
		'get_the_generator_rss2',
		'get_the_generator_rdf',
		'get_the_generator_comment',
		'get_the_generator_export',
	];

	foreach ( $generator_filters as $filter ) {
		add_filter( $filter, __NAMESPACE__ . '\\suppress_generator_string', 10, 0 );
	}
}

/**
 * Returns an empty string so any direct caller of `get_the_generator()`
 * also gets a blank result. Belt-and-suspenders for plugins, themes, or
 * SEO tools that may call the helper independently of the head/feed hooks.
 *
 * @return string
 */
function suppress_generator_string(): string {
	return '';
}

bootstrap();
