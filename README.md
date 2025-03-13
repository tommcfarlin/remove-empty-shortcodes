# Remove Empty Shortcodes

**TL;DR:** Removes all empty shortcodes from WordPress posts and pages without altering the content in the database.

If you've ever installed a plugin that requires a shortcode and used the plugin for an extended period, much of your content likely includes that shortcode.

If you choose to disable that plugin and it doesn't properly clean up after itself, much of your content will include shortcodes that don't mean anything to your readers.

This plugin removes the shortcode from what both users and search engines see. As of version `0.3.0`, it does not remove the information from the database, so if you ever reinstall the plugin, the shortcode functionality will continue to work.

## Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Select `remove-empty-shortcodes.zip` from your computer
3. Upload
4. Activate the plugin on the WordPress Plugin Dashboard

### Using FTP

1. Extract `remove-empty-shortcodes.zip` to your computer
2. Upload the `remove-empty-shortcodes` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard
