<?php
include "db.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $account = (int)$_POST['account'];
    $balance = (float)$_POST['balance'];

    if ($name != "" && $account > 0 && $balance >= 0) {
        $stmt = $conn->prepare(
            "INSERT INTO customers (name, phone, address)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $name, $phone, $address);

        if ($stmt->execute()) {
            $id = $conn->insert_id;

            $stmt2 = $conn->prepare(
                "INSERT INTO accounts (account_no, customer_id, balance)
                 VALUES (?, ?, ?)"
            );
            $stmt2->bind_param("iid", $account, $id, $balance);

            if ($stmt2->execute()) {
                echo "Customer added successfully!";
            } else {
                echo "Account number may already exist.";
            }
        } else {
            echo "Unable to add customer.";
        }
    } else {
        echo "Enter valid details.";
    }
}
?>

<h2>Add Customer</h2>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Phone: <input type="text" name="phone"><br><br>
    Address: <input type="text" name="address"><br><br>
    Account Number: <input type="number" name="account" required><br><br>
    Opening Balance: <input type="number" name="balance"
                            min="0" step="0.01" required><br><br>
    <button type="submit" name="submit">Add Customer</button>
</form>

<a href="index.html">Home</a>