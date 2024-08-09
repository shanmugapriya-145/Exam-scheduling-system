<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "websitelogin";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $type = $_POST['type'];
    $id = mysqli_real_escape_string($connection, $id);
    $name = mysqli_real_escape_string($connection, $name);
    $gender = mysqli_real_escape_string($connection, $gender);
    $type = mysqli_real_escape_string($connection, $type);
    $sql_update = "UPDATE students SET Name='$name', Gender='$gender', Type='$type' WHERE Register_number='$id'";

    if ($connection->query($sql_update) === TRUE) {
        $updateStatus = "Record updated successfully";
        header("Location: studlist.php");
        exit(); 
    } else {
        $updateStatus = "Error updating record: " . $connection->error;
    }
}

// Fetch the existing student details for pre-filling the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM students WHERE Register_number = '$id'";
    $result_select = $connection->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
    } else {
        echo "Student not found";
    }
}

// Close the connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; 
        }

        .container {
            background-color: #ffffff; 
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-container {
            margin-top: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff; 
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; 
            border-color: #0056b3;
        }
        @import url( 
"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"); 

* { 
margin: 0; 
padding: 0; 
box-sizing: border-box; 
font-family: "Poppins", sans-serif; 
} 
:root { 
--background-color1: #884483; 
--background-color2:#f5e1ee; 
--background-color3:#f5e1ee; 
--background-color4:#f5e1ee; 
--primary-color:#884483; 
--secondary-color: #884483; 
--Border-color:#884483; 
--one-use-color: #884483; 
--two-use-color: #884483; 
} 
body { 
background-color: var(--background-color4); 
max-width: 100%; 
overflow-x: hidden; 
} 

a.box2:active , a.box1:active {
    color: inherit; 
    text-decoration: none;
}
a.box2 , a.box1{
    text-decoration: none; 
}

a.box2:hover, a.box1:hover{
    text-decoration: none; 
}

a.box2:active , a.box1:active {
    text-decoration: none; 
}




header { 
height: 70px; 
width: 100vw; 
padding: 0 30px; 
background-color: var(--background-color1); 
position: fixed; 
z-index: 100; 
box-shadow: 1px 1px 15px rgba(231, 161, 253, 0.089); 
display: flex; 
justify-content: space-between; 
align-items: center; 
} 

.logo { 
font-size: 27px; 
font-weight: 900; 
color: rgb(255, 255, 255); 
} 

.icn { 
height: 30px; 
} 
.menuicn { 
cursor: center; 
} 

.searchbar, 
.message, 
.logosec { 
display: flex; 
align-items: center; 
justify-content: center; 
} 

.searchbar2 { 
display: none; 
} 

.logosec { 
gap: 60px; 
} 

.searchbar input { 
width: 250px; 
height: 42px; 
border-radius: 50px 0 0 50px; 
background-color: var(--background-color3); 
padding: 0 20px; 
font-size: 15px; 
outline: none; 
border: none; 
} 
.searchbtn { 
width: 50px; 
height: 42px; 
display: flex; 
align-items: center; 
justify-content: center; 
border-radius: 0px 50px 50px 0px; 
background-color: var(--secondary-color); 
cursor: pointer; 
} 

.message { 
gap: 40px; 
position: relative; 
cursor: pointer; 
} 
.circle { 
height: 7px; 
width: 7px; 
position: absolute; 
background-color: #fa7bb49a; 
border-radius: 50%; 
left: 19px; 
top: 8px; 
} 
.dp { 
height: 40px; 
width: 40px; 
background-color:#884483; 
border-radius: 50%; 
display: flex; 
align-items: center; 
justify-content: center; 
overflow: hidden; 
} 
.main-container { 
display: flex; 
width: 100vw; 
position: relative; 
top: 70px; 
z-index: 1; 
} 
.dpicn { 
height: 42px; 
} 

.main { 
height: calc(100vh - 70px); 
width: 100%; 
overflow-y: scroll; 
overflow-x: hidden; 
padding: 40px 30px 30px 30px; 
} 

.main::-webkit-scrollbar-thumb { 
background-image: 
		linear-gradient(to bottom, rgba(78, 0, 85, 0.308), rgb(50, 0, 25)); 
} 
.main::-webkit-scrollbar { 
width: 5px; 
} 
.main::-webkit-scrollbar-track { 
background-color: #9e9e9eb2; 
} 

.box-container { 
display: flex; 
justify-content: space-evenly; 
align-items: center; 
flex-wrap: wrap; 
gap: 20px; 
} 
.nav { 
min-height: 91vh; 
width: 250px; 
background-color: var(--background-color2); 
position: absolute; 
top: 0px; 
left: 00; 
box-shadow: 1px 1px 10px rgba(189, 248, 189, 0.825); 
display: flex; 
flex-direction: column; 
justify-content: space-between; 
overflow: hidden; 
padding: 20px 0 50px 10px; 
} 
.navcontainer { 
height: calc(100vh - 70px); 
width: 250px; 
position: relative; 
overflow-y: scroll; 
overflow-x: hidden; 
transition: all 0.5s ease-in-out; 
} 
.navcontainer::-webkit-scrollbar { 
display: none; 
} 
.navclose { 
width: 80px; 
} 
.container{
background-color: #d9abd2; 
}
.nav-option { 
width: 250px; 
height: 60px; 
display: flex; 
align-items: center; 
padding: 0 30px 0 20px; 
gap: 20px; 
transition: all 0.1s ease-in-out; 
} 
.nav-option:hover { 
border-left: 5px solid #f5e1ee; 
background-color:#f5e1ee; 
cursor: pointer; 
} 
.nav-img { 
height: 30px; 
} 
.logosec{
    cursor: pointer;
}

.nav-upper-options { 
display: flex; 
flex-direction: column; 
align-items: center; 
gap: 30px; 
} 

.option1 { 
border-left: 5px solid #00580caf; 
background-color: var(--Border-color); 
color: rgb(255, 255, 255); 
cursor: pointer; 
} 
.option1:hover { 
border-left: 5px solid #884483; 
background-color: var(--Border-color); 
} 
.form-label,.nav-option h3 {
    font-size: 18px; 
}
    </style>
    <script src="script.js"></script>
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
					<div class="nav-option option1"> 
						<img src="assets/dashboard.png" class="nav-img" alt="dashboard"> 
						<h3> Dashboard</h3> 
					</div> 
					<a href="./studlist.php" class="option2 nav-option"> 
						<img src="assets/studentlist2.png" class="nav-img" alt="institution"> 
						<h3> Student List</h3> 
					</a>
					<div class="nav-option option5"> 
						<img src="assets/subjects.png" class="nav-img" alt="blog"> 
						<h3>Subjects</h3> 
					</div> 
					<div class="nav-option option6"> 
						<img src="assets/settings.png" class="nav-img" alt="settings"> 
						<h3> Settings</h3> 
					</div> 
					<div class="nav-option logout"> 
						<img src="assets/logout.png" class="nav-img" alt="logout"> 
						<h3>Logout</h3> 
					</div> 
				</div> 
			</nav> 
		</div> 
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Update Student Details</h2>
            <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
        </div>
        <div class="form-container">
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?php echo $row['Register_number']; ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['Name']; ?>">
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $row['Gender']; ?>">
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type:</label>
                    <input type="text" class="form-control" id="type" name="type" value="<?php echo $row['Type']; ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    let menuicn = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");

    menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });

    document.addEventListener("click", (event) => {
        const isNavcontainer = event.target.closest(".navcontainer");
        const isMenuicn = event.target.closest(".menuicn");

        if (!isNavcontainer && !isMenuicn) {
            nav.classList.add("navclose");
        }
    });
});
        </script>
</body>

</html>
