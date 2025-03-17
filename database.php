<?php

$errorcode = 0;


function connect_db() {
    $pdo = new PDO("mysql:host=localhost;dbname=dbgast", "gastenboek", "gastenboek");
    return $pdo;
}


function insert_user($u,$a) : bool {
        $result = false;
        if(user_exists($u)){
            global $errorcode;
            $errorcode = 1;
            return false; // end function, return false
        }

        $pdo = connect_db();
        $stmt = $pdo->prepare("INSERT INTO `user` (`name`, `Age`) VALUES (?, ?)");
        $stmt->bindParam(1, $u);
        $stmt->bindParam(2, $a);
        $result = $stmt->execute();
        return $result;
}

function user_exists($u) : bool {
        $pdo = connect_db();
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `name` = ?");
        $stmt->bindParam(1, $u);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return count($result) > 0;
}
    

function get_users() : array {
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM `user` ORDER BY `id` DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}



/*
return a HTML table with the users
*/
function get_html_user_table() : string {
    $result = get_users();
    $html_table = "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>";

    foreach($result as $row){
        $html_table .= "<tr>";
        $html_table .= "<td>" . $row['id'] . "</td>";
        $html_table .= "<td>" . $row['name'] . "</td>";
        $html_table .= "<td>" . $row['age'] . "</td>";
        $html_table .= "</tr>";
    }
    $html_table .= "</table>";
    return $html_table;
}

?>
