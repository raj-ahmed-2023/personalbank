# Personal Banking Data Statement System

## Overview
The **Personal Banking Data Statement System** is a **simple yet powerful PHP-based financial tracking application** designed for personal use on localhost via XAMPP. This system enables users to **track their cash and bank balances**, manage transactions, visualize spending habits, and generate useful financial insights, all within an intuitive web-based dashboard.

---

## Features

### 1. **Dashboard (Comprehensive Overview)**
- Displays **Cash Balance** and **Bank Balance** dynamically updated after every transaction.
- Shows **Total Income and Total Expenses**.
- Lists **Recent Transactions** (latest 5 transactions) with amount, category, description, and payment method.
- Provides an **Expense Breakdown Chart** (Pie Chart via Chart.js) for visualizing spending trends.
- Quick action buttons for adding new transactions and viewing transaction history.

### 2. **Transaction Management**
- **Add Transactions** (income or expense) with category, amount, date, and description.
- **Edit or Delete Transactions** for flexibility in tracking finances.
- Supports **multiple payment methods**: **Cash and PhonePe**.
- Auto-updates respective account balances upon each transaction.

### 3. **Expense Analysis & Visualization**
- Displays **expense breakdown by category** using an interactive **doughnut chart**.
- **Monthly/Yearly Expense Trends** can be added for more detailed financial insights.
- **Filters** for viewing expenses based on time range, category, and payment method.

### 4. **Transaction History**
- A dedicated page to view all transactions.
- **Sortable and filterable list** with transaction date, amount, payment method, and category.
- Option to **export statements** (planned feature: CSV/PDF export functionality).

### 5. **User-Friendly Interface**
- Built with **Bootstrap 5** for a responsive and aesthetically pleasing design.
- Uses **FontAwesome icons** for better UI elements.
- Simple and clean layout for easy navigation.

---

## Installation Guide

### **Prerequisites**
Before setting up this project, ensure you have the following installed on your system:
- **XAMPP** (PHP 7.x or later recommended)
- **MySQL Database** (Included with XAMPP)
- **Web Browser** (Chrome, Firefox, Edge, etc.)

### **Setup Instructions**
1. **Clone or Download the Repository**
   ```sh
   git clone https://github.com/raj-ahmed-2023/personalbank
   ```
   or simply download the ZIP file and extract it to your `htdocs` folder.

2. **Start XAMPP and MySQL**
   - Open **XAMPP Control Panel**.
   - Start **Apache** and **MySQL** services.

3. **Create Database in MySQL**
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
   - Create a new database: `banking_db`.
   - Import the provided SQL file (`database.sql`) into `banking_db`.

4. **Configure Database Connection**
   - Open `includes/db_connect.php` and ensure the database credentials match your setup:
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db_name = "banking_db";
     ```

5. **Run the Project**
   - Open a browser and navigate to:
     ```
     http://localhost/banking-system/
     ```
   - You will be redirected to the **Dashboard**.

---

## **Directory Structure**
```
/banking-system
│── /assets
│   ├── /css (Custom CSS if needed)
│   ├── /js (Custom JavaScript if needed)
│   ├── /images (Stock images)
│── /includes
│   ├── db_connect.php (Database connection)
│   ├── header.php (Navbar and Bootstrap inclusion)
│   ├── footer.php (Footer)
│── /pages
│   ├── dashboard.php (Main dashboard)
│   ├── add_transaction.php (Add transaction form)
│   ├── transaction_history.php (Transaction list)
│── index.php (Redirects to dashboard)
│── config.php (Global configuration)
│── README.md (Project details)
```

---

## **Technology Stack**
This project leverages the following technologies:
- **PHP** (Backend Logic & Database Connectivity)
- **MySQL** (Database Management)
- **Bootstrap 5** (Frontend Framework for Styling & Responsiveness)
- **Chart.js** (Data Visualization)
- **FontAwesome** (Icons for better UI/UX)
- **JavaScript & AJAX** (For dynamic functionalities)

---

## **Planned Future Enhancements**
- **CSV & PDF Export for Transactions**.
- **Date Filters for Expense Reports** (Custom date range analysis).
- **Advanced Analytics Dashboard** (More financial metrics & graphs).
- **Monthly Budgeting Feature** (Set limits for each category).
- **Multi-User Authentication** (For shared financial tracking if needed).

---

## **Contributing**
This project is designed for **personal use**, but if you wish to improve it, feel free to fork the repository and submit pull requests.

---

## **License**
This project is open-source and licensed under the **MIT License**.

---

## **Contact & Support**
If you encounter any issues, feel free to reach out via GitHub issues or email at `raj.ahmed.pro2023@example.com`.

🚀 Happy Expense Tracking!

