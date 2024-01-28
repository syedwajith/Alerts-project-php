<?php
require 'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-info">
                <tr>
                <th scope="col">S.No</th>
                <th scope="col">Ticket No</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                    select
                        ticket_number,
                        subject,
                        message_body,
                        create_datetime
                    from
                        ticket_details
                    ";
                $data = mysqli_query($connection, $query);
                $s_no = 0;
                while ($row = mysqli_fetch_assoc($data)) {
                    $s_no += 1;
                    echo "<tr>
                            <th scope='row'>$s_no</th>
                            <td>" . $row['ticket_number'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['message_body'] . "</td>
                            <td>" . $row['create_datetime'] . "</td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js">
      let table = new DataTable('#myTable');
    </script>
</body>
</html>

