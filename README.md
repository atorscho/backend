# Laravel Backend Package
This a fully autonomous backend package for all your Laravel projects.

It contains the most basic features, such as: user and group management, custom fields, custom content (posts, articles, pages etc) and various plugins.

# Installation

### 1. Requirements
You need to add a new dependency to your `composer.json` file. Add a new line to the `require` object:

	"atorscho/backend": "1.*"

#### 1.1 Recommendations
It is not required but may be pretty helpful. I often use this packagee on my Laravel projects:

	"barryvdh/laravel-ide-helper": "1.11.*"

It generates a helper file for autocompletion for some IDEs (PhpStorm, NetBeans, Sublime Text etc). [More about it...](https://github.com/barryvdh/laravel-ide-helper)

### 2. Service Providers
Do not forget to add new service providers to your `/app/config/app.php` file.

Search for `providers` key, then add:

	'Atorscho\Backend\BackendServiceProvider',
	'Atorscho\Crumbs\CrumbsServiceProvider'

First service provider is the backend itself, the second one is a breadcrumbs package I use on my project. You may learn about it [here](https://github.com/atorscho/crumbs).

### 3. Migrations & Seeds
In order to run the backend, you must first run all migrations and seeds.

#### 3.1 Migrations
	php artisan migrate --package=atorscho/backend

#### 3.2 Seeds
	php artisan db:seed

#### 3.3 Super-Admin
To create a super-admin, run this command:

	php artisan backend:admin

### 4. Assets
Do not forget to run `php artisan asset:publish atorscho/backend` to use backend's stylesheet and javascript files.
