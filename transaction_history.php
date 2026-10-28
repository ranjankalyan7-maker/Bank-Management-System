
<?php
include "db.php";

$result = $conn->query(
    "SELECT * FROM transactions ORDER BY transaction_date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Transaction History</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Transaction ID</th>
        <th>Account Number</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['account_no']; ?></td>
        <td><?php echo htmlspecialchars($row['transaction_type']); ?></td>
        <td>₹<?php echo $row['amount']; ?></td>
        <td><?php echo $row['transaction_date']; ?></td>
    </tr>
    <?php } ?>

</table>

<br>
<a href="index.html">Home</a>

</body>
</html>
