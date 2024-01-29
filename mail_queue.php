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
    <div class="">
        <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table">
                <tr>
                <th scope="col">S.No</th>
                <th scope="col">Type</th>
                <th scope="col">Server Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Content</th>
                <th scope="col">Hold</th>
                <th scope="col">Corrupt</th>
                <th scope="col">Deferred</th>
                <th scope="col">Actie</th>
                <th scope="col">Incoming</th>
                <th scope="col">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                    select
                        type,
                        server_name,
                        subject,
                        message_body,
                        hold,
                        corrupt,
                        deferred,
                        active,
                        incoming,
                        create_datetime
                    from
                        mail_queue
                        order by create_datetime desc
                    ";
                $data = mysqli_query($connection, $query);
                $s_no = 0;
                while ($row = mysqli_fetch_assoc($data)) {
                    $s_no += 1;
                    echo "<tr>
                            <th scope='row'>$s_no</th>
                            <td>" . $row['type'] . "</td>
                            <td>" . $row['server_name'] . "</td>
                            <td>" . $row['subject'] . "</td>
                            <td>" . $row['message_body'] . "</td>
                            <td>" . $row['hold'] . "</td>
                            <td>" . $row['corrupt'] . "</td>
                            <td>" . $row['deferred'] . "</td>
                            <td>" . $row['active'] . "</td>
                            <td>" . $row['incoming'] . "</td>
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