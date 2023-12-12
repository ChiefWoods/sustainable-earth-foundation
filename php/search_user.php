<?php

require_once('SQL_login.php');

$output = '';

$query = '';
if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
        SELECT * FROM redemption 
        WHERE id REGEXP '".$search."' 
        OR username REGEXP '".$search."' 
        OR used_points REGEXP '".$search."'
        OR reward_id REGEXP '".$search."' 
        OR redemption_date REGEXP '".$search."'
    ";
}
else
{
    $query = "SELECT * FROM redemption ORDER BY id";
}

$statement = $pdo->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);



?>
