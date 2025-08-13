<?php

// index.php

echo "<h1>Welcome to My Control Structures Project</h1>";

// Use require_once to load the class files.
// The path is relative to index.php.
require_once 'database/Database.php';
require_once 'User.php';

// Now that the classes are loaded, we can use them.

// 1. Create an instance of the Database class.
$db = new Database();

// 2. Create an instance of the User class, passing the database object.
$user = new User($db);

// 3. Use a method from the User object.
echo "User's name is: " . $user->getName();

?>