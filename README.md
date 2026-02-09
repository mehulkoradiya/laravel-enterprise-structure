# Laravel Enterprise Structure

Opinionated but optional project structure for long-term Laravel applications.

This package provides generators and conventions that guide teams toward maintainable, scalable architecture without modifying Laravel core behavior.

---

## Installation

Install via Composer:

```bash
composer require mehul/laravel-enterprise-structure
```

Publish the configuration:

```bash
php artisan vendor:publish --tag=enterprise-structure-config
```

Install the directory structure:

```bash
php artisan enterprise:install
```

This creates the recommended folder structure in your Laravel application.

---

## Commands

### Create a Domain

Generate a new domain with standard structure:

```bash
php artisan make:domain User
```

Creates the domain directory and associated files under `app/Domains/User/`.

### Create an Action

Generate a reusable action for business logic:

```bash
php artisan make:action User/CreateUser
```

Actions contain atomic, single-responsibility operations.

### Create a Use Case

Generate a use case that orchestrates multiple actions:

```bash
php artisan make:usecase User/RegisterUser
```

Use cases bind together actions to achieve specific user workflows.

---

## Project Structure

```
app/
├── Domains/                 # Business logic isolated by domain
│   └── User/
│       ├── Actions/
│       ├── Models/
│       └── Repositories/
├── Application/             # Application-specific logic
│   └── UseCases/
├── Http/                    # Controllers stay thin
│   └── Controllers/
└── Providers/
```

---

## Philosophy

🎯 **Laravel remains untouched** — No core modifications, only additions

🏗️ **Architecture is optional** — Use what you need, ignore what you don't

🎭 **Controllers stay thin** — They route and respond, nothing more

🔒 **Domain logic stays isolated** — Business rules live in domains, not controllers

🧩 **Actions are reusable** — Share logic across controllers, commands, and jobs

---

## When NOT to Use This

- **Small prototypes** — Overkill for proof-of-concepts
- **Single-developer throwaway apps** — Simple CRUD needs simpler structure
- **Short-lived projects** — Architecture pays off over years, not weeks

---

## Configuration

Customize paths and namespaces in `config/enterprise-structure.php`:

```php
return [
    'paths' => [
        'domains' => app_path('Domains'),
        'application' => app_path('Application'),
    ],

    'namespaces' => [
        'domains' => 'App\\Domains',
        'application' => 'App\\Application',
    ],
];
```

---

## Testing

Run tests with Pest:

```bash
npm run test
```

Run specific test file:

```bash
php artisan pest tests/Feature/MakeDomainTest.php
```

---

## Requirements

- PHP 8.1+
- Laravel 10.0+

---

## License

MIT License. See [LICENSE](LICENSE) for details.

---

## Contributing

Contributions are welcome! Please submit pull requests with clear descriptions of changes.

---

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.
