<?php
class get_data
{
    /* =========================================================
       FUNCTION: company_list()
       PURPOSE : Fetch all companies and display them in table rows
       PARAM   : $con (MySQLi connection)
       DEBUG   : Check query, execution, and returned rows
    ========================================================= */
    public function company_list($con)
    {


        // 🔹 SQL query to get all companies
        $sql = "SELECT * FROM `company`";

        // 🔹 Prepare statement (Prevents SQL errors & injection)
        $stms = $con->prepare($sql);
        if (!$stms) {
            die("❌ SQL Prepare Failed: " . $con->error); // Debug if query is wrong
        }

        // 🔹 Execute query
        if (!$stms->execute()) {
            die("❌ SQL Execute Failed: " . $stms->error); // Debug execution issue
        }

        // 🔹 Get result set
        $result = $stms->get_result();
        if (!$result) {
            die("❌ Getting result failed."); // Debug if MySQLnd not enabled
        }

        // 🔹 Counter for row numbering (instead of hardcoded '1')
        $count = 1;

        // 🔹 Loop through each company
        while ($row = $result->fetch_assoc()) {

            // DEBUG: Uncomment to inspect data
            // echo "<pre>"; print_r($row); echo "</pre>";
            function encrypt_id($id)
            {
                $key = "MY_SECRET_KEY_12345";
                return openssl_encrypt($id, "AES-128-ECB", "crempcoop");
            }

            $secure_id = encrypt_id($row['id']);
?>
            <tr>
                <!-- 🔹 Auto row number -->
                <th scope="row"><?php echo $count++; ?></th>

                <!-- 🔹 Company Logo -->
                <td>
                    <img src="<?php echo $row['logo_dir']; ?>" width="30" alt="logo">
                </td>

                <!-- 🔹 Company Name -->
                <td><?php echo $row['name']; ?></td>

                <!-- 🔹 Placeholder for employee count (static for now) -->
                <td>50</td>

                <!-- 🔹 Action buttons -->
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <!-- View company employees -->
                            <a class="dropdown-item" href="employee_info.php?company_id=<?= urlencode($secure_id) ?>">
                                <i class="bx bx-edit-alt me-1"></i> View
                            </a>

                            <!-- Delete company (check if ID exists) -->
                            <a class="dropdown-item" href="delete_company.php?id=<?php echo $row['id']; ?>">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
<?php
        }

        // 🔹 Close statement after use
        $stms->close();
    }


    /* =========================================================
       FUNCTION: satellite()
       PURPOSE : Load provinces into <select> dropdown
       PARAM   : $con (MySQLi connection)
       DEBUG   : Check if refprovince table has data
    ========================================================= */
    public function satellite($con)
    {
        // 🔹 Fetch provinces
        $stmt = $con->prepare("SELECT * FROM refprovince");
        if (!$stmt) {
            die("❌ Province Query Prepare Failed: " . $con->error);
        }

        if (!$stmt->execute()) {
            die("❌ Province Query Execute Failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // DEBUG: If dropdown empty, check table data
        if ($result->num_rows == 0) {
            echo '<option disabled>No provinces found</option>';
        }

        // 🔹 Output options
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['provCode'] . '">' . $row['provDesc'] . '</option>';
        }

        $stmt->close();
    }

    public function employee($con, $companyId)
    {
        // 🔹 Fetch employees WITH province description
        $stmt = $con->prepare("
    SELECT 
        e.*, 
        rp.provDesc 
    FROM employees e
    LEFT JOIN refprovince rp ON e.satellite_office = rp.provCode
    WHERE e.company = ?
");

        if (!$stmt) {
            die("❌ Employee Query Prepare Failed: " . $con->error);
        }

        if (!$stmt->bind_param("i", $companyId)) {
            die("❌ Employee Query Bind Failed: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            die("❌ Employee Query Execute Failed: " . $stmt->error);
        }

        $result = $stmt->get_result();


        // DEBUG: If no employees found
        if ($result->num_rows == 0) {
            echo '<tr><td colspan="5">No employees found</td></tr>';
        }
        $count = 1;
        // 🔹 Output employee rows
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $count++ . '</td>
                    <td> <img src="' . $row['photo_dir'] . '" width="30" alt="photo"></td>
                    <td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>
                    <td>' . $row['department'] . '</td>
                    <td>' . ($row['provDesc'] ?? 'N/A') . '</td>
                    
                  </tr>';
        }

        $stmt->close();
    }
}
?>