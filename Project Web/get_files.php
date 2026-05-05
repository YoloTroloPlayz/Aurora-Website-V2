<?php
$conn = mysqli_connect("localhost", "root", "", "login_systeem");
$query = $_GET['q'] ?? '';
$safe = mysqli_real_escape_string($conn, $query);
$result = mysqli_query($conn, "SELECT id, filename, path FROM files WHERE filename LIKE '%$safe%' LIMIT 20");
$files = [];
while ($row = mysqli_fetch_assoc($result)) {
    $files[] = $row;
}
echo json_encode($files);
?>