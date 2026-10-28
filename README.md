# 🏦 Bank Management System

A simple **Bank Management System** developed as a DBMS mini project using **HTML, CSS, PHP, and MySQL**. This project helps manage customer details, bank accounts, deposits, and withdrawals through a simple web interface.

## 📌 Project Overview

The Bank Management System is designed to perform basic banking operations and demonstrate how a web application connects with a relational database.

## ✨ Features

- **Add Customer:** Register new customers with their details and account information.
- **View Customers:** Display customer and account details.
- **Deposit Money:** Add money to an existing account.
- **Withdraw Money:** Withdraw money when sufficient balance is available.
- **Transaction Records:** Store deposit and withdrawal details in the database.
- **Database Connectivity:** Connect the PHP application to MySQL.

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL
- **Database Tool:** MySQL Workbench

## 📂 Project Structure

```text
Bank-Management-System/
│
├── index.html
├── style.css
├── db.php
├── add_customer.php
├── view_customers.php
├── deposit.php
├── withdraw.php
└── transaction_history.php
```

## ⚙️ Installation and Setup

### 1. Install the Required Software

Install:
- MySQL Server
- MySQL Workbench (optional)

### 2. Copy the Project Folder

Place the project folder inside the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\BankManagement
```

### 3. Create the Database

Open MySQL Workbench and execute the following SQL:

```sql
CREATE DATABASE bank_management;
USE bank_management;

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    address VARCHAR(100)
);

CREATE TABLE accounts (
    account_no INT PRIMARY KEY,
    customer_id INT NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0.00,
    FOREIGN KEY (customer_id)
        REFERENCES customers(customer_id)
);

CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    account_no INT NOT NULL,
    transaction_type VARCHAR(20),
    amount DECIMAL(10,2),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_no)
        REFERENCES accounts(account_no)
);
```

### 4. Configure Database Connectivity

Open `db.php` and update the database credentials to match your local MySQL setup.

Example:

```php
<?php
$conn = new mysqli(
    "localhost",
    "root",
    "YOUR_MYSQL_PASSWORD",
    "bank_management"
);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>
```

Replace `YOUR_MYSQL_PASSWORD` with your own local MySQL password. Do not upload real passwords to a public repository.

### 5. Run the Project

. Make sure your MySQL server is running.
. Open your browser.
. Visit:

```text
http://localhost/BankManagement/
```

## 🗄️ Database Tables

| Table | Purpose |
|---|---|
| `customers` | Stores customer information |
| `accounts` | Stores account numbers and balances |
| `transactions` | Stores deposit and withdrawal records |

## 🎓 Learning Outcomes

- Understanding database design and relationships.
- Performing CRUD operations using PHP and MySQL.
- Connecting a web application to a database.
- Using SQL queries to insert, retrieve, and update data.
- Understanding basic transaction record management.

## 🚀 Future Improvements

- Customer login and authentication.
- Improved transaction history and account statements.
- Better input validation and error handling.
- Admin dashboard and customer search.
- Stronger security and transaction consistency.



Created as a college DBMS mini project.

