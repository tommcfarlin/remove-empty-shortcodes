#!/bin/bash

# Set variables
PLUGIN_SLUG="remove-empty-shortcodes"
BUILD_DIR="build"

# Clean previous build and create directories
rm -rf ${BUILD_DIR}
mkdir -p ${BUILD_DIR}/${PLUGIN_SLUG}

# Copy files with exclusions matching GitHub Action
rsync -av \
  --exclude='.git*' \
  --exclude='node_modules' \
  --exclude='assets' \
  --exclude='tests' \
  --exclude='bin' \
  --exclude='*.md' \
  --exclude='*.yml' \
  --exclude='*.xml' \
  --exclude='*.dist' \
  --exclude='*.lock' \
  --exclude='*.json' \
  --exclude='*.gitignore' \
  --exclude='*.sh' \
  --exclude='build' \
  . ${BUILD_DIR}/${PLUGIN_SLUG}

# Create ZIP file (important: change directory first)
cd ${BUILD_DIR}
zip -r ../${PLUGIN_SLUG}.zip ${PLUGIN_SLUG}
cd ..

# Cleanup build directory
rm -rf ${BUILD_DIR}

echo "Plugin zip created: ${PLUGIN_SLUG}.zip"