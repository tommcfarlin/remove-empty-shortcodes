=== Remove Empty Shortcodes ===
Contributors: tommcfarlin
Tags: shortcodes, content, cleanup, maintenance, content management
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 0.6.0
Requires PHP: 7.4
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

Automatically removes empty or inactive shortcodes from your content while preserving your original database entries.

== Description ==

Remove Empty Shortcodes helps maintain clean content by removing shortcodes that no longer work or generate output. This commonly happens when:

* You've deactivated a plugin that provided shortcodes
* You're trying different plugins and some left behind inactive shortcodes
* You have shortcodes from plugins that weren't properly uninstalled

= Key Features =

* Automatically removes inactive shortcodes from displayed content
* Preserves your original content in the database
* Works with both posts and pages
* Handles both self-closing and wrapped shortcodes
* Zero configuration required

= How It Works =

The plugin checks your content for shortcodes when pages are displayed. If it finds shortcodes that:
* Don't produce any output
* Aren't registered with WordPress
* Are empty or inactive

It removes them from the displayed content while keeping your original content intact in the database.

= Use Cases =

* Clean up content after removing plugins that used shortcodes
* Remove inactive shortcodes without editing posts manually
* Maintain clean content for readers and search engines
* Preserve original content in case you reinstall removed plugins

== Installation ==

1. Upload `remove-empty-shortcodes` to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it! No configuration needed

== Frequently Asked Questions ==

= Will this modify my database content? =

No. The plugin only filters content when it's displayed. Your original content remains unchanged in the database.

= What happens if I reinstall a plugin that uses the removed shortcodes? =

Since your original content is preserved, the shortcodes will start working again automatically when you reinstall the plugin that handles them.

= Does this work with all shortcodes? =

Yes, the plugin works with any WordPress shortcode, whether from themes or plugins.

= Will this affect shortcodes that are working correctly? =

No. The plugin only removes shortcodes that are either unregistered or produce no output.

= Is there any configuration needed? =

No. The plugin works automatically once activated.

== Changelog ==

= 0.6.0 =
* Added support for multi-line shortcode detection
* Added a banner and icon for the WP plugin repository
* Improved handling of unregistered shortcodes
* Updated shortcode pattern matching
* Removed Composer dependencies
* Enhanced performance and reliability

= 0.5.0 =
* Added latest version of PHPStan
* Fixed page content processing
* Updated namespace structure

= 0.4.0 =
* Added page post type support
* Fixed subscriber content handling

= 0.3.0 =
* Initial public release
* Added standard post type support
* Improved shortcode detection

== Upgrade Notice ==

= 0.6.0 =
Improved shortcode detection and removal with better support for multi-line shortcodes. Removes Composer dependency for simpler installation.