<?php

namespace Controller;

use App\Trait\ErrorTrait;
use Model\Book;
use Model\Inventory;
use Webmozart\Assert\Assert;

class AddBookController
{
    use ErrorTrait;
    public function __construct(private Book $book, private Inventory $inventory)
    {
        
    }

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $ISBN = $_POST['ISBN'] ?? '';
        $publicationDate = $_POST['publicationDate'] ?? '';
        $genre = $_POST['genre'] ?? '';
        $image = $_POST['image'] ?? '';
        $description = $_POST['description'] ?? '';

        $result = $this->addBook($title, $author, $ISBN, $publicationDate, $genre, $image, $description);
        echo $result;
        exit;
    }


    private function addBook(string $title, string $author, string $ISBN, string $publicationDate, string $genre, string $image, string $description) : string
    {

        $errors = [];



        try {
            Assert::notEmpty($title, "Please enter the title");
        } catch (\InvalidArgumentException $e) {
            $errors['title'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($author, "Please enter the author");
        } catch (\InvalidArgumentException $e) {
            $errors['author'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($ISBN, "Please enter the ISBN");
        } catch (\InvalidArgumentException $e) {
            $errors['ISBN'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($publicationDate, "Please enter the publication date");
        } catch (\InvalidArgumentException $e) {
            $errors['publicationDate'] = $e->getMessage();
        }
        
        try {
            Assert::notEmpty($genre, "Please enter the genre");
        } catch (\InvalidArgumentException $e) {
            $errors['genre'] = $e->getMessage();
        }


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/images/';
            $fileName = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $fileName;

            // Ensure the upload directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image = $fileName; // Update $image with the file name
            } else {
                $errors['image'] = "Failed to upload the image.";
                return $this->generateErrorHtml($errors);
            }
        } else {

    
            $errors['image'] = "Please select an image to upload.";
            return $this->generateErrorHtml($errors);
        }

        try {
            Assert::notEmpty($image, "Please enter the image");
        } catch (\InvalidArgumentException $e) {
            $errors['image'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($description, "Please enter the description");
        } catch (\InvalidArgumentException $e) {
            $errors['description'] = $e->getMessage();
        }

        if (!empty($errors)) {
            return $this->generateErrorHtml($errors);
        }

       
        // Check if the book already exists
        $book = $this->book->getBook($ISBN);
        if ($book) {
            $inventory = $this->inventory->getBookInventory($book['id']);
            if ($inventory) {
                $this->inventory->updateInventory($book['id'], $inventory['totalCopies'] + 1, $inventory['availableCopies'] + 1);
            } else {
                $this->inventory->addBookToInventory($book['id'], 1, 1);
            }
        } else {
            $bookId = $this->book->createBook($title, $author, $ISBN, $publicationDate, $genre, $image, $description);
            $this->inventory->addBookToInventory($bookId, 1, 1);
        }

        return '<div class="text-green-500">Book added successfully. Redirecting to library...</div>'
        . '<script>setTimeout(function(){ window.location.href = "/"; }, 2000);</script>';
    }
}