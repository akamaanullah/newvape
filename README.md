<div align="center">

# 💨 New Vape — Enterprise E-Commerce Platform & Custom PHP MVC

**A blazing-fast, modern, scalable, and responsive e-commerce web platform engineered with a pure custom PHP MVC architecture, MySQL database, dynamic mega-navigation, and an administration back-office suite.**

[![PHP Version](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%20%7C%208.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B%20%7C%20MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Architecture](https://img.shields.io/badge/Architecture-Custom%20Pure%20MVC-00D26A?style=for-the-badge)](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
[![Frontend](https://img.shields.io/badge/UI-Vanilla%20CSS3%20%26%20Modern%20JS-FF5722?style=for-the-badge&logo=javascript&logoColor=white)](https://developer.mozilla.org/)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

[Explore Storefront](#-key-features) • [Admin Suite](#%EF%B8%8F-admin-back-office-features) • [Installation Guide](#-quick-start--installation) • [Database Setup](#%EF%B8%8F-database-schema--seeding) • [Directory Structure](#-directory-structure)

---

</div>

## 📖 Executive Overview

**New Vape** is an enterprise-grade digital retail storefront built specifically for vape, disposable device, e-liquid, nicotine pouch, and hemp/THC retailers. It completely rejects heavy, slow, or bloated CMS frameworks in favor of a lean, custom-engineered **PHP 8 Model-View-Controller (MVC)** framework designed for:

- **Sub-50ms TTFB (Time to First Byte)** with zero overhead framework baggage.
- **Dynamic & Scalable Catalog Management**: Categories, Brands, Disposables, Freebase & Salt Nic Juices, Pouches, and Hemp products.
- **Production-Ready Fallback Resilience**: Automated `no-image.svg` placeholder rendering across all product media with zero broken asset loops.
- **High-Converting UX/UI**: Clean typography, sticky header, sliding cart drawer, modern badges, rating star matrices, and rich promo twin-banners.
- **Comprehensive Admin Dashboard**: Complete catalog CRUD, brand management, inventory tracking, dynamic navigation tree builder, customer CRM, and order processing.

---

## ✨ Key Features

### 🛒 High-Impact Customer Storefront
* **100% Dynamic Homepage Showcases**:
  * **Interactive Hero Carousel**: High-converting promo sliders with animated CTA buttons.
  * **Top Vape Categories Grid**: Live collection count, thumbnails, and deep links.
  * **Shop by Brand Showcase**: Verified partner logos with active product filters (Geek Bar, Lost Mary, RAZ, Tyson 2.0, Juice Head, etc.).
  * **New Arrivals: Latest Products**: 10-item responsive slider featuring automatic `-XX%` discount badges and `NEW` tags.
  * **Best Selling Vapes & E-Liquids**: Top-rated customer favorites with dynamic star ratings and review counts.
  * **Shop Disposable Vapes**: High-density 4x4 responsive 16-card grid with puff count highlights and USA-made flags.
  * **Shop Vape Juices**: Featured bottles showcasing nicotine strengths (0mg, 3mg, 6mg, 25mg, 50mg) and flavor profiles.
  * **Shop Nicotine Pouches**: Clean circular pouch tins with tobacco-free pellet badges.
  * **Shop Hemp & THC**: Lab-tested Farm Bill compliant products with live Low-Stock indicators.
* **Modern Product Experience**:
  * Sticky image gallery preview with multi-angle thumbnails and zoom viewport.
  * Highlights bar (Puffs, Battery Capacity, E-liquid Volume, Nicotine Strength).
  * Real-time AJAX Cart Drawer with slide-over animation and free shipping threshold meter.
  * Universal `no-image.svg` vector placeholder fallback on image load error or unassigned media.
* **Responsive Architecture**: Pixel-perfect layout scaling seamlessly from 320px mobile screens to 4K ultra-wide monitors.

---

### 🎛️ Admin Back-Office Features
* **Executive Analytics Dashboard**: Real-time sales, order volume, customer acquisition metrics, and low-inventory alerts.
* **Product Catalog Management**:
  * Full CRUD with support for SKU generation, multi-tier pricing, compare-at discounts, and stock status.
  * Dynamic Badge assignments (`HOT`, `NEW`, `BOGO`, `USA`, `LOW STOCK`, `DISCOUNT`).
  * SEO metadata control (Custom URL slugs, Meta Title, Meta Description).
* **Dynamic Menu & Navigation Tree Builder**:
  * Add, reorder, and configure mega-menu dropdowns, brand logos, and promotional banner cards directly from the admin panel.
* **Brand & Category Taxonomy**:
  * Manage brands, partner logos, header image banners, and featured category order.
* **Order Processing & Customer CRM**:
  * View orders, update fulfillment statuses (Pending, Processing, Shipped, Delivered), and customer lifetime value insights.

---

## 🛠️ Technology Stack & Architecture

| Layer | Technologies & Standards |
| :--- | :--- |
| **Backend Core** | PHP 8.1+ / 8.2+ / 8.3+, PSR-4 Autoloader, Custom Front-Controller MVC |
| **Database** | MySQL 8.0+ / MariaDB 10.4+, PDO with Prepared Statements & Transaction Support |
| **Web Server** | Apache (mod_rewrite enabled) or Nginx (try_files directive) |
| **Frontend Styling** | Modern Vanilla CSS3, CSS Custom Properties (Design Tokens), Flexbox & CSS Grid |
| **Frontend Logic** | Vanilla ES6+ JavaScript, Fetch API, Modular Component Scripts |
| **Vector & Media** | SVG Graphics, WebP Next-Gen Image Formats, Responsive Resolution Handlers |
| **CLI Tooling** | Custom Console Command Runner (`bin/console`) |

---

## 📂 Directory Structure

```text
vapefinalwebsite/
├── app/
│   ├── Controllers/
│   │   ├── Admin/                  # Back-office administration controllers
│   │   │   ├── BrandController.php
│   │   │   ├── CollectionController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── MenuController.php
│   │   │   ├── OrderController.php
│   │   │   └── ProductController.php
│   │   ├── AccountController.php   # User authentication & customer profile
│   │   ├── BlogController.php      # Educational blog posts & SEO articles
│   │   ├── CategoryController.php  # Category archives & filter facets
│   │   ├── CheckoutController.php  # Checkout pipeline & order placement
│   │   ├── HomeController.php      # High-performance storefront aggregator
│   │   ├── ProductController.php   # Product detail & dynamic tabs
│   │   └── TagController.php       # Product tag indexing
│   ├── Core/                       # Custom MVC Engine
│   │   ├── App.php                 # HTTP Request dispatcher & routing engine
│   │   ├── Autoloader.php          # Zero-dependency PSR-4 autoloader
│   │   ├── Controller.php          # Base controller & view renderer
│   │   ├── Database.php            # PDO Singleton database connection
│   │   ├── Helpers.php             # Core utility functions (url, asset, e, etc.)
│   │   ├── Model.php               # Base model with dynamic PDO binding
│   │   └── View.php                # View rendering engine with layout support
│   └── Models/                     # Data Access Objects (DAOs)
│       ├── Brand.php
│       ├── Collection.php
│       ├── Customer.php
│       ├── Menu.php
│       ├── Order.php
│       └── Product.php
├── bin/
│   └── console                     # CLI Command Runner
├── config/
│   ├── app.php                     # Application settings & environment detector
│   ├── database.php                # Database credentials & PDO attributes
│   └── routes.php                  # Centralized Route Registry
├── database/
│   └── schema.sql                  # Complete MySQL schema & initial sample records
├── public/                         # Public Web Root (DocumentRoot)
│   ├── .htaccess                   # Front-controller rewrite rules
│   ├── index.php                   # Single Entry Point (Front Controller)
│   ├── admin/                      # Admin panel assets (CSS, JS, Fonts)
│   └── assets/                     # Storefront assets (CSS, JS, Images, SVG icons)
│       └── images/
│           └── no-image.svg        # Universal fallback placeholder
├── storage/                        # Application logs, sessions & file cache
│   ├── cache/
│   ├── logs/
│   └── uploads/
├── views/                          # Clean Presentation Layer
│   ├── admin/                      # Admin views & dashboard layouts
│   ├── errors/                     # HTTP 404 & 500 error templates
│   └── front/                      # Customer-facing storefront views
├── .env.example                    # Sample environment configurations
├── .gitignore                      # Git ignore specifications
├── database.sql                    # Root copy of database schema
├── composer.json                   # Project metadata & autoloader config
└── README.md                       # Comprehensive Project Documentation
```

---

## 🚀 Quick Start & Installation

### Prerequisites
* **PHP**: 8.1 or higher (with `pdo_mysql`, `mbstring`, `openssl` extensions enabled).
* **MySQL**: 8.0+ or MariaDB 10.4+.
* **Web Server**: Apache with `mod_rewrite` enabled, or Nginx.
* **Composer** (Optional, for dependency management).

### 1. Clone the Repository
```bash
git clone https://github.com/akamaanullah/newvape.git
cd newvape
```

### 2. Configure Environment Variables
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```

Edit your `.env` configuration according to your local environment:
```ini
APP_NAME="New Vape"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/vapefinalwebsite

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vape_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Import Database
Create the database and import the pre-seeded schema:
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS vape_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p vape_db < database/schema.sql
```

*(Alternatively, open **phpMyAdmin**, create a database named `vape_db`, and import `database/schema.sql`).*

### 4. Configure Virtual Host or Document Root
Point your web server's DocumentRoot to the `public/` folder:

#### Apache VirtualHost Example:
```apache
<VirtualHost *:80>
    ServerName newvape.local
    DocumentRoot "d:/xampp/htdocs/vapefinalwebsite/public"
    <Directory "d:/xampp/htdocs/vapefinalwebsite/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Running directly with PHP Built-in Server:
```bash
php -S localhost:8000 -t public
```
Visit `http://localhost:8000` in your web browser.

---

## 🗄️ Database Schema & Seeding

The database comes fully populated with production-grade sample data across all categories:

* `products`: Full specs, SKUs, pricing, compare discounts, puff counts, badges, and image links.
* `collections`: Disposables, E-Liquids, Nicotine Pouches, Hemp & THC, New Arrivals, Best Sellers.
* `brands`: Geek Bar, Lost Mary, RAZ, Tyson 2.0, Juice Head, Esco Bars, Voopoo, etc.
* `menu_items`: Dynamic multi-tier mega navigation headers, brand links, and promotional teasers.
* `product_specifications`: Puff count, nicotine strength, battery capacity, coil resistance.
* `product_variants`: Flavor combinations, nicotine mg strengths, bottle sizes.
* `product_reviews`: Verified customer ratings and feedback.
* `orders` & `order_items`: Order tracking pipeline and line item logs.

---

## 🛡️ Security & Scalability Features

- **SQL Injection Prevention**: 100% of SQL executions utilize PDO Prepared Statements with parameterized inputs.
- **XSS Mitigation**: Global `e()` and `htmlspecialchars()` output sanitization helpers across all templates.
- **Fail-Safe Asset Routing**: Broken or missing image links are intercepted with the `no-image.svg` vector placeholder via `onerror` handlers and SQL `COALESCE(NULLIF())` queries.
- **Clean MVC Architecture**: Controllers strictly handle business logic, Models strictly handle database persistence, and Views strictly render HTML output.

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/akamaanullah/newvape/issues).

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

<div align="center">
  <sub>Engineered with precision for <b>New Vape</b>. Built for speed, conversions, and scale.</sub>
</div>
