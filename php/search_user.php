<?php

require_once('SQL_login.php');

<<<<<<< Updated upstream
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



=======
$response = [
    'success' => false,
    'users' => [],
];

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

if ($searchTerm) {
    $search = str_replace(",", "|", $searchTerm);
    $query = "
        SELECT * FROM $table 
        WHERE username REGEXP '".$search."' 
        OR phone_num REGEXP '".$search."' 
        OR email REGEXP '".$search."' 
        OR points REGEXP '".$search."'
    ";
} else {
    $query = "SELECT * FROM $table ORDER BY id";
}

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll();

    if ($result !== false) {
        $response['success'] = true;
        $response['users'] = $result;
    } else {
        $response['error'] = 'Error fetching users from the database.';
    }
} catch (\PDOException $e) {
    $response['error'] = 'Error executing the search query: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
>>>>>>> Stashed changes
?>
