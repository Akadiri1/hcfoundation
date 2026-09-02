# HC Foundation

Business/foundation website built on the McKodev PHP framework.

The framework was extracted from two existing projects: the application
skeleton, admin panel and `core/` runtime come from `postagvestsolution`
(the most recent business-site build), and the `mck` migration CLI plus
`framework/` come from `demo16`. No ecommerce code was carried over.

## Requirements

- PHP 8.4 (WAMP)
- MySQL / MariaDB
- Apache with `mod_rewrite`

## Setup

1. Create the database:

   ```sql
   CREATE DATABASE hcfoundation;
   ```

2. Check credentials in `.env/config.php` (git-ignored, already scaffolded).

3. Point a vhost at the project root. The root `.htaccess` rewrites every
   request into `www/index.php`.

4. Run migrations:

   ```
   php mck migrate
   ```

## Layout

```
.env/config.php     Environment. Git-ignored. Parsed into constants by core/autoload.php.
.htaccess           Rewrites all traffic into www/.
App.php             Path + URL helper (basePath, publicPath, versionPath, getUrl).
mck                 CLI: migrate, seed, migration:create, seeder:create, init.
core/               Runtime: autoloader and the Controllers/ class library.
framework/          Migrator, Blueprint, Seeder, Router, helpers. Namespace App\.
database/           migrations/ and seeds/.
v1/                 The application.
www/                Document root.
```

### `v1/`

| Path           | Purpose |
|----------------|---------|
| `models/`      | PDO connection (`$conn`) |
| `controllers/` | Site-wide helper functions |
| `routes/`      | `router.php` (public), `admin_router.php`, `ajax_router.php` |
| `views/`       | Page templates + `includes/` (header, footer, SEO partials) |
| `admin/`       | Table-driven CMS admin panel |
| `auth/`        | Login, signup, password reset, verification |
| `ajax/`        | Generic CRUD endpoints |
| `admc_ext/`    | ADMC admin-session bridge (`/mck_ext`) |
| `api/`         | Asset endpoints |
| `phpm/`        | PHPMailer |

### `www/`

| Path                | Purpose |
|---------------------|---------|
| `index.php`         | Entry point: boots framework, loads settings, dispatches routers |
| `assets/`           | Front-end theme. **Empty — the theme goes here.** |
| `da/assets/`        | Admin dashboard theme (referenced as `/da/assets/...`) |
| `font-awesome-pro/` | Icon set |
| `ajax/ajax.js`      | Client helper for the generic CRUD endpoints |
| `uploads/`          | User uploads (git-ignored) |

## Routing

`www/index.php` includes the routers in order; the first match wins and `die`s:

1. `v1/ajax/ajax_router/router.php` — generic CRUD (`/add`, `/read`, `/put`, `/delete`, `/upload2server`, …)
2. `v1/admc_ext/ext_route/router.php` — `/mck_ext` admin session bridge
3. `v1/routes/ajax_router.php` — page-specific AJAX
4. `v1/routes/admin_router.php` — `/add/<table>`, `/create/<table>`, `/manage/<table>` and named admin screens
5. `v1/routes/router.php` — public pages, falling through to `views/404.php`

## Admin panel

The admin is table-driven. Any table named `panel_<name>` automatically appears
in the admin nav with Add and Manage screens at `/add/<name>` and `/manage/<name>`
— no code needed for a new content type, only a table.

Admin sessions are opened by the ADMC service via `/mck_ext`, which sets
`$_SESSION['admin_id']`.

## Front end

Custom Tailwind. The palette is sampled from the Foundation's logo — `teal`
(the blue figure / "COSMOS") and `ember` (the orange figure / "HATHANY").

```
npm install
npm run dev      # watch and rebuild while working
npm run build    # minified build for deploy
```

`src/input.css` holds the design system (buttons, cards, reveals, prose);
`tailwind.config.js` holds the tokens. Output goes to `www/assets/css/app.css`,
which is committed so the site runs without a build step.

`www/assets/js/app.js` drives the interaction layer with no dependencies:
sticky header, mobile drawer, scroll reveals, counters, accordion, gallery
filters, lightbox, parallax. Reveal animations are gated behind `html.js`, so
if scripting is unavailable or errors the page still renders fully.

## Design mode

`DESIGN_MODE=true` in `.env/config.php` renders the site from
`v1/views/includes/static_content.php` instead of the database. It uses the same
variable names the CMS will populate, so switching over means setting the flag
to `false` — the views do not change.

Everything marked `PENDING` in that file is placeholder content awaiting the
Foundation: the homepage promise line, impact figures, team members, contact
details, partner names and blog posts. Photography is placeholder imagery and
must be replaced before launch.

## Pages

| Route | View |
|---|---|
| `/`, `/home` | `home.php` |
| `/about-us` | `about-us.php` |
| `/initiatives`, `/view-initiative/<slug>` | `initiatives.php`, `initiative-details.php` |
| `/volunteer` | `volunteer.php` |
| `/team` | `team.php` |
| `/gallery` | `gallery.php` |
| `/blog`, `/read-blog/<slug>` | `blog.php`, `blog-details.php` |
| `/contact-us` | `contact-us.php` |
| `/privacy-policy`, `/terms-of-use` | legal pages, **text not yet approved** |

The masthead reserves a slot beside the nav so a Donate button can be added
later without reworking the layout.

## Local access

The `hcfoundation.local` vhost points DocumentRoot at `www/`, so `www/.htaccess`
acts as the front controller. The root `.htaccess` covers the alternative setup
where DocumentRoot is the project root.
