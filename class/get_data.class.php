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
                <td><img src="" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td>50
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dot s-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="employee_info.php"><i class="bx bx-edit-alt me-1"></i> View</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
<?php
        }
    }
}


?>