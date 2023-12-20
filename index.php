<?php	

// Code qui ne respecte pas la norme PSR

session_start();

class user {

    // string
    public $name;

    // entier
    public $age;

    // string
    public $defaultRole;

 public $favoritePages = [];

    public function __construct( 
$name, $age
){
        $this->name = $name; $this->age = $age;

        $this->defaultRole = isset($_SESSION['DEFAULT_ROLE']) ? $_SESSION['DEFAULT_ROLE'] : 'ROLE_DEFAULT'; }

    public function add_to_favorites( 
$link
)
{

        if (filter_var($link, FILTER_VALIDATE_URL) && !in_array($link, $this->favoritePages)) { array_push($this->favoritePages, $link); return true;        }

        return false;}

    public function remove_from_favorites(   $link)      {
        if (filter_var($link, FILTER_VALIDATE_URL) && in_array($link, $this->favoritePages)) 

{
            unset($this->favoritePages[array_search($link, $this->favoritePages)]); return true;
        }return false;}}

$user = new user('Eric', 45);

// true
echo $user->add_to_favorites( “https://www.google.com/”);
// false
echo $user->add_to_favorites( “https://www.google.com/” );

// true
echo $user->remove_from_favorites(“https://www.google.com/” );

// ROLE_DEFAULT
echo $user->defaultRole;

$_SESSION['DEFAULT_ROLE'] = 'ROLE_USER';
$user2 = new user( “Marie” ,  40 );

// ROLE_USER
echo $user2->defaultRole;

unset($_SESSION[ “DEFAULT_ROLE” ]);

?>