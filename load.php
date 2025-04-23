<?php
$conn = new mysqli("localhost", "username", "password", "db_name");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT * FROM banconote";
$result = $conn->query($sql);

if (!$result) {
    die("Errore nella query: " . $conn->error);
}

$quantita = [];
while ($row = $result->fetch_assoc()) {
    $quantita[$row['taglio']] = $row['quantita'];
}
echo json_encode($quantita);
$conn->close();
