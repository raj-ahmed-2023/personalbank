<?php
include "../includes/db_connect.php";
include "../includes/header.php";

$result = $conn->query("SELECT * FROM transactions ORDER BY transaction_date DESC");
?>

<div class="container mt-4">
    <h2>Transaction History</h2>
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
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td class="<?php
                        if($row['amount']<0){
                            echo "text-danger";
                        }
                        else{
                            echo "text-success";
                        }
                    
                    ?>">₹<?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo ucfirst($row['payment_method']); ?></td>
                    <td><?php ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="./dashboard.php" class="btn btn-primary">Go Back</a>
</div>

<?php include "../includes/footer.php"; ?>
