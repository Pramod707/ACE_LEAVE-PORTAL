<?php
include('../inc/topbar.php');
if(empty($_SESSION['admin-username'])) {
    header("Location: login.php");
}

$id = $_GET['id'];

try {
    // Start transaction
    $dbh->beginTransaction();

    // Update leave status to Approved
    $sql = "UPDATE tblleave SET status='Approved' WHERE leaveID=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    // Commit transaction
    $dbh->commit();

    // Redirect to leave record page
    header("Location: leave_record.php");
} catch (Exception $e) {
    // Rollback transaction if an error occurs
    $dbh->rollBack();
    echo "Failed to approve leave: " . $e->getMessage();
}
?>
