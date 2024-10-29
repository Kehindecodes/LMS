<?php

namespace Controller;

use Model\Book;

class GetBooksController
{

    public function __construct(private Book $book)
    {
    }
    public function __invoke() : void
    {
        $books = $this->book->getAllBooks();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $books = $this->filterBooks($books, $_POST['search'] ?? '');
            if(empty($books)){
                echo '<div id="no-books-message" class="flex items-center justify-center h-64">';
                echo '<p class="text-center text-gray-400 text-2xl">No books found</p>';
                echo '</div>';
                return;
            }
        }
        foreach ($books as $book) {
            echo '<a href="/books/' . $book['id'] . '" class="no-underline hover:no-underline ">' ;
            echo '<div class="bg-gray-800 rounded-lg shadow-md overflow-hidden w-48 h-72 flex flex-col hover:bg-gray-700">';
            echo '<img src="' . '../public/images/' . $book['image'] . '" alt="' . $book['title'] . '" class="w-full h-56 object-cover">';
            echo '<div class="p-2 flex-grow flex flex-col justify-between">';
            echo '<h2 class="text-sm font-semibold mb-1 line-clamp-2 text-gray-200">' . $book['title'] . '</h2>';
            echo '<p class="text-xs text-gray-400">by ' . htmlspecialchars($book['author']) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    }

    private function filterBooks(array $books, string $search) : array
    {
        return array_filter($books, function($book) use ($search) {
            return str_contains(strtolower($book['title']), strtolower($search)) || str_contains(strtolower($book['author']), strtolower($search));
        });

    }
}
    
