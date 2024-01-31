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

    print_r($top_alert_data);

    return $top_alert_data;
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
    <form action="" method="post">
        <div class="container">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label label-bold">Customer Name</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Customer Name</option>
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
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Alert Type</option>
                        <?php
                        $alert_type_names = get_alert_types($connection);
                        while ($row = mysqli_fetch_assoc($alert_type_names)) {
                            echo "<option value='" . $row['alert_type_name'] . "'>" . $row['alert_type_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <label for="date" class="col-1 col-form-label">Date</label>
            <div class="col-5">
                <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" id="date"/>
                    <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
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
                while ($row = mysqli_fetch_assoc($top_alerts_data)) {
                    $s_no += 1;
                    echo "<tr>
                            <th scope='row'>$s_no</th>
                            <td>" . $row['customer_name'] . "</td>
                            <td>" . $row['alert_type'] . "</td>
                            <td>" . $row['alert_type'] . "</td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });

        $(function(){
            $('#datepicker').datepicker();
        });
    </script>
    
</body>
</html>