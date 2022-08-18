<?php
$form_data = array(
    'name' => 'Eshmatvoy',
    'surname' => 'Toshmatov',
    'email' => 'eshmatvoy@mail.ru',
    'message' => '<b>Assalomu alaykum!</b><span>Men sizga yozayotganimdan maqsad shuki...</span><script>alert("Voy!");</script>',
);
// massivni keraksiz html teglardan tozalab tashlaymiz
$form_data['message']  = strip_tags($form_data['message']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_backend";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO contact_messages (name, surname, email, message)
VALUES ('".$form_data['name']."', '".$form_data['surname']."', '".$form_data['email']."', '".$form_data['message']."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();