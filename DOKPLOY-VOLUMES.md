# Dokploy Volume Configuration Guide

This guide explains how to configure persistent volumes in Dokploy for the ToolsFree Laravel application.

## Why Volumes Are Needed

Laravel stores important data in the `storage` and `bootstrap/cache` directories:
- **storage/app**: Uploaded files (if you add file uploads)
- **storage/logs**: Application logs
- **storage/framework/cache**: Cache files
- **storage/framework/sessions**: Session files
- **storage/framework/views**: Compiled Blade views
- **bootstrap/cache**: Compiled config and route cache

Without volumes, all this data is lost when the container is recreated or updated.

## Step-by-Step Volume Setup in Dokploy

### Method 1: Using Dokploy UI

1. **Navigate to Your Application**
   - Go to your Dokploy dashboard
   - Click on your ToolsFree application/deployment

2. **Open Volume Settings**
   - Look for **"Volumes"**, **"Storage"**, or **"Mounts"** tab/section
   - Click to add a new volume mount

3. **Add Storage Volume**
   - **Volume Name**: `toolsfree-storage` (or any name you prefer)
   - **Container Path**: `/var/www/html/storage`
   - **Volume Type**: Choose "Named Volume" or "Host Path"
   - **Mode**: `rw` (read-write)
   - Click **Save** or **Add**

4. **Add Bootstrap Cache Volume**
   - **Volume Name**: `toolsfree-bootstrap-cache` (or any name you prefer)
   - **Container Path**: `/var/www/html/bootstrap/cache`
   - **Volume Type**: Choose "Named Volume" or "Host Path"
   - **Mode**: `rw` (read-write)
   - Click **Save** or **Add**

5. **Redeploy**
   - After adding volumes, redeploy your application
   - The volumes will be mounted on the next deployment

### Method 2: Using Docker Compose (if Dokploy supports it)

If Dokploy allows docker-compose.yml, you can add this to your deployment:

```yaml
volumes:
  toolsfree-storage:
  toolsfree-bootstrap-cache:

services:
  app:
    volumes:
      - toolsfree-storage:/var/www/html/storage
      - toolsfree-bootstrap-cache:/var/www/html/bootstrap/cache
```

### Method 3: Using Dokploy CLI/API

If Dokploy provides CLI or API access, you can configure volumes programmatically. Refer to Dokploy's documentation for the exact commands.

## Verifying Volume Mount

After deployment, verify volumes are working:

1. **Exec into Container**
   ```bash
   # In Dokploy, use the terminal/exec feature
   docker exec -it <container-name> sh
   ```

2. **Check Storage Directory**
   ```bash
   ls -la /var/www/html/storage
   # Should show existing files if volume was mounted correctly
   ```

3. **Test Write Permission**
   ```bash
   touch /var/www/html/storage/test.txt
   ls -la /var/www/html/storage/test.txt
   rm /var/www/html/storage/test.txt
   ```

4. **Check Logs**
   ```bash
   ls -la /var/www/html/storage/logs
   # Should persist across container restarts
   ```

## Volume Paths Summary

| Container Path | What It Stores | Required? |
|---------------|----------------|-----------|
| `/var/www/html/storage` | All Laravel storage (logs, cache, sessions, uploads) | **Yes** |
| `/var/www/html/bootstrap/cache` | Compiled config/route cache | **Recommended** |

## Troubleshooting

### Issue: Storage directory is empty after restart

**Solution**: Volumes may not be mounted. Check Dokploy volume configuration and ensure:
- Volume paths are correct
- Volumes are created before deployment
- Container has write permissions

### Issue: Permission denied errors

**Solution**: The container runs as `www-data` user. Ensure volumes have correct ownership:
```bash
# In Dokploy terminal
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
```

### Issue: Files not persisting

**Solution**: 
1. Verify volume mounts in Dokploy UI
2. Check if volumes are actually created (not just configured)
3. Ensure you're writing to the correct paths inside the container

## Best Practices

1. **Configure volumes BEFORE first deployment** - This prevents data loss
2. **Use named volumes** - Easier to manage than host paths
3. **Backup volumes regularly** - Especially for production
4. **Monitor volume size** - Logs and cache can grow large over time
5. **Set up log rotation** - Use Laravel's log rotation or external tools

## Backup Strategy

To backup your volumes:

```bash
# Backup storage volume
docker run --rm -v toolsfree-storage:/data -v $(pwd):/backup alpine tar czf /backup/storage-backup-$(date +%Y%m%d).tar.gz /data

# Backup bootstrap cache volume
docker run --rm -v toolsfree-bootstrap-cache:/data -v $(pwd):/backup alpine tar czf /backup/bootstrap-cache-backup-$(date +%Y%m%d).tar.gz /data
```

## Restore from Backup

```bash
# Restore storage volume
docker run --rm -v toolsfree-storage:/data -v $(pwd):/backup alpine sh -c "cd /data && tar xzf /backup/storage-backup-YYYYMMDD.tar.gz"

# Restore bootstrap cache volume
docker run --rm -v toolsfree-bootstrap-cache:/data -v $(pwd):/backup alpine sh -c "cd /data && tar xzf /backup/bootstrap-cache-backup-YYYYMMDD.tar.gz"
```

