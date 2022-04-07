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
}
