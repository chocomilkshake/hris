<?php
include '../process/config.php';

$province_id = $_POST['province_id'];

$stmt = $con->prepare("SELECT * FROM refcitymun WHERE provCode=? ORDER BY citymunDesc ASC");
$stmt->bind_param("i", $province_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Select City</option>';
while($row = $result->fetch_assoc()){
    echo '<option value="'.$row['citymunCode'].'">'.$row['citymunDesc'].'</option>';
}
?>
