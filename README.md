# Orbis Organizations

The Orbis Organizations plugin extends your Orbis environment with the option to manage organizations.

## Requirements

- PHP 8.3+
- WordPress 6.7+
- [Posts 2 Posts](https://github.com/scribu/wp-posts-to-posts) (for connecting persons and users to organizations)
- Composer
- Node.js / npm

## Installation

```sh
composer install
npm install
```

## Development

This plugin follows the [SolveBeam WordPress Plugin Boilerplate](https://github.com/solvebeam/solvebeam-wordpress-plugin-boilerplate) conventions.

### Local environment (wp-env)

```sh
npx wp-env start
npx wp-env stop
```

The `.wp-env.json` maps the plugin twice into the WordPress environment:

| Mount path | Source | Purpose |
|---|---|---|
| `wp-content/plugins/orbis-organizations-dev` | `./` | Live development (including dev files) |
| `wp-content/plugins/orbis-organizations` | `./build/orbis-organizations/` | Built distribution version |

### Build

```sh
composer run build
```

### Deploy

```sh
vendor/bin/dep deploy
```

### Translations

```sh
composer run make-pot
```

### Linting & analysis

```sh
composer run phpcs
composer run phpstan
composer run rector
composer run qa
```

`stubs/posts-to-posts.php` provides the Posts 2 Posts functions for PHPStan.

## Data model

| Type | Key |
|---|---|
| Post type | `orbis_organization` |
| Taxonomies | `orbis_organization_category`, `orbis_payment_method`, `orbis_invoice_shipping_method` |
| Database table | `{$wpdb->prefix}orbis_organizations` |
| Post meta (Orbis ID) | `_orbis_organization_id` |
| Posts 2 Posts connections | `orbis_persons_to_organizations`, `orbis_users_to_organizations` |

## License

GPL-2.0-or-later
