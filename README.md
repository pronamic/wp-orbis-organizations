# Orbis Organizations

The Orbis Organizations plugin extends your Orbis environment with the option to manage organizations.

This plugin is the successor of the [Orbis Companies](https://github.com/pronamic/wp-orbis-companies) plugin.

## Requirements

- PHP 8.3+
- WordPress 7.1+
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
| Database table | `{$wpdb->prefix}orbis_organizations` |
| Post meta (Orbis ID) | `_orbis_organization_id` |
| Posts 2 Posts connections | `orbis_persons_to_organizations`, `orbis_users_to_organizations` |

## Templates

The plugin ships a single and an archive organization template, modelled after `single-orbis_company.php` and `archive-orbis_company.php` of the Orbis 5 theme. They are used unless the theme has its own `single-orbis_organization.php` or `archive-orbis_organization.php`. Other plugins can add tabs to the single template with the `orbis_organization_sections` filter.

| Template | Shown on | Content |
|---|---|---|
| `templates/archive-orbis_organization.php` | Organizations archive | Table with name, address, website, e-mail and author |
| `templates/single-orbis_organization.php` | Single organization | Layout with details, contacts, users, description, sections and additional information |
| `templates/organization-details.php` | Single organization | Address, e-mail, registration, VAT, IBAN and payment details |
| `templates/organization-sections.php` | Single organization | Tabs from the `orbis_organization_sections` filter |
| `templates/organization-persons.php` | Single organization | Persons connected via `orbis_persons_to_organizations` |
| `templates/organization-users.php` | Single organization | Users connected via `orbis_users_to_organizations` |
| `templates/person-organizations.php` | Single person | Organizations connected via `orbis_persons_to_organizations`, through the `orbis_after_side_content` action |

## License

GPL-2.0-or-later
