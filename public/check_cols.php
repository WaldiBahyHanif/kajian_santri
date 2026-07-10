<?php
$mysqli = new mysqli("localhost", "root", "", "kajian-santri");
$result = $mysqli->query("SHOW COLUMNS FROM students");
$columns = [];
while ($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
}
echo implode(', ', $columns);
