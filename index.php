<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';

// Define the routes and their corresponding views or handlers
$routes = [
    '/' => 'library.php',
    '/addbook' => 'addBook.php',
    '/login' => 'login.php',
    '/book' => function() use ($conn) {
        $bookModel = new \Model\Book($conn);
        $inventoryModel = new \Model\Inventory($conn);
        $bookController = new \Controller\AddBookController($bookModel, $inventoryModel);
        $bookController();
    },
    '/books' => function() use ($conn) {
        $bookModel = new \Model\Book($conn);
        $booksController = new \Controller\GetBooksController($bookModel);
        $booksController();
    },
    '/books/details' => function($id) use ($conn) {
        $bookModel = new \Model\Book($conn);
        $bookController = new \Controller\GetBookController($bookModel);
        $bookController($id);
    },
    '/books/([0-9]+)' => "bookDetails.php",
    '/register' => 'register.php',
    '/handle-registrsation' => function() use ($conn) {
        $userModel = new \Model\User($conn);
        $registerController = new \Controller\RegisterUserController($userModel);
        $registerController();
    },
    '/profile' => 'profile.php',
    '/editProfile' => 'editProfile.php',
    '/logout' => 'logout.php',
    '/handle-login' => function() use ($conn) {
        $userModel = new \Model\User($conn);
        $loginController = new \Controller\LoginUserController($userModel);
        $loginController();
    },
];

// Get the requested URL
$requestUri = $_SERVER['REQUEST_URI'];

if($requestUri) {
    
}

// If the route is not in the defined routes, redirect to the 404 page
if (!array_key_exists($requestUri, $routes)) {
    include __DIR__ . '/src/View/404page.php';
} else {
    $route = $routes[$requestUri];
    
    // Check if the route is a closure (function)
    if (is_callable($route)) {
        // If it's a function, call it
        $route();
    } else {
        // If it's a string (view file), include it
        include __DIR__ . '/src/View/' . $route;
    }
}