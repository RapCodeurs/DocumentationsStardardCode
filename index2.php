<?php

// Code utilisant les derniers fonctionalités PHP 8.1

session_start();

class User
{
    // Depuis PHP 7.4, il est possible de typer les propriétés d'une classe
    public string $defaultRole;

    /** @var array<int, string> $favoritePages */
    public array $favoritePages = [];

    // Les paramètres d'entrée d'une fonction peuvent être typés avec les types string / int depuis PHP 7.0
    // PHP 8.0 introduit la promotion de propriété de constructeur. Ces propriétés n'ont plus besoin d'être déclarées dans la class ni assignés dans le constructeur, c'est fait automatiquement
    public function __construct(public string $name, public int $age)
    {
        // Depuis PHP 7.0, ce nouvel opérateur permet d'éviter la répétition dont nous disposions auparavant
        $this->defaultRole = $_SESSION['DEFAULT_ROLE'] ?? 'ROLE_DEFAULT';
    }

    // Les paramètres de sortie d'une fonction peuvent être typés depuis PHP 7.0
    public function addToFavorites(string $link): bool
    {

        if (filter_var($link, FILTER_VALIDATE_URL) && !in_array($link, $this->favoritePages)) {
            array_push($this->favoritePages, $link);

            return true;
        }

        return false;
    }

    public function removeFromFavorites(string $link): bool
    {
        if (filter_var($link, FILTER_VALIDATE_URL) && in_array($link, $this->favoritePages)) {
            unset($this->favoritePages[array_search($link, $this->favoritePages)]);

            return true;
        }

        return false;
    }
}

$user = new User('Eric', 45);


// PHP 8.0 introduit les arguments nommés en plus des arguments positionnels
echo $user->addToFavorites(link: 'https://www.google.com/');
// false
echo $user->addToFavorites(link: 'https://www.google.com/');

// true
echo $user->removeFromFavorites('https://www.google.com/');

// ROLE_DEFAULT
echo $user->defaultRole;

$_SESSION['DEFAULT_ROLE'] = 'ROLE_USER';
$user2 = new User('Marie', 40);

// ROLE_USER
echo $user2->defaultRole;

unset($_SESSION['DEFAULT_ROLE']);