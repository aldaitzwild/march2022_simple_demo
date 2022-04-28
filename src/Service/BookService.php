<?php

namespace App\Service;

class BookService
{
    public function checkBookFields(array $book): array
    {
        $errors = [];

        if (strlen($book['title']) > 255) {
            $errors['title'] = 'Le titre ne doit pas dépasser les 255 caractères.';
        }

        $description = $book['description'];
        $descriptionWords = explode(' ', $description);
        if (count($descriptionWords) < 10) {
            $errors['description'] = 'La description doit contenir au moins 10 mots.';
        }

        if (!filter_var($book['nb_of_pages'], FILTER_VALIDATE_INT)) {
            $errors['nb_of_pages'] = 'Le nombre de page doit etre un nombre.';
        }

        return $errors;
    }
}
