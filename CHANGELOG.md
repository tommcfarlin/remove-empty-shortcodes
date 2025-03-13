# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.6.0] - 2025-03-13

### Added

* Add functionality to remove empty shortcodes from post and page content without altering the database.

### Fixed

* Fix issue where shortcodes spanning multiple lines were not being detected and removed.
* Fix issue where unregistered shortcodes were not being removed.

### Updated

* Update regex pattern to match any shortcode, not just default WordPress shortcodes.
* Improve logging for debugging purposes (removed in final version).

### Removed

* Libraries installed by Composer and Composer itself to streamline the core functionality of the plugin.
* Remove PHP Composer workflow and `composer.json` file

## [0.5.0] - 2019-12-16

### Added

* Add latest version of PHPStan to GrumPHP sniffs

### Fix

* Fix issue where page content is being stripped.

### Update

* Update namespaces to all start at the top level of `TomMcFarlin`

## [0.4.0] - 2019-12-03

### Add

* Add support for standard `page` post types, too

### Fix

* Subscriber conditional for not responded `$content` properly

## [0.3.0] - 2019-11-29

### Add

* Add functionality specifically for the standard post type

### Updated

* Update the plugin to focus on all shortcodes (rather than just one)
* Update Composer and code quality files for renaming the plugin
* Updates namespace and comments

## Fix

* Improperly formed conditional

### Removed

* Remove destrict-content bootstrap for remove-empty-shortcodes

## [0.2.0] - 2019-11-24

### Added
* Add Shortcode Manager for processing shortcodes

### Updated

* Update version number
* Update PostContentProcessor to use the Shortcode Manager
* Update cache file
* Update TODO.md

## [0.1.0] - 2019-11-24

### Added
* Initial release for removing Restrict Content Pro shortcodes
