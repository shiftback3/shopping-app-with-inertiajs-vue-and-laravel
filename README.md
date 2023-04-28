## About The Project
This is a Basic ecommerce application to demostrate simple activities like creating products, view product on the home page, adding product to cart, viewing product details.
I try to keep everything simple so things like pagination from the backend was not implemented data chunking was not covered, but vue state management tool (pinia) was used on the frontend.

## Tools and Tech Stack
- The Backend was built with Laravel 10+ and MySQL database, also used [Ziggy](https://github.com/tighten/ziggy) Library for my routing with [Inertiajs](https://inertiajs.com) server side library.

- The frontend is pretty basic and it is built with [Vue 3](https://vuejs.org/) with [Inertiajs](https://inertiajs.com) and [Tailwind](https://tailwindcss.com), it is a simple app but state management was used to manage the shopping cart state.


## getting Started

To set up this project on you local you will have to do the following:

**1.** `git clone https://github.com/shiftback3/shopping-app-with-inertiajs-vue-and-laravel.git` you will notice that you have a folder `shopping-app-with-inertiajs-vue-and-laravel`.

**2.** Run `cd shopping-app-with-inertiajs-vue-and-laravel` to get access to the project files.

**3.** Run `composer install` when every dependecies are loaded you need to create a file `.env` file and copy the content of `.env.example`. 

**4.** Run the follow comands in this order 
```
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```
You can check your browser or use postman on [Localhost:8000](http://localhost:8000).
Now that the application is running you can run `php artisan test` to test the unit test for Auth.

**5.** Open a different Terminal and run :
```
npm install

```
Depending on the version of node or other development tools you might get dependency error, if this is the case Run `npm install --legacy-peer-deps` to clear any dependency errors.
```

npm run dev 
```
and your vite application will run on a local address which will be displayed .

## Thank You!
**[Ogbu Garuba Sunday](https://ogbugarubasunday.surge.sh/)**

