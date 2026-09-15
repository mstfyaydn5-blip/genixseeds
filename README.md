# Genix Seeds — Laravel 12 Website

A full-featured, bilingual (English/Arabic, LTR/RTL) agricultural company website with a
custom admin dashboard, built on Laravel 12 + PHP 8.3 + MySQL + Bootstrap 5.
No CMS, no WordPress — 100% custom Laravel MVC.

---

## ⚠️ Important — read this first

This project was generated in a sandboxed environment that has **no access to
packagist.org**, so `composer install` could not be executed or verified here.
Every application file below (migrations, models, controllers, requests, routes,
Blade views, CSS/JS, seeders) was hand-written to the Laravel 12 / PHP 8.3 spec,
and all PHP files pass `php -l` syntax validation — but you must run the setup
steps below on a machine with normal internet access before it will boot.

---

## 1. Requirements

- PHP >= 8.3 (with `pdo_mysql`, `mbstring`, `gd` or `imagick`, `fileinfo` extensions)
- Composer 2.x
- MySQL 8 (or MariaDB 10.6+)
- Node.js is **not required** — this project intentionally ships plain CSS/JS
  in `public/css` and `public/js` (Bootstrap 5, Bootstrap Icons and AOS are
  loaded from CDN in the layouts), so there is no frontend build step.

## 2. Setup Instructions

```bash
# 1. Scaffold a fresh Laravel 12 skeleton (this pulls the framework/vendor code
#    that could not be fetched inside this sandbox)
composer create-project laravel/laravel agri-website
cd agri-website

# 2. Copy every file from this deliverable INTO the new project, overwriting
#    the default files where they collide (app/Models/User.php,
#    bootstrap/app.php, routes/web.php, database/seeders/DatabaseSeeder.php).
#    Everything else here is net-new.

# 3. Install the two extra packages used by the app
composer require spatie/laravel-permission intervention/image

# 4. Publish the permission package's migration
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# 5. Environment
cp .env.example .env
php artisan key:generate
#    Edit .env: set DB_DATABASE, DB_USERNAME, DB_PASSWORD for your MySQL server.

# 6. Create the database (example)
mysql -u root -p -e "CREATE DATABASE agri_website CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Migrate + seed (creates roles, an admin user, and demo content)
php artisan migrate --seed

# 8. Storage symlink (so uploaded images are web-accessible)
php artisan storage:link

# 9. Serve
php artisan serve
```

Visit `http://localhost:8000` — it will redirect to `/en` (or `/ar`).
Admin panel: `http://localhost:8000/admin/login`

**Demo admin login** (created by `RolePermissionSeeder`):
```
Email:    admin@agriwebsite.test
Password: Password123!
```
**Change this password immediately in production.**

## 3. What's included

### Database (17 migrations)
`users` (extended), `pages`, `services`, `product_categories`, `products`,
`projects`, `gallery_categories`, `gallery_items`, `news_categories`, `news`,
`careers`, `career_applications`, `contact_messages`, `testimonials`,
`partners`, `statistics`, `settings` — plus Spatie's `roles`/`permissions`
tables (published separately, see step 4 above).

Every content table that appears on the public site stores **both** an
English and an Arabic column per field (e.g. `title_en` / `title_ar`) rather
than a separate translations table — simple, fast, and query-friendly. Models
expose a locale-aware accessor (`->title`, `->description`, etc.) that returns
the right language automatically based on `app()->getLocale()`.

### Models & relationships
15 Eloquent models under `app/Models` with `belongsTo`/`hasMany` relations:
`Product belongsTo ProductCategory`, `News belongsTo NewsCategory` and
`belongsTo User (author)`, `Career hasMany CareerApplication`,
`GalleryItem belongsTo GalleryCategory`, etc. Scopes (`active()`, `featured()`,
`published()`, `open()`) keep controllers thin.

### Controllers
- **Public**: `HomeController`, `PageController`, `ServiceController`,
  `ProductController`, `ProjectController`, `GalleryController`,
  `NewsController`, `CareerController`, `ContactController` — all resourceful,
  with search/filter/pagination on index pages.
- **Admin** (`app/Http/Controllers/Admin`): a full resource controller per
  entity (`Service`, `Product`, `ProductCategory`, `Project`,
  `GalleryCategory`/`GalleryItem`, `NewsCategory`/`News`, `Career`,
  `CareerApplication`, `ContactMessage`, `Page`, `Setting`, `User`) plus
  `AuthController` and `DashboardController`.

### Validation
Every admin write path uses a dedicated **Form Request** in
`app/Http/Requests/Admin` (`ServiceRequest`, `ProductRequest`, `ProjectRequest`,
`NewsRequest`, `CareerRequest`, `PageRequest`, `UserRequest`,
`JobApplicationRequest`, `ContactMessageRequest`) with an `authorize()` gate
tied to Spatie permissions.

### Authentication & Authorization
- Session-based auth for the admin panel (`AuthController` + `auth`
  middleware), completely separate from any public-facing login (there isn't
  one — this is a company site, not a customer portal).
- **Spatie laravel-permission** roles: `admin` (full access), `editor`
  (content only), `hr` (careers only). Blade `@can` directives hide sidebar
  links the current user can't use; controllers enforce the same permissions
  server-side via `$this->middleware('can:...')`.
- `EnsureUserIsActive` middleware logs out and blocks deactivated accounts.

### Image uploads
`app/Traits/HandlesUploads.php` centralizes `store()`/`storeMultiple()`/
`delete()` logic (UUID filenames, `public` disk) used by every admin
controller that accepts images (services, products + gallery, projects +
gallery, news, pages, gallery items, settings logo/favicon).

### Bilingual / RTL-LTR
- `SetLocale` middleware reads the `{locale}` route segment (`en`/`ar`),
  persists it in session, and sets `app()->setLocale()`.
- `<html lang="{{ app()->getLocale() }}" dir="{{ ... rtl/ltr }}">` in both
  layouts; the Arabic build swaps in `bootstrap.rtl.min.css` automatically.
- `lang/en/site.php` + `lang/ar/site.php` hold all UI strings; every content
  model has the `_en`/`_ar` accessor pattern described above.
- A language switcher in the navbar (`LocaleController@switch`) preserves the
  current path when toggling language.

### SEO & Settings
`Setting` is a cached key/value store (`Setting::get('key')`,
`Setting::set(...)`) driving both **General Settings** (site name, tagline,
contact info, social links, logo/favicon) and **SEO Settings** (meta title/
description/keywords, Google Analytics ID, site verification) from the admin
panel — no code changes needed to update them. Individual services/products/
projects/news/pages also carry their own per-item `meta_title_*` /
`meta_description_*` fields.

### Frontend
- Bootstrap 5 (CDN, with the `.rtl.min.css` variant swapped in for Arabic),
  Bootstrap Icons, Google Fonts (Playfair Display + Inter + Cairo for Arabic),
  and AOS for scroll animations — plus a **from-scratch** `public/css/app.css`
  (~300 lines) implementing the green/white/gold agricultural theme: hero,
  cards, stat counters, testimonials, CTA band, filters, pagination, footer,
  etc. `public/js/main.js` adds a JS fallback for the reveal animation and
  counters in case the AOS CDN is blocked, so animations degrade gracefully.
- All 9 required public pages plus the 11 Home sections requested are
  implemented in `resources/views/home/index.blade.php` and
  `resources/views/pages/**`.
- `public/js/admin.js` + `public/css/admin.css` power the separate,
  collapsible-sidebar admin theme.

### Demo data
`database/seeders/DemoContentSeeder.php` seeds ~6 services, 8 products across
4 categories, 5 projects, an 8-item gallery, 4 news articles, 4 job postings,
4 statistics, 3 testimonials and 6 partner placeholders, in both languages —
enough to see every page populated immediately after `migrate --seed`. Demo
images point to real Unsplash/placeholder URLs (via `GalleryItem::image_url`
and `Partner::logo_url` accessors that transparently handle both external
URLs and locally-uploaded storage paths), so nothing shows as a broken image
before you've uploaded real assets through the admin panel.

### Error pages, SEO & robots
- Custom `resources/views/errors/{404,419,500}.blade.php` themed to match the
  site instead of Laravel's defaults.
- `public/robots.txt` (blocks `/admin`, points to the sitemap).
- `routes/web.php` exposes `/sitemap.xml` via `SitemapController`, which
  auto-generates entries for both locales × all static pages + every active
  service/product/project/published article.

## 4. Project structure

```
app/
  Http/
    Controllers/            (public controllers)
    Controllers/Admin/       (admin resource controllers)
    Requests/Admin/          (form requests)
    Middleware/               (SetLocale, EnsureUserIsActive)
  Models/                    (15 Eloquent models)
  Traits/HandlesUploads.php
bootstrap/app.php            (middleware aliases registered here — Laravel 12 style)
database/
  migrations/                (17 files)
  seeders/                   (RolePermissionSeeder, SettingsSeeder, DemoContentSeeder)
lang/en, lang/ar              (site.php, messages.php)
public/css/{app,admin}.css
public/js/{main,admin}.js
resources/views/
  layouts/{app,admin}.blade.php
  partials/{navbar,footer,page-banner,alerts}.blade.php
  home/index.blade.php
  pages/{about,generic,contact}.blade.php
  pages/{services,products,projects,gallery,news,careers}/*.blade.php
  admin/{auth,dashboard,services,products,product_categories,projects,
         gallery,news,careers,messages,settings,users,pages}/*.blade.php
routes/web.php, routes/admin.php
```

## 5. Security notes applied

- CSRF protection on every form (`@csrf`), Form Request validation on every
  admin write, mass-assignment protection via `$fillable`, password hashing
  via `'password' => 'hashed'` cast, route-level + controller-level
  authorization via Spatie permissions, UUID-randomized upload filenames to
  prevent overwrite/enumeration, `EnsureUserIsActive` to instantly revoke
  deactivated staff accounts, and locale input is whitelisted (`en|ar`) in the
  route constraint to prevent path injection.
- For production: set `APP_DEBUG=false`, configure a real mail driver for
  password resets if you add them, put the app behind HTTPS, and consider
  rate-limiting `POST /admin/login`, `/contact`, and `/careers/apply`
  (`throttle` middleware) — not included by default to keep the demo simple.

## 6. Extending

- To add a new bilingual content type, follow the existing pattern: migration
  with `_en`/`_ar` columns → model with locale accessors → Form Request →
  admin resource controller using `HandlesUploads` → Blade `index`/`form`
  views copied from `admin/services/*` → public controller/view if it needs a
  front-end page → add a permission string to `RolePermissionSeeder`.
# genixseeds
