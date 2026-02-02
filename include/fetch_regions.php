<?php
include '../process/config.php';

$result = $con->query("SELECT * FROM refregion ORDER BY regDesc ASC");

echo '<option value="">Select Region</option>';
while($row = $result->fetch_assoc()){
    echo '<option value="'.$row['regCode'].'">'.$row['regDesc'].'</option>';
}
?>