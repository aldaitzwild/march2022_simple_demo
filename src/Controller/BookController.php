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
        $bgColor = "white";

        if (isset($_SESSION['color' . $id])) {
            $bgColor = $_SESSION['color' . $id];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['bgColor'])) {
                $bgColor = $_POST['bgColor'];
                $_SESSION['color' . $id] = $bgColor;
            }
        }

        return $this->twig->render('Book/details.html.twig', ['book' => $book, 'bgcolor' => $bgColor]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $book = array_map('trim', $_POST);

            // if validation is ok, insert and redirection
            $bookManager = new BookManager();
            $bookManager->insert($book);

            header('Location:/books');
            return null;
        }

        return $this->twig->render('Book/add.html.twig');
    }

    public function listTheBests(): string
    {
        $bookManager = new BookManager();
        $theBestbooks = $bookManager->getTheBests();

        return $this->twig->render('Book/list.html.twig', ['books' => $theBestbooks]);
    }

    public function refreshColors(): void
    {
        session_destroy();
        header('Location: /books');
    }
}
