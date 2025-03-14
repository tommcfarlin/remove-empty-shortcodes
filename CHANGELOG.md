# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.6.0] - 2025-03-13
### Added
- Functionality to remove empty shortcodes from posts and pages
- Support for multi-line shortcode detection

### Changed
- Updated regex pattern to match any shortcode type
- Improved shortcode detection and processing

### Removed
- Composer dependencies and workflow
- Debug logging statements from production code

## [0.5.0] - 2019-12-16
### Added
- PHPStan integration with GrumPHP

### Changed
- Restructured namespaces to use `TomMcFarlin` as root

### Fixed
- Issue with page content being incorrectly stripped

## [0.4.0] - 2019-12-03
### Added
- Support for `page` post type

### Fixed
- Subscriber conditional content processing

## [0.3.0] - 2019-11-29
### Added
- Support for standard post type processing
- Universal shortcode processing capability

### Changed
- Refactored plugin to handle all shortcode types
- Updated namespace structure and documentation

### Removed
- Restrict Content bootstrap code

## [0.2.0] - 2019-11-24
### Added
- Shortcode Manager for processing shortcodes

### Changed
- Improved content processing with Shortcode Manager
- Updated documentation and version tracking

## [0.1.0] - 2019-11-24
### Added
- Initial release
- Basic Restrict Content Pro shortcode removal