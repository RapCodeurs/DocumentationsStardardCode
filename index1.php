<?php

// Code qui respecte la norme PSR

session_start();

class User
{
    public $name;

    public $age;

    public $defaultRole;

    public $favoritePages = [];

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;

        $this->defaultRole = isset($_SESSION['DEFAULT_ROLE']) ? $_SESSION['DEFAULT_ROLE'] : 'ROLE_DEFAULT';

    }

    public function addToFavorites($link)
    {

        if (filter_var($link, FILTER_VALIDATE_URL) && !in_array($link, $this->favoritePages)) {
            array_push($this->favoritePages, $link);

            return true;
        }

        return false;
    }

    public function removeFromFavorites($link)
    {
        if (filter_var($link, FILTER_VALIDATE_URL) && in_array($link, $this->favoritePages)) {
            unset($this->favoritePages[array_search($link, $this->favoritePages)]);

            return true;
        }

        return false;
    }
}

$user = new User('Eric', 45);

// true
echo $user->addToFavorites('https://www.google.com/');
// false
echo $user->addToFavorites('https://www.google.com/');

// true
echo $user->removeFromFavorites('https://www.google.com/');

// ROLE_DEFAULT
echo $user->defaultRole;

$_SESSION['DEFAULT_ROLE'] = 'ROLE_USER';
$user2 = new User('Marie', 40);

// ROLE_USER
echo $user2->defaultRole;

unset($_SESSION['DEFAULT_ROLE']);