# CronixAvantLink Plugin for Shopware 6

**Official GitHub Repository:** [cronixweb/shopware-avantlink-plugin](https://github.com/cronixweb/shopware-avantlink-plugin)

The CronixAvantLink plugin integrates AvantLink’s **site-wide** and **order confirmation tracking** scripts into your Shopware 6 storefront — making affiliate tracking simple and automated.

---

## 🛠️ System Requirements

- PHP 8.1 or higher  
- Docker with Docker Desktop (recommended for local dev)  
- Shopware 6.7.x (Tested on 6.7)  
- Composer  
- Git  

---

## 🚀 Quick Start Guide (Local Setup using Docker)

This plugin was tested using the `dockware/dev:latest` Docker image.

### 1. Setup Shopware via Docker

Create a new folder like `shopware_project` and place the following `docker-compose.yml` file inside:

```yaml
version: "3.7"

services:
  shopware:
    image: dockware/dev:latest
    container_name: shopware
    ports:
      - "80:80"         # HTTP
      - "3306:3306"     # MySQL
      - "22:22"         # SSH
      - "8888:8888"     # Mailcatcher
      - "9999:9999"     # Adminer
    volumes:
      - shop_volume:/var/www/html
      - db_volume:/var/lib/mysql
    environment:
      - XDEBUG_ENABLED=1
    networks:
      - web

volumes:
  db_volume:
  shop_volume:

networks:
  web:
    driver: bridge
```

Now run:

```bash
docker compose up -d
```

After container starts, you can access:

- Shopware Frontend: http://localhost  
- Shopware Admin Panel: http://localhost/admin (username: `admin`, password: `shopware`)

---

### 📦 Plugin Installation (Inside Docker)

1. Access Docker Container

```bash
docker exec -it shopware bash
```

2. Navigate to Plugin Directory

```bash
cd custom/plugins/
```

3. Clone the Plugin (if not already placed)

```bash
git clone https://github.com/cronixweb/shopware-avantlink-plugin.git CronixAvantLink
```

Or create plugin using:

```bash
bin/console plugin:create CronixAvantLink
```

Then copy the folder manually into `custom/plugins`.

4. Install & Activate Plugin

```bash
bin/console plugin:refresh
bin/console plugin:install --activate CronixAvantLink
bin/console cache:clear
```

---

## ⚙️ Plugin Features

### ✅ 1. Site-Wide Tracking Integration

AvantLink script is injected globally into your storefront's `<head>` section.

Implemented in:  
`src/Storefront/Resources/views/storefront/base.html.twig`

---

### ✅ 2. Order Confirmation Tracking Script

Tracks orders on the checkout "Thank You" page.

Implemented in:  
`src/Storefront/Resources/views/storefront/page/checkout/finish/index.html.twig`

---

### ✅ 3. Configuration from Admin

Go to:  
**Shopware Admin > Extensions > CronixAvantLink**

You can configure:

- Merchant ID  
- Test Mode  
- Enable/Disable Tracking  
- Script Injection Position  

---

### ✅ 4. Event Subscriber

Used to dynamically inject data into Twig templates from order context.

Implemented in:  
`src/Storefront/Subscriber/OrderTrackingSubscriber.php`

---

## 🗂️ Plugin Folder Structure

```
custom/plugins/CronixAvantLink/
├── composer.json
├── src/
│   ├── CronixAvantLink.php
│   ├── Resources/
│   │   └── config/
│   │       ├── config.xml
│   │       ├── plugin.png
│   ├── Storefront/
│   │   ├── Resources/views/
│   │   │   └── storefront/
│   │   │       ├── base.html.twig
│   │   │       └── page/checkout/finish/index.html.twig
│   │   └── Subscriber/
│   │       └── OrderTrackingSubscriber.php
```

---

## 🧪 Testing the Plugin

1. Visit the Shopware storefront: [http://localhost](http://localhost)  
2. Go to checkout and complete a test order.  
3. Open browser Developer Tools → Network tab → and check if the AvantLink script loads successfully.  
4. Test configuration changes via plugin settings in the admin.

To validate the AvantLink plugin using `shopware-cli`:

```bash
shopware-cli extension validate custom/plugins/CronixAvantLink
```

Sample Output:

```
✖ 0 problems (0 errors, 0 warnings)
```

---

## 🛡 License

MIT License

---

## 👨‍💻 Author

**Cronix LLC**  
Website: [https://cronixweb.com](https://cronixweb.com)  
Email: [admin@cronixweb.com](mailto:admin@cronixweb.com)
