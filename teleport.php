<?php
$servername = '127.0.0.1';
$username = 'acore';
$password = 'acore';
$dbname = 'acore_characters';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$char_name = strtolower($_POST['char_name']); // In Kleinbuchstaben umwandeln
$teleport_destination = $_POST['teleport_destination'];

$sql = "SELECT guid FROM characters WHERE LOWER(name)='$char_name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $guid = $row['guid'];


        if ($teleport_destination == 'sturmwind') {
        $update_sql = "UPDATE characters SET position_x = -8821.48, position_y = 628.866, position_z = 95.526, map = 0 WHERE guid = $guid";
        echo "Character erfolgreich nach Sturmwind teleportiert";
    } elseif ($teleport_destination == 'orgrimmar') {
        $update_sql = "UPDATE characters SET position_x = 1613.94, position_y = -4391.45, position_z = 24.0333, map = 1 WHERE guid = $guid";
        echo "Character erfolgreich nach Orgrimmar teleportiert";
    } else {
        echo "Ungültiges Teleport-Ziel ausgewählt";
    }


    if (mysqli_query($conn, $update_sql)) {
        echo " ";
    } else {
        echo "Fehler beim Teleport: " . mysqli_error($conn);
    }
} else {
    die("Character not found!");
}


mysqli_close($conn);
?>
