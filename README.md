# Technology Stack

| Configuration     | Version                              |
| ----------------- | -------------------------------------|
| Framework         | Laravel ^12.0                        |
| PHP               | 8.3                                  |
| Database          | MySQL                                |
| Authentication    |  laravel/breeze

Project Setup: Product Gallery Manager

1. Create Project & Database
---------------------------
cd product_gallery_manager

# MySQL
CREATE DATABASE product_gallery_manager;

# .env update
DB_DATABASE=product_gallery_manager
DB_USERNAME=root
DB_PASSWORD=your_password

2. Install Dependencies
-----------------------
composer install
php artisan key:generate

3. Migrate & Seed
-----------------
php artisan migrate:fresh --seed

# Optional: run specific seeder
php artisan db:seed --class=ProductSeeder

4.Storage Link
----------------
php artisan storage:link

5. Serve Project
----------------
php artisan serve
Open: http://127.0.0.1:8000


user:admin@gmail.com
password: password
