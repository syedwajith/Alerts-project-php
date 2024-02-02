<?php
require 'index.php';

$datas = "";

function alert_detail($connection, $customer_name, $alert_type, $from_date, $to_date) {
    $alert_detail_query = "
        select 
            customer_name,
            alert_type,
            subject,
            html_text,
            plain_text,
            img_file_name,
            #image,
            create_datetime
        from
            alert_details
        where
            customer_name in ('$customer_name')
            and alert_type in ('$alert_type')
            and create_datetime between '$from_date' and '$to_date'";
    
    $alert_detail_data = mysqli_query($connection, $alert_detail_query);

    return $alert_detail_data;
}
var_dump($_SERVER["REQUEST_METHOD"]);
<<<<<<< HEAD
if ($_SERVER(["REQUEST_METHOD"] == "POST")) {
=======
if $_SERVER(["REQUEST_METHOD"] == "POST") {
>>>>>>> f44621e7fd66dd6a60865aa046494ead1389b1ab
    $customer_name = htmlspecialchars($_POST["customer_name"]);
    $alert_type = htmlspecialchars($_POST["alert_type"]);
    $from_date = htmlspecialchars($_POST["from_date"]);
    $to_date = htmlspecialchars($_POST["to_date"]);
    echo $customer_name;
    echo "<br>";
    echo $alert_type;
    echo "<br>";
    echo $from_date;
    echo "<br>";
    echo $to_date;
    echo "<br>";
    $datas = alert_detail($connection, $customer_name, $alert_type, $from_date, $to_date);
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
        <h2>Alert Datas</h2>
    </div>
    <div class="">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Alert Type</th>
                    <th scope="col">Subjet</th>
                    <th scope="col">Content</th>
                    <th scope="col">Details</th>
                    <th scope="col">Image File Name</th>
                    <!--<th scope="col">Image</th>-->
                    <th scope="col">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s_no = 0;
                while ($row = mysqli_fetch_assoc($datas)) {
                    $s_no += 1;
                    echo "<tr>
                            <th scope='row'>$s_no</th>
                            <td>" . $row['customer_name'] . "</td>
                            <td>" . $row['alert_type'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['html_text'] . "</td>
                            <td>" . $row['plain_text'] . "</td>
                            <td>" . $row['img_file_name'] . "</td>
                            <!--<td>" . $row['image'] . "</td>-->
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
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> f44621e7fd66dd6a60865aa046494ead1389b1ab
