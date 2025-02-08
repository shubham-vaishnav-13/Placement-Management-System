<?php
session_start();
if (isset($_SESSION['cemail'])) {
    $email = $_SESSION['cemail'];
    if (isset($_SESSION['cid'])) {
        $cid = $_SESSION['cid'];
    } else {
        $cid = -1;
    }
} else {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "auxilio");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap");
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body,
        input,
        button {
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
        }

        body {
            color: var(--text-color);
        }

        input,
        button {
            border: none;
            outline: none.
        }

        ul {
            list-style: none.
        }

        a {
            text-decoration: none.
        }

        img {
            display: block;
            max-width: 100%;
            height: auto.
        }
    </style>
    <link rel="icon" type="image/png" href="images/11.png">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <title>Company Dashboard</title>
</head>
<body style="padding: 0">
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="#"><img src="logo2.png" alt="Logo" style="width:155px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#" style="color: white;">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php" name="logout" style="color: white;">Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="main container">
    <div class="left" style="width: 30%; float: left; padding-top: 15px;">
        <?php include('com_form.html'); ?>
        <div class="display" style="border-radius:6px; padding: 20px; background-color:#fff">
            <table class="pure-table pure-table-horizontal">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" style="text-align: center;">Job Posts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM `jobs` WHERE company_id = '$cid'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                                <td>". $row['job_post'] . "</td>
                               
                                <td><a href='delete.php?job_id=".$row['job_id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>
                              </tr>";
                            
                              
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="right" style="width: 65%; float: right; padding-top: 35px;">
        <div class="container my-4">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Candidate Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 100px;">Post</th>
                        <th scope="col">Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    $sql = "SELECT c.fname, c.lname, c.email, j.job_post, j.salary 
                            FROM `connection` cn 
                            JOIN `candidate` c ON cn.user_id = c.user_id 
                            JOIN `jobs` j ON cn.job_id = j.job_id 
                            WHERE cn.company_id = '$cid' AND j.company_id = '$cid'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>
                                <th scope='row'>" . $count . "</th>
                                <td>" . $row['fname'] . " " . $row['lname'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['job_post'] . "</td>
                                <td>" . $row['salary'] . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>
