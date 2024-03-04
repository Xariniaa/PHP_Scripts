<?php
$servername = '127.0.0.1';
$username = 'acore';
$password = 'acore';
$dbname = 'acore_characters';
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}


$sql = "SELECT c.name AS Name, ca.achievement AS Erfolg
        FROM character_achievement ca
        JOIN characters c ON ca.Guid = c.guid
        WHERE ca.achievement = 664";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Spieler mit bestimmtem Erfolg</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .purple {
            color: purple;
        }
    </style>
</head>
<body>
    <h1>Hardcore Helden</h1>

    <h2>Spieler mit Geschaffter No-Die-Challenge</h2>

    <?php
    if ($result->num_rows > 0) {
       
        echo '<table>';
        echo '<tr><th>Name</th><th class="purple">Hardcore</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["Name"] . '</td>';
            
        
            $hasAchievement = $row["Erfolg"] == 683;
            echo '<td class="purple">' . ($hasAchievement ? 'Hardcore Erfolg' : '') . '</td>';
            
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Keine Spieler mit dem angegebenen Erfolg gefunden.";
    }


    $conn->close();
    ?>
</body>
</html>
