<?php
$conn = mysqli_connect("localhost", "root", "");
if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usersql = "SELECT * FROM websitelogin.userlogin WHERE username='$username'";
    $studentsql = "SELECT * FROM websitelogin.studentlogin WHERE username='$username'";
    $userresult = mysqli_query($conn, $usersql);
    $studentresult = mysqli_query($conn, $studentsql);
    while ($row = mysqli_fetch_assoc($userresult)) {
        $userpassword = $row['password'];
        if ($password == $userpassword) {
            header('Location:admin.html');
            exit(); 
        }
    }
    while ($row = mysqli_fetch_assoc($studentresult)) {
        $studentpassword = $row['password'];

        if ($password == $studentpassword) {
           header('Location:user.html');
            exit(); 
        }
    }
    echo "<script>
            alert('Login unsuccessful');
            window.location.href = 'login.html';
          </script>";
    exit(); 
}
?>
