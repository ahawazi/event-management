# Black Box

## The Tech Stack

- [Laravel](https://laravel.com/).
- [Filament](https://filamentphp.com/).

## Used Packages

- [shield](https://filamentphp.com/plugins/bezhansalleh-shield) For roles and permissions.
- [Jalali](https://filamentphp.com/plugins/mokhosh-jalali) For showing jalali date.
- [Overlook](https://v2.filamentphp.com/plugins/overlook) For showing an overview of app models in the admin panel.
- [Blade tabler icons](https://github.com/anodyne/blade-tabler-icons) For extra icons.
- [Blade tabler icons](https://tabler.io/icons) For extra icons.
- [Hero icons](https://heroicons.com/) For extra icons.
- [Wireui](https://wireui.dev/) For components.

### Project for:

this help to the cafe for management and analysis date.  

## Running Locally

run:

```bash
composer install
```

next:
```bash
npm install
```

next:
```bash
cp .env.example .env
```

next:
```php
php artisan key:generate
```

next:
```php
php artisan storage:link
```

next:
```
php artisan migrate
```

next:
```bash
npm run dev
```

### run this command and have SuperAdmin:

```php
php artisan db:seed --class=SuperAdminSeeder
```

### Install shield:

- By this command your user become to SuperAdmin (if you have more then one user you can chose what user want to be SuperAdmin)
```php
php artisan shield:install
```

### Add policy:
```php
php artisan shield:generate --all
```

### run:
```php
php artisan serve
```

## Deployment
- todo
