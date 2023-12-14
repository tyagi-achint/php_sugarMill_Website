<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <!-- Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th {

        text-align: center !important;
        font-size: x-large !important;
        font-family: 'Bree Serif';
        font-weight: 600;
    }

    th,
    td {
        border: 2px solid black;
        padding: 8px;
        text-align: left;
        font-size: larger;
        min-width: 120px;
        font-weight: bold;


    }

    table {
        background-color: #5fbdff2e;
    }

    td {
        padding-bottom: 10px;
    }
    </style>
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>

    <div class="order-container">
        <h2>Order History</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Weight</th>
                <th>Status</th>
            </tr>
            <?php
    include '../server.php';

    session_start();
    $username = $_SESSION['username'];

    // Fetch data from the database
    $sql = "SELECT * FROM sugar_order WHERE sh_username = '$username' ORDER BY date DESC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $statusColor = ($row["sh_status"] == 'Approved') ? 'green' : 'red';
            echo "<tr >
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["product"] . "</td>
                    <td>" . $row["weight"] . "</td>
                    <td style='background-color: $statusColor;text-align:center; color:white;font-weight: 700;  font-family: Bree Serif; letter-spacing: 1.5px;' >" . $row["sh_status"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }

    $con->close();
    ?>
        </table>

        <p><a href="store.php"><button>Back</button></a></p>

    </div>

</body>

</html>