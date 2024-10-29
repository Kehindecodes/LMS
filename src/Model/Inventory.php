<?php

namespace Model;

use PDO;

require_once __DIR__ . '../../../config/database.php';

class Inventory
{
    public function __construct(private PDO $conn)
    { 
    }

    public function getInventory()
    {
        $query = "SELECT * FROM inventory";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addBookToInventory(int $bookId, int $totalCopies, int $availableCopies)
    {
        $query = "INSERT INTO inventory (bookId, totalCopies, availableCopies) VALUES (:bookId, :totalCopies, :availableCopies)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':totalCopies', $totalCopies);
        $stmt->bindParam(':availableCopies', $availableCopies);
        $stmt->execute();
    }

    public function updateInventory(int $bookId, int $totalCopies, int $availableCopies)
    {
        $query = "UPDATE inventory SET totalCopies = :totalCopies, availableCopies = :availableCopies WHERE bookId = :bookId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->bindParam(':totalCopies', $totalCopies);
        $stmt->bindParam(':availableCopies', $availableCopies);
        $stmt->execute();
    }

    public function getBookInventory(int $bookId)
    {
        $query = "SELECT * FROM inventory WHERE bookId = :bookId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bookId', $bookId);
        $stmt->execute();
        return $stmt->fetch();
    }
}