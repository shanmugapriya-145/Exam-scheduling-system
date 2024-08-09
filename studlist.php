<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Admin</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="admin.css"> 
	<link rel="stylesheet" href="responsive.css"> 
</head> 
<style>

@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"); 

* {
    margin: 0;
    padding: 10;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

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
    background-color: var(--background-color4);
    max-width: 100%;
    overflow-x: hidden;
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
    cursor: pointer;
}

.logosec {
    display: flex;
    align-items: center;
    justify-content: center;
}



.logosec {
    gap: 60px;
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
    background-color: #884483;
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
    background-image: linear-gradient(to bottom, rgba(78, 0, 85, 0.308), rgb(50, 0, 25));
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


.rectangle-box , .rectangl-box{
  background-color: #ffffff;
  border: 2px solid #884483;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  margin: 40px; 
}

.table-container h2 {
    margin-bottom: 30px; 
    color: #884483; 
}

.custom-table thead th {
    background-color: #884483; 
    color: #fff;
    border: 2px solid #884483; 
}

.custom-table tbody td {
    border: 2px solid #884483; 
    background-color: white; 
    color: #884483;
}


.table-container form {
            margin: 20px 0; 
            padding: 20px; 
        }
      
.logo {
    font-size: 20px; 
}

.table-container h2 ,.nav-option h3 {
    font-size: 18px; 
}

.form-label,.nav-option h3 {
    font-size: 18px; /
}

header {
    padding-bottom: 20px; 
}

.table-container {
    padding: 20px;
    margin-bottom: 20px;
}

.table-container {

    overflow-x: auto;
}

.table-responsive {
    overflow-x: auto;
    max-width: 100%;
    overflow-y: hidden;
    margin-bottom: 20px; 
}

.custom-table {
    min-width: 100%;
}
a {
    color: inherit;
    text-decoration: none;
}


a:hover {
    color: #884483; 
    text-decoration: none;
}
.btn-sm{
    background-color: #884483;
    box-shadow:#884483;
    border: 2px solid #884483;
}
.btn{
    box-shadow:#884483;
    background-color: #884483;
    border: 2px solid #884483;
}


   </style> 

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
        <div class="table-container">
            <h2>List of Students</h2>
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Register Number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "websitelogin";
                    $connection = new mysqli($servername, $username, $password, $database);
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    if(isset($_POST['submit'])) {
                        $Register_number = $_POST['Register_number'];
                        $Name = $_POST['Name'];
                        $Gender = $_POST['Gender'];
                        $Type = $_POST['Type'];

                        $sql = "INSERT INTO students (Register_number, Name, Gender, Type) VALUES ('$Register_number', '$Name', '$Gender', '$Type')";
                        if ($connection->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $connection->error;
                        }
                    }
                    $sql_students = "SELECT * FROM students";
                    $result_students = $connection->query($sql_students);

                    if(!$result_students){
                        die("Invalid query". $connection->connect_error);
                    }
                    while($row = $result_students->fetch_assoc()){
                        echo "<tr>
                            <td>" . $row["Register_number"] . "</td>
                            <td>" . $row["Name"] . "</td>
                            <td>" . $row["Gender"] . "</td>
                            <td>" . $row["Type"] . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='update.php?id=" . $row['Register_number'] . "'>Update</a>
                                <a class='btn btn-primary btn-sm' href='delete.php?id=" . $row['Register_number'] . "'>Delete</a>
                            </td>
                        </tr>";
                    }
                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <h2>Gender Counts</h2>
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $connection = new mysqli($servername, $username, $password, $database);
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    $sql_male = "SELECT COUNT(*) as male_count FROM students WHERE Gender = 'MALE'";
                    $result_male = $connection->query($sql_male);
                    $row_male = $result_male->fetch_assoc();
                    $male_count = $row_male['male_count'];

                    $sql_female = "SELECT COUNT(*) as female_count FROM students WHERE Gender = 'FEMALE'";
                    $result_female = $connection->query($sql_female);
                    $row_female = $result_female->fetch_assoc();
                    $female_count = $row_female['female_count'];
                    echo "<tr><td>Male</td><td>$male_count</td></tr>";
                    echo "<tr><td>Female</td><td>$female_count</td></tr>";
                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <h2>Type Counts</h2>
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $connection = new mysqli($servername, $username, $password, $database);
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    $sql_hostler = "SELECT COUNT(*) as hostler_count FROM students WHERE Type = 'Hosteller'";
                    $result_hostler = $connection->query($sql_hostler);
                    $row_hostler = $result_hostler->fetch_assoc();
                    $hostler_count = $row_hostler['hostler_count'];

                    $sql_dayscholar = "SELECT COUNT(*) as dayscholar_count FROM students WHERE Type = 'Day Scholar'";
                    $result_dayscholar = $connection->query($sql_dayscholar);
                    $row_dayscholar = $result_dayscholar->fetch_assoc();
                    $dayscholar_count = $row_dayscholar['dayscholar_count'];
                    echo "<tr><td>Hostler</td><td>$hostler_count</td></tr>";
                    echo "<tr><td>Dayscholar</td><td>$dayscholar_count</td></tr>";
                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
                <div class="table-container">
            <h2>Add New Student</h2>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="Register_number" class="form-label">Register Number:</label>
                    <input type="text" class="form-control" id="Register_number" name="Register_number">
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="Name" name="Name">
                </div>
                <div class="mb-3">
                    <label for="Gender" class="form-label">Gender:</label>
                    <input type="text" class="form-control" id="Gender" name="Gender">
                </div>
                <div class="mb-3">
                    <label for="Type" class="form-label">Type:</label>
                    <input type="text" class="form-control" id="Type" name="Type">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
                </div>

</div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    let menuIcon = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");
  
    menuIcon.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
  
    document.addEventListener("click", (event) => {
        const isNavContainer = event.target.closest(".navcontainer");
        const isMenuIcon = event.target.closest(".menuicn");
  
        if (!isNavContainer && !isMenuIcon) {
            nav.classList.add("navclose");
        }
    });
});
</script> 
</body> 
</html>        