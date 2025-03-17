<?php




// records tonen uit database
//require("database.php");

require("classes/db.php");

$db = new db(); // instance van de class maken -> object


//var_dump($db->get_users());
//echo $db->hello_world();
//echo $db->message("Hello world too");

//var_dump($db->users);


// Wat gaan we doen

// 1. Error handling
// 2. User Input valideren
// 3. ??

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border: 1px solid black;
        }
        </style>

</head>
<body>
    <form method="post" action="verwerk.php">
        <input type="text" name="user" placeholder="User">
        <input type="text" name="age" placeholder="Age">
        
        <button>Send</button>
    </form>

    <p>Latest records:</p>
    <?=$db->get_html_user_table() ?>

   


</body>
</html>