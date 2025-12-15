#!/bin/sh
set -e

# This entrypoint script ensures proper permissions when Dokploy mounts volumes
# It handles both fresh volumes and existing volumes with data

echo "Setting up storage directories and permissions..."

# Create storage subdirectories if they don't exist (important for fresh volumes)
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Fix ownership for storage (works with or without mounted volumes)
# Using || true to prevent failures if chown doesn't work (e.g., read-only volumes)
chown -R www-data:www-data /var/www/html/storage 2>/dev/null || true
chown -R www-data:www-data /var/www/html/bootstrap/cache 2>/dev/null || true

# Set permissions (775 allows www-data to write, others to read)
chmod -R 775 /var/www/html/storage 2>/dev/null || true
chmod -R 775 /var/www/html/bootstrap/cache 2>/dev/null || true

# Ensure .gitkeep files exist (if volumes are empty)
touch /var/www/html/storage/framework/sessions/.gitkeep 2>/dev/null || true
touch /var/www/html/storage/framework/views/.gitkeep 2>/dev/null || true
touch /var/www/html/storage/framework/cache/.gitkeep 2>/dev/null || true
touch /var/www/html/storage/logs/.gitkeep 2>/dev/null || true

echo "Storage setup complete. Starting services..."

# Execute the main command (supervisord)
exec "$@"

