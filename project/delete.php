<?php
session_start();

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["job_id"]) && !empty($_POST["job_id"])) {
        $param_job_id = trim($_POST["job_id"]);

        mysqli_begin_transaction($conn);

        try {
            $sql = "DELETE FROM `connection` WHERE job_id = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $param_job_id);
                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Error deleting related rows in connection table: " . mysqli_error($conn));
                }
                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Error preparing statement for deleting related rows: " . mysqli_error($conn));
            }

            $sql = "DELETE FROM `jobs` WHERE job_id = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $param_job_id);
                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Error deleting row in jobs table: " . mysqli_error($conn));
                }
                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Error preparing statement for deleting row: " . mysqli_error($conn));
            }

            mysqli_commit($conn);
            header("location: company_dashboard.php");
            exit();
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "Oops! Something went wrong. Error: " . $e->getMessage();
        }

        // Close connection
        mysqli_close($conn);
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/11.png">
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .box {
            width: 400px;
            border-radius: 5px;
            margin: 0 auto;
            justify-content: center;
            text-align: center;
            transform: translate(0%, 35vh);
            border: 1px solid black;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
            background-color: #ebecec;
        }
        #sub {
            background-color: #e10707;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        #no {
            background-color: #77d372;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Delete Record</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="job_id" value="<?php echo isset($_GET["job_id"]) ? trim($_GET["job_id"]) : ''; ?>"/>
            <p>Are you sure you want to delete this record?</p><br/>
            <p>
                <input type="submit" id="sub" value="Yes">
                <a href="company_dashboard.php" id="no">No</a>
            </p>
        </form>
    </div>
</body>
</html>
