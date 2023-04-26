<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/**
 *
 * Load the auth routes to be processed first
 */
// require __DIR__ . '/allwebroutes/auth.php';

/**
 * include all route files in the allwebroutes folder except auth.php
 *
 */
$api_folder = __DIR__ . '/allwebroutes';
$dir = new DirectoryIterator($api_folder);
foreach ($dir as $file) {
    if ($file->isFile() && str_contains($file->getFilename(), '.php')) {
        require __DIR__ . '/allwebroutes/' . $file->getFilename();
    }
}