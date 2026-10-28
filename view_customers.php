<?php
include "db.php";

$result = $conn->query(
    "SELECT customers.*, accounts.account_no, accounts.balance
     FROM customers
     LEFT JOIN accounts
     ON customers.customer_id = accounts.customer_id"
);
?>

<h2>Customer Details</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Account Number</th>
        <th>Balance</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['customer_id']; ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['phone'] ?? ''); ?></td>
        <td><?php echo $row['account_no'] ?? ''; ?></td>
        <td><?php echo $row['balance'] ?? ''; ?></td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="index.html">Home</a>