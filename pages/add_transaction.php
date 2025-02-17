<?php
include "../includes/db_connect.php";
include "../includes/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $payment_method = $_POST['payment_method'];
    
    $account_type = ($payment_method == "cash") ? "cash" : "bank";
    $conn->query("UPDATE accounts SET balance = balance + $amount WHERE type='$account_type'");
    
    $sql = "INSERT INTO transactions (amount, category, description, transaction_date, payment_method, account_id) 
            VALUES ('$amount', '$category', '$description', NOW(), '$payment_method', 
                   (SELECT id FROM accounts WHERE type='$account_type'))";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Transaction added successfully'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding transaction');</script>";
    }
}
?>

<div class="container mt-4">
    <h2>Add Transaction</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                <option value="cash">Cash</option>
                <option value="phonepe">PhonePe</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
