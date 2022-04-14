<?php

namespace App\Model;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';

    public function insert(array $book): int
    {
        $query = "INSERT INTO " . self::TABLE . " (title, description, nb_of_pages, author) 
                    VALUES (:title, :description, :nb_of_pages, :author);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('title', $book['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $book['description'], \PDO::PARAM_STR);
        $statement->bindValue('nb_of_pages', $book['nb_of_pages'], \PDO::PARAM_INT);
        $statement->bindValue('author', $book['author'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function getTheBests(): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . " WHERE author in ('Thomas Aldaitz', 'Victor Hugo', 'Toto')";

        return $this->pdo->query($query)->fetchAll();
    }
}
