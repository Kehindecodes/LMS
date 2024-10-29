<?php

namespace Model;

use PDO;

require_once __DIR__ . '../../../config/database.php';

class Book
{
    public function __construct(private PDO $conn) {}

    public function createBook(string $title, string $author, string $ISBN, string $publicationDate, string $genre, string $image, string $description)
    {
        $query = "INSERT INTO books (title, author, ISBN, publicationDate, genre, image, description) VALUES (:title, :author, :ISBN, :publicationDate, :genre, :image, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':ISBN', $ISBN);
        $stmt->bindParam(':publicationDate', $publicationDate);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getBook(int $id)
    {
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllBooks()
    {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateBook(string $title, string $author, string $ISBN, string $publicationDate, string $genre, string $image, int $id, string $description)
    {
        $query = "UPDATE books SET title = :title, author = :author, ISBN = :ISBN, publicationDate = :publicationDate, genre = :genre, image = :image, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':ISBN', $ISBN);
        $stmt->bindParam(':publicationDate', $publicationDate);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public function deleteBook(int $id)
    {
        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
