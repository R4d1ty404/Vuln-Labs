<!DOCTYPE html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sqlvuln";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["register"] == "register") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["login"] == "login") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($auth);

    if ($result->num_rows > 0) {
        echo "Login successful! Welcome, " . $username;
    } else {
        echo "Invalid username or password!";
    }
}

$conn->close();
?>


<html>
    <head>
        <title>SQLi LABS</title>
    </head>
    <body>
        <h1>Welcome to SQLi Labs</h1>
        <p>Made By Raditya Perwira Putra</p>
        <a href="index.php">GO BACK TO HOME</a>

        <h2>Register</h2>
        <form method="POST">
            <input type="hidden" name="register" value="register">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Submit Register">
        </form>

        <h2>Login</h2>
        <form method="POST">
            <input type="hidden" name="login" value="login">
            <label>Username:</label><br>
            <input type="text" name="username"><br><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Login Now">
        </form>

        <h2>Search data</h2>
        <form method='POST'>
            <input type='hidden' name='form_search' value='search1'>
            <input type='text' name='search_query' placeholder='Search name...'>
            <input type='submit' value='Search Now'><br><br>
        </form>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sqlvuln";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["form_search"] == "search1") {
            $search_query = $_POST['search_query'];
        
            $sql = "SELECT * FROM EMPLOYEE WHERE name='$search_query'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Nama</th><th>Division</th></tr>";
            
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['division'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        } else {
            $table_department = "SELECT * FROM EMPLOYEE";
            $result = $conn->query($table_department);
            
    
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Nama</th><th>Division</th></tr>";
            
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['division'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        }

        $conn->close();
        ?>
    </body>
</html>
