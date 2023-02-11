<p style="text-align: left; padding: 1rem 0 3rem 0;"><img src="https://admin.recoo.app/assets/images/recdb.jpg" width="250" height="auto" alt="Records Database"/></p>

A Laravel application designed to maintain a database of movies.

### Installation
- Copy .env.example into .env
- Run `composer install`.
- Run `db artisan key:generate`.
- Create a file named `database.sqlite` in the database directory or define a connection to your database.
- Run `php artisan migrate`.
- Run `php artisan db:seed`.
- Run `npm install` followed by `npm run build`.

### Technical requirement  
- php 8.1 or greater.  
- redis cache store.  

### Technical description
- Laravel 9.  
- Livewire and alpine.js.  
- Tailwind css.  
- Role and user permissions. 
- Caching with Redis when env `CACHE_ENABLED` is set to true and `CACHE_DRIVER` is set to redis.  
- Static analysis with phpstan.  

### Demo
<a href="https://admin.recoo.app" target="_blank">RecDB demo website</a>


<table>
<tbody>
<tr>
<td><img src="https://admin.recoo.app/assets/images/tailwind.svg" width="100" height="auto" alt="Tailwind" /></td>
<td><img src="https://admin.recoo.app/assets/images/alpinejs.svg" width="100" height="auto" alt="Alpine" /></td>
<td><img src="https://admin.recoo.app/assets/images/laravel.svg" width="100" height="auto" alt="Laravel" /></td>
<td><img src="https://admin.recoo.app/assets/images/livewire.svg" width="100" height="auto" alt="Livewire" /></td>
</tr>
</tbody>
</table>
