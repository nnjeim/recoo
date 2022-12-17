<p><img src="https://crowdfavstage.wpengine.com/wp-content/uploads/2019/05/logo.png" width="100"/></p>  

A Laravel application to monitor the push requests to a defined set of github repositories and their respective defined branches.

The application follows by:

1- Pulling the last commits on the defined branch.
2- Fixing the permissions and ownership.
3- Optimizing Laravel instance.

### Installation
- Copy .env.example into .env
- Run composer install
- Run db artisan key:generate
- Set both the database and redis connections in .env.
- run php artisan migrate
