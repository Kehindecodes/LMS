<?php

namespace Controller;

use Model\Book;

class GetBookController
{
    public function __construct(private Book $book)
    {
    }
    public function __invoke(int $id) : void
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $book = $this->getBookById($id);
            $this->renderView($book);
        }
    }

    private function getBookById(int $id) : array
    {
        return $this->book->getBook($id);
    }

    private function renderView(array $book) : void
    {
        require_once __DIR__ . '/../View/bookDetails.php';
    }

}