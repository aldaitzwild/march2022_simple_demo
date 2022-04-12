<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function list(): string
    {
        $bookManager = new BookManager();
        $books = $bookManager->selectAll();

        return $this->twig->render('Book/list.html.twig', ['books' => $books]);
    }

    public function show(int $id): string
    {
        $bookManager = new BookManager();
        $book = $bookManager->selectOneById($id);

        return $this->twig->render('Book/details.html.twig', ['book' => $book]);
    }
}
