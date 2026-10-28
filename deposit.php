<?php
include "db.php";

if (isset($_POST['submit'])) {
    $account = (int)$_POST['account'];
    $amount = (float)$_POST['amount'];

    if ($account > 0 && $amount > 0) {
        $stmt = $conn->prepare(
            "UPDATE accounts SET balance = balance + ?
             WHERE account_no = ?"
        );
        $stmt->bind_param("di", $amount, $account);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $type = "Deposit";

            $stmt2 = $conn->prepare(
                "INSERT INTO transactions
                 (account_no, transaction_type, amount)
                 VALUES (?, ?, ?)"
            );
            $stmt2->bind_param("isd", $account, $type, $amount);
            $stmt2->execute();

            echo "Money deposited successfully!";
        } else {
            echo "Account not found.";
        }
    } else {
        echo "Enter a valid account number and amount.";
    }
}
?>

<h2>Deposit Money</h2>

<form method="post">
    Account Number: <input type="number" name="account" required><br><br>
    Amount: <input type="number" name="amount" min="0.01"
                   step="0.01" required><br><br>
    <button type="submit" name="submit">Deposit</button>
</form>

<a href="index.html">Home</a>