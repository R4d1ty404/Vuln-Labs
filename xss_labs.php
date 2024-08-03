<!DOCTYPE html>
<html>
    <head>
        <title>XSS LABS</title>
    </head>
    <body>
        <h1>Welcome to XSS Labs</h1>
        <p>Made By Raditya Perwira Putra</p>
        <h2>XSS Basic Example</h2>
        <p>1. Reflected XSS search bar in between HTML tags</p>
        <form method="POST">
            <input type="hidden" name="form_type" value="form1">
            <input type="text" placeholder="Search something..." name="Search_query">
            <input type="submit" value="Submit Search">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["form_type"] == "form1") {
            $search_query = $_POST["Search_query"];
            echo "<h3>Search Results for: " . $search_query . "</h3>";
        }
        ?>
        <p>2. Reflected XSS search bar in HTML tag attributes</p>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["form_type"] == "form2") {
            $search_query = $_POST["Search_query"];
        }
        ?>
        <form method="POST">
            <input type="hidden" name="form_type" value="form2">
            <input type="text" placeholder="Search something..." name="Search_query" value="<?php echo $search_query;?>">
            <input type="submit" value="Submit Search">
        </form>
    </body>
</html>