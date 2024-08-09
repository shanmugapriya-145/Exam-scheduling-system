<!DOCTYPE html>
<html>
<head>
    <title>Display and Add Data to MySQL</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="admin.css"> 
    <link rel="stylesheet" href="responsive.css"> 
    <style>
        :root {
            --background-color1: #884483;
            --background-color2: #f5e1ee;
            --background-color3: #f5e1ee;
            --background-color4: #f5e1ee;
            --primary-color: #884483;
            --secondary-color: #884483;
            --Border-color: #884483;
            --one-use-color: #884483;
            --two-use-color: #884483;
}
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: var(--background-color4); 
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin-bottom: 20px;
        }

        table {
            background-color: white;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #884483;
            color:white;
        }

        button {
            padding: 5px 10px;
            background-color: #884483;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
        }

        button:hover {
            background-color: #a834a1;
        }

        form {
            margin-bottom: 20px;
            align-items: center;
            justify-content: center;
        }

        input[type=text] {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            margin-bottom: 10px; 
            width: 100%; 
        }

        input[type=submit] {
            padding: 5px 10px;
            background-color: #884483;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 200px; 
            align-items: center;
        }

        input[type=submit]:hover {
            background-color: #a834a1;
            
        }
        .add-form-container {
            margin-top: 20px;
            margin-left: 600px;
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #d2a0c1;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            align-items: center;
            justify-content: center;
        }
        .add-form {
            margin-top: 20px;
            margin:0 auto;
            width:100%;
            max-width: 400px; 
            padding: 20px;
            background-color:#d2a0c1 ;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .add-form h2 {
            text-align: center; 
            margin-bottom: 20px;
        }

        .add-form label {
            display: block; 
            margin-bottom: 10px; 
            font-weight: bold;
        }

        .add-form input[type="text"] {
            width: calc(100% - 20px); 
            padding: 10px; 
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-form input[type="submit"] {
            width: 100%; 
            padding: 10px; 
            border: none;
            background-color: #884483; 
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; 
        }

        .add-form input[type="submit"]:hover {
            background-color: #a834a1; 
        }
        .navclose { 
width: 70px; 
} 
    </style>
</head>
<body>
<header> 
    <div class="logosec"> 
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png" class="icn menuicn" id="menuicn" alt="menu-icon"> 
        <div class="logo">Exam Schedule</div> 
    </div> 
    <div class="dp"> 
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"> 
    </div> 
</header>
<div class="main-container"> 
    <div class="navcontainer"> 
        <nav class="nav">
        <div class="nav-upper-options">  
                    <a href="./admin.html" class="nav-option"> 
						<img src="assets/dashboard.png" class="nav-img" alt="dashboard"> 
						<h3> Dashboard</h3> 
                    </a> 
					<a href="./studlist.php" class="nav-option"> 
						<img src="assets/studentlist2.png" class="nav-img" alt="institution"> 
						<h3> Student List</h3> 
					</a>
					<a href="./reg.php" class="nav-option"> 
						<img src="assets/subjects.png" class="nav-img" alt="blog"> 
						<h3>Regulation</h3> 
					</a> 
					<a href="trial3_display.php" class="nav-option"> 
						<img src="assets/batchDetails.png" class="nav-img" alt="settings"> 
						<h3>Batch Detail</h3> 
					</a> 
					<a href="login.html" class="nav-option"> 
						<img src="assets/logout.png" class="nav-img" alt="institution"> 
						<h3>Logout</h3> 
                    </a> 
        </div>     
        </nav> 
    </div> 
<div class="container">
<h2>Subjects-Labs Data</h2>

<table id="table-container">
    <tr>
        <th>Semester</th>
        <th>Code</th>
        <th>Lab</th>
        <th>Actions</th>
    </tr>
    <?php
 
    $servername = "localhost"; 
    $username = "root";
    $password = ""; 
    $database = "websitelogin"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the table
    $sql = "SELECT * FROM cse";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["lab"] . "</td>";
            echo "<td><button onclick='deleteRecord(" . $row["id"] . ")'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
    }
    ?>
    <br>
</table>
</div>
<br>
</div>
<center>
<h2>Add Lab</h2>
</center>
<div class="add-form-container">
<form id="add-form" method="post" action="">
    <label for="semester">Semester:</label>
    <input type="text" id="semester" name="semester"><br>
    <label for="code">Code:</label>
    <input type="text" id="code" name="code"><br>
    <label for="lab">Lab:</label>
    <input type="text" id="lab" name="lab"><br>
    <center>
    <input type="submit" name="submit" value="Submit">
    </center>
</form>
</div>
<br>

<br>
<?php
if (isset($_POST['submit'])) {
    $semester = $_POST['semester'];
    $code = $_POST['code'];
    $lab = $_POST['lab'];
    // Insert data into the table
    $insert_sql = "INSERT INTO cse (semester, code, lab) VALUES ('$semester', '$code', '$lab')";
    if ($conn->query($insert_sql) !== TRUE) {
        echo "<p>Error: " . $insert_sql . "<br>" . $conn->error . "</p>";
       
    }
}
$conn->close();
?>
<script>
    function deleteRecord(id) {
        $.ajax({
            url: "reg_delete.php",
            type: "GET",
            data: { id: id },
            success: function(response) {
                alert(response); 
                updateTable(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function updateTable() {
        var tableContainer = $("#table-container");
        tableContainer.empty();

        $.ajax({
            url: "reg.php", 
            type: "GET",
            success: function(response) {
                tableContainer.html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        location.reload(true); 
    }
    function goBack() {
        window.location.href="admin.html";
    }
</script>
<script src="./admins.js"></script>
</body>
</html>
