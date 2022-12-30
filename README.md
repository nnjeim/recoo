<p style="text-align: left; padding: 1rem 0 3rem 0;"><img src="https://recdb.njeim.net/recdb.jpg" width="250" height="auto" alt="Records Database"/></p>

A Laravel application designed to maintain a database of movies.

### Installation
- Copy .env.example into .env
- Run `composer install`.
- Run `db artisan key:generate`.
- Create a file named `database.sqlite` in the database directory.
- Run `php artisan migrate`.
- Run `npm install` followed by `npm run build`.
- Proceed with the registration of a user.

### Technical description
- Laravel 9 with laravel/sanctum authentication.
- Min requirement of php 8.
- Livewire and alpine.js.
- Tailwind css.

### Demo
<a href="https://recdb.njeim.net" target="_blank">RecDB demo website</a>
