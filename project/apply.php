<?php
session_start();
$email = $_SESSION['email'];
require_once "config.php";

$sql5 = "SELECT user_id FROM `candidate` WHERE email = ?";
$stmt5 = $conn->prepare($sql5);
$stmt5->bind_param("s", $email);
$stmt5->execute();
$result5 = $stmt5->get_result();
if ($row5 = $result5->fetch_assoc()) {
    $candidate_id = $row5['user_id'];
} else {
    die("Error: No candidate found with the email " . htmlspecialchars($email));
}

$job_id = $_GET["job_id"];
$sql6 = "SELECT company_id FROM `jobs` WHERE job_id = ?";
$stmt6 = $conn->prepare($sql6);
$stmt6->bind_param("i", $job_id);
$stmt6->execute();
$result6 = $stmt6->get_result();
if ($row6 = $result6->fetch_assoc()) {
    $company_id = $row6['company_id'];
} else {
    die("Error: No job found with the job_id " . htmlspecialchars($job_id));
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["job_id"])) {
    $sql = "INSERT INTO `connection` (`company_id`, `user_id`, `job_id`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $company_id, $candidate_id, $job_id);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Application submitted successfully!');</script>";
        header("location: candidate_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
$stmt5->close();
$stmt6->close();
$conn->close();
?>
+