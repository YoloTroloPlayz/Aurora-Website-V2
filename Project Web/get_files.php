<?php
$conn = mysqli_connect("com-linweb644.srv.combell-ops.net", "ID497499_loginsysteem", "IkHaatLarpers1010", "ID497499_loginsysteem");
$query = $_GET['q'] ?? '';
$safe = mysqli_real_escape_string($conn, $query);
$result = mysqli_query($conn, "SELECT id, filename, path FROM files WHERE filename LIKE '%$safe%' LIMIT 20");
$files = [];
while ($row = mysqli_fetch_assoc($result)) {
    $files[] = $row;
}
echo json_encode($files);
?>