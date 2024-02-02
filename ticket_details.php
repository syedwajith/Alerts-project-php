<?php
require 'index.php';

// Get ticket details
function get_ticket_details($connection) {
    $query = "
        select
            ticket_number,
            subject,
            message_body,
            create_datetime
        from
            ticket_details
            order by create_datetime desc";
    $data = mysqli_query($connection, $query);

    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="h2_header">
        <h2>Ticket Details</h2>
    </div>
    <div class="">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table">
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
                $ticket_details_data = get_ticket_details($connection);
                $s_no = 0;
                while ($row = mysqli_fetch_assoc($ticket_details_data)) {
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
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
    
</body>
</html>