<?php
require 'index.php';
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
                        $customer_name_query = "
                            select 
                                customer_name
                            from 
                                customers
                                order by customer_name asc
                            ";
                        $customer_names = mysqli_query($connection, $customer_name_query);

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
                        $alert_type_name_query = "
                            select 
                                alert_type_name
                            from 
                                alert_types
                                order by alert_type_name asc
                            ";
                        $alert_type_name = mysqli_query($connection, $alert_type_name_query);

                        while ($row = mysqli_fetch_assoc($alert_type_name)) {
                            echo "<option value='" . $row['alert_type_name'] . "'>" . $row['alert_type_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>
    
    
    <div class="">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table">
                <tr>
                <th scope="col">S.No</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Alert Type</th>
                <th scope="col">Subject</th>
                <th scope="col">Content</th>
                <th scope="col">Details</th>
                <th scope="col">Image File Name</th>
                <th scope="col">image</th>
                <th scope="col">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                    select
                        customer_name,
                        alert_type,
                        subject,
                        html_text,
                        plain_text,
                        img_file_name,
                        image,
                        create_datetime
                    from
                        alert_details
                        order by create_datetime desc
                    ";
                $data = mysqli_query($connection, $query);
                $s_no = 0;
                while ($row = mysqli_fetch_assoc($data)) {
                    $s_no += 1;
                    echo "<tr>
                            <th scope='row'>$s_no</th>
                            <td>" . $row['customer_name'] . "</td>
                            <td>" . $row['alert_type'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['html_text'] . "</td>
                            <td>" . $row['plain_text'] . "</td>
                            <td>" . $row['img_file_name'] . "</td>
                            <td>" . $row['image'] . "</td>
                            <td>" . $row['create_datetime'] . "</td>
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
    </script>
    
</body>
</html>