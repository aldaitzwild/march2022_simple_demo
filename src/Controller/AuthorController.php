<?php

namespace App\Controller;

use App\Model\AuthorManager;

class AuthorController extends AbstractController
{
    public function showList(): string
    {
        $authorManager = new AuthorManager();
        $authors = $authorManager->selectAll();

        return $this->twig->render('Author/authors.html.twig', ['authors' => $authors]);
    }
}
