## About Laraddit

Laraddit is a simple web app where users can upload images or definitions with an integrated admin dashboard.  
I made this project for the purpose of learning Laravel with the use of the framework's features like:

**Routing**
- Routing to a Single Controller Method
- Route Parameters
- Route Naming
- Route Groups 
- Route Model Binding

**Middleware**
- Create Custom Middleware Class

**Blade**
- Displaying Variables in Blade
- Blade If-Else and Loop Structures
- Layout: @include, @extends, @section, @yield

**Auth**
- Laravel UI
- Default Auth Model and Access its Fields from Anywhere
- Check Auth in Controller / Blade
- Auth Middleware
- Authorization: Roles/Permissions, Gates, Policies

**Database**
- Database Migrations
- Basic Eloquent Model and MVC: Controller -> Model -> View
- Eloquent Relationships: belongsTo / hasMany / belongsToMany
- Polymorphic relationships
- Eager Loading and N+1 Query Problem
- Database Seeders and Factories
- Eloquent Collections
- Soft Deletes

**Other**
- Table Pagination
- Forms, Validation and Form Requests
- Events and Listeners
- File Uploads and Storage Folder Basics
- Git Version Control


## Installation
Setting up your development environment on your local machine :
```bash
git clone https://github.com/coa989/laraddit.git
cd laraddit
cp .env.example .env
```
Fill .env with your credentials:
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraddit
DB_USERNAME=root
DB_PASSWORD=
```
then in terminal type:
```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
Now you can open development server in your browser and login with admin credentials: 

email: admin@admin.com 

password: admin

## Contributing
Do not hesitate to contribute to the project by adapting or adding features ! Bug reports or pull requests are welcome.

## Author
Aleksandar Marjanovic

a.marjanovic989@gmail.com
