<?php
// books.php
$books = [
    ['id' => 1, 'title' => 'Book 1', 'author' => 'Author 1'],
    ['id' => 2, 'title' => 'Book 2', 'author' => 'Author 2'],
    ['id' => 3, 'title' => 'Book 3', 'author' => 'Author 3'],
    ['id' => 4, 'title' => 'Book 4', 'author' => 'Author 4'],
    ['id' => 5, 'title' => 'Book 5', 'author' => 'Author 5'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        $filteredBooks = array_filter($books, function($book) use ($searchTerm) {
            return stripos($book['title'], $searchTerm) !== false || stripos($book['author'], $searchTerm) !== false;
        });
        // var_dump(json_encode($filteredBooks));
        http_response_code(200);
        header('Content-Type: application/json');
        $books = $filteredBooks;
    } 
}
    
include 'book_list.php';

?> 