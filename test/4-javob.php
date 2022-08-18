<?php
$servername = "localhost";
$username = "root";
$password = "azizbek96";
$dbname = "task_back2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  users.id, 
                users.name, 
                users.lastname, 
                users.status, 
                profile.description,
                profile.type 
        FROM users 
        LEFT JOIN profile ON profile.user_id=users.id 
        WHERE users.status = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr>
            <th>#</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <th>".$row['id']."</th>
            <th>".$row['name']."</th>
            <th>".$row['lastname']."</th>
            <th>".$row['description']."</th>
            <th>".$row['type']."</th>
            <th>".$row['status']."</th></tr>";
    }
    echo "</table>";
} else {
    echo "Ma'lumot mavjud emas !";
}
$conn->close();