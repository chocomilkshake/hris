<?php
require_once '../process/config.php';

$city_id = $_POST['city_id'];

$stmt = $con->prepare("SELECT brgyCode, brgyDesc FROM refbrgy WHERE citymunCode=? ORDER BY brgyDesc");
$stmt->bind_param("i", $city_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Select Barangay</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['brgyCode'].'">'.$row['brgyDesc'].'</option>';
}
