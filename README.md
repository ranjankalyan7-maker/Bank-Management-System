# 🏦 Bank Management System

A DBMS-focused Bank Management System for managing customer information, bank accounts, deposits, withdrawals, and transaction records.

Built with:

- HTML and CSS for the user interface
- PHP for server-side logic
- MySQL 8+ for database management
- XAMPP for local development
- MySQL Workbench for database setup and queries

This project demonstrates relational database design, primary and foreign keys, CRUD operations, SQL queries, database connectivity, and basic banking operations.

## Features

### Customer Management

- Add new customers with their personal details
- Assign an account number and opening balance
- View customer and account information
- Store customer records in MySQL

### Banking Operations

- Deposit money into an existing account
- Withdraw money when sufficient balance is available
- Update account balances
- Record deposits and withdrawals in the transactions table

### Database Features

- Relational database with three main tables
- Primary keys and foreign key relationships
- Automatic customer and transaction IDs
- SQL queries for inserting, retrieving, and updating records

## Prerequisites

Install the following before starting:

- Windows
- XAMPP with Apache and PHP
- MySQL Server 8+ or a compatible MySQL version
- MySQL Workbench (recommended)

Check that Apache is running in XAMPP and that your MySQL server is running.

## First-Time Setup

### 1. Open the project

Place the project folder inside the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\BankManagement
```

### 2. Start Apache and MySQL

Open XAMPP Control Panel and start Apache.

If you already have MySQL Server running separately through MySQL Workbench, you can use that server. You do not need to start XAMPP's MySQL service as well if it conflicts on port 3306.

### 3. Create the database

Open MySQL Workbench, connect to your MySQL server, and execute:

```sql
CREATE DATABASE IF NOT EXISTS bank_management;
USE bank_management;

CREATE TABLE IF NOT EXISTS customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    address VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS accounts (
    account_no INT PRIMARY KEY,
    customer_id INT NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0.00,
    FOREIGN KEY (customer_id)
        REFERENCES customers(customer_id)
);

CREATE TABLE IF NOT EXISTS transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    account_no INT NOT NULL,
    transaction_type VARCHAR(20),
    amount DECIMAL(10,2),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_no)
        REFERENCES accounts(account_no)
);
```

The script creates the database and its three tables if they do not already exist. It does not delete existing records.

### 4. Configure database connectivity

Open `db.php` and configure it with your local MySQL credentials:

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

Replace `YOUR_MYSQL_PASSWORD` with your own MySQL password. If your local MySQL account has no password, use an empty string (`""`).

**Security note:** Never upload real passwords or private database credentials to a public GitHub repository.

### 5. Run the project

1. Start Apache in XAMPP.
2. Make sure MySQL Server is running.
3. Open your browser.
4. Visit:

```text
http://localhost/BankManagement/
```

The homepage provides links to the customer and banking operation pages.

## Demo Workflow

To test the project:

1. Open **Add Customer**.
2. Enter a customer's name, phone, address, account number, and opening balance.
3. Open **View Customers** to verify the record.
4. Use **Deposit Money** to add funds to an existing account.
5. Use **Withdraw Money** to withdraw an amount within the available balance.
6. Check the transaction records if the transaction history page is implemented.

Use sample data only. This project is intended for learning and demonstration, not real banking.

## Database Design

The database contains three main tables.

### 1. customers

Stores customer details.

- Primary key: `customer_id`
- Fields: `name`, `phone`, `address`
- A customer can be associated with an account.

### 2. accounts

Stores bank account information.

- Primary key: `account_no`
- Foreign key: `customer_id` references `customers.customer_id`
- Field: `balance`
- Stores the current account balance.

### 3. transactions

Stores deposit and withdrawal records.

- Primary key: `transaction_id`
- Foreign key: `account_no` references `accounts.account_no`
- Fields: `transaction_type`, `amount`, `transaction_date`

## Database Relationships

```text
customers
---------
customer_id (PK)
name
phone
address
     |
     | customer_id
     v
accounts
--------
account_no (PK)
customer_id (FK)
balance
     |
     | account_no
     v
transactions
------------
transaction_id (PK)
account_no (FK)
transaction_type
amount
transaction_date
```

- A customer can have an associated account.
- An account can have multiple transaction records.
- Foreign keys help maintain relationships between records.

## Project Structure

```text
BankManagement/
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

Only include `transaction_history.php` if that file exists in your repository.

## Common Commands and SQL Queries

### View all customers

```sql
SELECT * FROM customers;
```

### View all accounts

```sql
SELECT * FROM accounts;
```

### View transaction records

```sql
SELECT * FROM transactions
ORDER BY transaction_date DESC;
```

### View customer and account details

```sql
SELECT
    customers.customer_id,
    customers.name,
    customers.phone,
    accounts.account_no,
    accounts.balance
FROM customers
JOIN accounts
ON customers.customer_id = accounts.customer_id;
```

## Troubleshooting

### Database connection failed

- Make sure MySQL Server is running.
- Check the database name in `db.php`.
- Verify the MySQL username and password.
- Confirm that the server is listening on the expected port.

### Apache does not start

- Check whether another application is using port 80.
- Close conflicting services or configure Apache to use another port.

### Account number is out of range

Check the data type of `accounts.account_no` in MySQL Workbench. Use a suitable integer type for the account numbers you intend to enter, while ensuring the referencing `transactions.account_no` column has a compatible type.

### Customer does not appear

- Confirm that the customer was successfully inserted.
- Check the `customers` and `accounts` tables in MySQL Workbench.
- Refresh the View Customers page.

### Deposit or withdrawal does not work

- Verify that the account number exists.
- Enter a positive amount.
- Ensure the account has sufficient funds before withdrawing.

## Academic DBMS Concepts Demonstrated

- Relational database design
- Tables, rows, and columns
- Primary and foreign keys
- Entity relationships
- CRUD operations
- SQL `INSERT`, `SELECT`, and `UPDATE` queries
- Database connectivity using PHP and MySQL
- Data integrity through foreign key constraints
- Basic transaction record management

## Future Improvements

- Student-friendly or customer login system
- Search customers by name or account number
- Account statement generation
- Improved validation and error messages
- Secure authentication and authorization
- Atomic database transactions for balance updates and transaction logging
- Responsive dashboard and improved interface

## Disclaimer

This project is developed for **educational purposes as a DBMS mini project**. It is not a real banking application and should not be used to store real financial information or process actual banking transactions.

## Author

Developed as a college DBMS mini project.
