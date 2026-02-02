<?php
class get_data
{


    public function company_list($con)
    {

        $sql = "SELECT * FROM `company`";
        $stms = $con->prepare($sql);
        $stms->execute();
        $result = $stms->get_result();
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <th scope="row">1</th>
                <td><img src="<?php echo $row['logo_dir']; ?>" width="30" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td>50
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="employee_info.php"><i class="bx bx-edit-alt me-1"></i> View</a>
                            <a class="dropdown-item" href="delete_company.php?id=<?php echo $row['id']; ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
<?php
        }
    }

    public function satellite($con)
    {
        $stmt = $con->prepare("SELECT * FROM refprovince");
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<option value="">Select Province</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['provCode'] . '">' . $row['provDesc'] . '</option>';
        }
    }
}


?>