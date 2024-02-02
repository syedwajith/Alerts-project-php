<?php
require 'index.php';

// Get customer names
function get_customer_names($connection) {
    $customer_name_query = "
        select 
            customer_name
        from 
            customers
            order by customer_name asc";
    $customer_names = mysqli_query($connection, $customer_name_query);

    return $customer_names;
}


// Get alert types
function get_alert_types($connection) {
    $alert_type_name_query = "
        select 
            alert_type_name
        from 
            alert_types
            order by alert_type_name asc";
    $alert_type_names = mysqli_query($connection, $alert_type_name_query);

    return $alert_type_names;
}

// Get top 10 alert details count from current date to previous month date
function get_top_10alerts($connection) {
    $top_alert_query = "
        SELECT 
            customer_name, 
            alert_type
        FROM 
            alert_details 
        WHERE 
            create_datetime BETWEEN CONCAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), ' 00:00:00') AND CONCAT(CURDATE(), ' 23:59:59')
            ORDER BY create_datetime ASC";
    $top_alert_data = mysqli_query($connection, $top_alert_query);
    $top_alert_arr = array();
    while ($row = mysqli_fetch_assoc($top_alert_data)) {
        $top_alert_arr[] = array($row["customer_name"], $row["alert_type"]);
    }

    $top_alert_details = array();
    foreach ($top_alert_arr as list($i, $j)) {
        if (!isset($top_alert_details[$i])) {
            $top_alert_details[$i] = [];
            if (!isset($top_alert_details[$i][$j])) {
                $top_alert_details[$i][$j] = 1;
            } else {
                $top_alert_details[$i][$j]++;
            }
        } else {
            if (!isset($top_alert_details[$i][$j])) {
                $top_alert_details[$i][$j] = 1;
            } else {
                $top_alert_details[$i][$j]++;
            }
        }
    }

    return $top_alert_details;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div class="h2_header">
        <h2>Alert Details</h2>
    </div>
    <form action="alert_datas.php" method="post">
        <div class="container">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label label-bold">Customer Name</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="customer_name" required>
                        <option selected></option>
                        <?php
                        $customer_names = get_customer_names($connection);
                        while ($row = mysqli_fetch_assoc($customer_names)) {
                            echo "<option value='" . $row['customer_name'] . "'>" . $row['customer_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label label-bold">Alert Type</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="alert_type" required>
                    <option selected></option>
                        <?php
                        $alert_type_names = get_alert_types($connection);
                        while ($row = mysqli_fetch_assoc($alert_type_names)) {
                            echo "<option value='" . $row['alert_type_name'] . "'>" . $row['alert_type_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label label-bold">From Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="date" name="from_date" required/>
                </div>
                <div class="col-sm-2"></div>
                <label class="col-sm-2 col-form-label label-bold">To Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="date" name="to_date" required/>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>
    
    <div class="h4_header">
        <h4>Top 10 Alerts</h4>
    </div>
    <div class="">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table">
                <tr>
                <th scope="col">S.No</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Alert Type</th>
                <th scope="col">Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $top_alerts_data = get_top_10alerts($connection);
                $s_no = 0;
                foreach ($top_alerts_data as $customer_name => $alerts) {
                    foreach ($alerts as $alert_name => $count) {
                        $s_no += 1;
                        echo "<tr>
                                <th scope='row'>$s_no</th>
                                <td>" . $customer_name . "</td>
                                <td>" . $alert_name . "</td>
                                <td>" . $count . "</td>
                            </tr>";
                    }
                }   
                ?>
            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
    
</body>
</html>
