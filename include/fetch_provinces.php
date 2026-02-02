<?php
include '../process/config.php';

$region_id = $_POST['region_id'];

$stmt = $con->prepare("SELECT * FROM refprovince WHERE regCode=? ORDER BY provDesc ASC");
$stmt->bind_param("i", $region_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Select Province</option>';
while($row = $result->fetch_assoc()){
    echo '<option value="'.$row['provCode'].'">'.$row['provDesc'].'</option>';
}
?>
