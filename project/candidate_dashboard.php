<?php
    $conn = mysqli_connect("localhost", "root", "", "auxilio");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start();
    
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        
    } else {
        header("Location: login.php");
        exit();
    }

    $user_query = "SELECT user_id FROM candidate WHERE email = '$email'";
    $user_result = mysqli_query($conn, $user_query);
    if (!$user_result) {
        die("Error fetching user: " . mysqli_error($conn));
    }
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row['user_id'];
   
    $search = '';
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="images/11.png">
<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $conn = mysqli_connect("localhost", "root", "", "auxilio");
    ?>
    <style>
        /*=============== GOOGLE FONTS ===============*/
        @import url("https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap");
        ::-webkit-scrollbar{
            display: none;
        }
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
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
        }

        body {
            color: #3c4043;
        }

        input,
        button {
            border: none;
            outline: none;
        }

        ul {
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
            width:50px;
            height:50px;
        }

        .container-card {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            background-color: #ffffff;
            border-radius: 1.2rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.5s ease-in-out;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            margin-bottom: 1rem;
            width: 100%;
        }

        .container-card:hover {
            transform: scale(1.05);
            box-shadow: 0 1.5rem 2rem rgba(0, 0, 0, 0.2);
        }

        .header1 {
            display: flex;
            align-items: center;
            padding: 1.7rem;
            padding-bottom: 1rem;
            background-color: #4e9ba7;
            color: white;
            transition: opacity 0.3s ease;
            z-index: 1;
            width: 100%;
        }

        .container-card:hover .header1,
        .container-card:hover .info-section {
            opacity: 0;
        }

        .logo img {
            width: 7.5rem;
            height: 7.5rem;
            margin-right: 1.25rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid white;
        }

        .post-info {
            display: flex;
            flex-direction: column;
        }

        .title {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .name {
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }

        .info-section {
            padding: 1rem 2rem;
            color: #3c4043;
            flex: 1;
            transition: opacity 0.3s ease;
            z-index: 1;
            width: 100%;
        }

        .fa-map-marker-alt, .fa-money-bill-wave, .fa-briefcase {
            margin-right: 0.5rem;
        }

        .apply-con {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            color: #fff;
            border: none;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            opacity: 0;
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 2;
            width: 90%;
        }

        .apply-btn {
            align-self: center;
            display: inline-block;
            background-color: #478e9a;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .apply-btn:hover {
            background-color: #3a7f8b;
        }

        .container-card:hover .apply-con {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .container-card:hover::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #4e9ba7;
            z-index: 0;
            transition: height 0.5s ease;
            height: 100%;
        }

        .container-card:hover .header1,
        .container-card:hover .info-section {
            z-index: 1;
        }
    </style>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    
    <title>Candidate Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="#"><img src="logo2.png" alt="Logo" style="width:155px "> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="color: white;">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" href="logout.php" name="logout" style="color: white;" >Logout</a>
                </li>
               
            </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="space" style="width: 100%;height:70px"></div>
    
    <div class="container my-5">
        <div class="row">
        <?php
                        $sql = "SELECT j.*, c.company_name, c.logo
                        FROM jobs j
                        LEFT JOIN connection a ON j.job_id = a.job_id AND a.user_id = '$user_id'
                        JOIN company c ON j.company_id = c.company_id
                        WHERE (j.job_post LIKE '%$search%' OR j.location LIKE '%$search%' OR c.company_name LIKE '%$search%') 
                        AND a.job_id IS NULL";
                $result = mysqli_query($conn, $sql);
    
                if (!$result) {
                    die("Error fetching jobs: " . mysqli_error($conn) . "\nSQL: " . $sql);
                }
    
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-lg-6 mb-4'>
                            <div class='container-card'>
                                <div class='header1'>
                                    <div class='logo'>
                                        <img src='{$row['logo']}'>
                                    </div>
                                    <div class='post-info'>
                                        <div class='title'>" . $row['job_post'] . "</div>
                                        <div class='name'>" . $row['company_name'] . "</div>
                                    </div>
                                </div>
                                <div class='info-section'>
                                    <div><i class='fas fa-briefcase'></i> Experience: " . $row['experience_required'] . "</div>
                                    <div><i class='fas fa-money-bill-wave'></i> Salary: ₹" . $row['salary'] . "</div>
                                    <div><i class='fas fa-map-marker-alt'></i> Location: " . $row['location'] . "</div>
                                </div>
                                <div class='apply-con'>
                                    <p>" . $row['job_description'] . "</p>
                                    <a href='apply.php?job_id=" . $row['job_id'] . "'><button type='button' class='apply-btn'>Apply</button></a>
                                </div>
                            </div>
                        </div>";
                }
                ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
