<?php
include "../includes/db_connect.php";
include "../includes/header.php";

// Fetch balances
$cash_balance = $conn->query("SELECT balance FROM accounts WHERE type='cash'")->fetch_assoc()['balance'] ?? 0;
$bank_balance = $conn->query("SELECT balance FROM accounts WHERE type='bank'")->fetch_assoc()['balance'] ?? 0;

// Fetch total income & expense
$total_income = $conn->query("SELECT SUM(amount) AS total FROM transactions WHERE amount > 0")->fetch_assoc()['total'] ?? 0;
$total_expense = $conn->query("SELECT SUM(amount) AS total FROM transactions WHERE amount < 0")->fetch_assoc()['total'] ?? 0;

// Fetch recent transactions
$recent_transactions = $conn->query("SELECT * FROM transactions ORDER BY transaction_date DESC LIMIT 5");

// Fetch expense breakdown by category
$category_expenses = $conn->query("SELECT category, SUM(amount) AS total FROM transactions WHERE amount < 0 GROUP BY category ORDER BY total ASC");
?>

<div class="container mt-4">
    <h2 class="text-center">Dashboard</h2>

    <!-- Row for Balances -->
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cash Balance</h5>
                    <p class="card-text fs-3">₹<?php echo number_format($cash_balance, 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Bank Balance</h5>
                    <p class="card-text fs-3">₹<?php echo number_format($bank_balance, 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-text fs-3 text-success">+ ₹<?php echo number_format($total_income, 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Expense</h5>
                    <p class="card-text fs-3 text-danger">- ₹<?php echo number_format(abs($total_expense), 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Recent Transactions</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $recent_transactions->fetch_assoc()) { ?>
                        <tr>
                            <td class="<?php echo ($row['amount'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                ₹<?php echo number_format($row['amount'], 2); ?>
                            </td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['transaction_date']; ?></td>
                            <td><?php echo ucfirst($row['payment_method']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="transaction_history.php" class="btn btn-primary">View All Transactions</a>
        </div>
    </div>

    <!-- Expense Breakdown -->
    <div class="card mb-5">
        <div class="card-header">
            <h4>Expense Breakdown</h4>
        </div>
        <div class="card-body">
            <canvas id="expenseChart"></canvas>
        </div>
    </div>

    <!-- Buttons for Actions -->
    <div class="d-flex justify-content-center">
        <a href="add_transaction.php" class="btn btn-success me-2">Add Transaction</a>
        <a href="transaction_history.php" class="btn btn-warning">View Transactions</a>
    </div>
</div>

<!-- Chart.js for Expense Breakdown -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('expenseChart').getContext('2d');
    var expenseChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [<?php while ($row = $category_expenses->fetch_assoc()) { echo '"' . $row['category'] . '",'; } ?>],
            datasets: [{
                label: 'Expenses',
                data: [<?php 
                    $category_expenses->data_seek(0);
                    while ($row = $category_expenses->fetch_assoc()) { echo abs($row['total']) . ','; } 
                ?>],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
            }]
        }
    });
});
</script>

<?php include "../includes/footer.php"; ?>
