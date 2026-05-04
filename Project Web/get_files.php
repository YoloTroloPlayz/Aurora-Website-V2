<?php
$conn = mysqli_connect("localhost", "root", "", "login_systeem");
$result = mysqli_query($conn, "SELECT id, filename, path FROM files LIMIT 5");
$files = [];
while ($row = mysqli_fetch_assoc($result)) {
    $files[] = $row;
}
echo json_encode($files);
?>