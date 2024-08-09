<!DOCTYPE html>
<html>
    <head>
        <title>XSS LABS</title>
    </head>
    <body>
        <h1>Welcome to XSS Labs</h1>
        <p>Made By Raditya Perwira Putra</p>
        <a href="index.php">GO BACK TO HOME</a>
        <h2>XSS Basic Example</h2>

        <h4>1. Reflected XSS search bar in between HTML tags</h4>
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

        <h4>2. Reflected XSS search bar in HTML tag attributes</h4>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["form_type"] == "form2") {
            $search_query2 = $_POST["Search_query"];
        }
        ?>
        <form method="POST">
            <input type="hidden" name="form_type" value="form2">
            <input type="text" placeholder="Search something..." name="Search_query" value="<?php echo $search_query2;?>">
            <input type="submit" value="Submit Search">
        </form>

        <h4>3. Stored XSS in comment </h4>
        <form method="POST">
            <input type="hidden" name="comment_form" value="comment1">
            <p>Want to write something? enter your comment here!</p>
            <input type="text" placeholder="Your username..." name="username">
            <br><br>
            <textarea placeholder="Write something..." name="comments"></textarea>
            <br><br>
            <input type="submit" value="Submit Comment">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['comment_form'] == 'comment1') {
                $username = $_POST['username'];
                $comment = $_POST['comments'];
                $comment_data = [
                    'comment' => $comment,
                    'username' => $username
                ];
                $file_name = "comments.json";
                if (file_exists($file_name)) {
                    $existing_data = json_decode(file_get_contents($file_name), true);
                    if (!is_array($existing_data)) {
                        $existing_data = [];
                    }
                } else {
                    $existing_data = [];
                }
                $existing_data[] = $comment_data;
                $json_encode = json_encode($existing_data, JSON_PRETTY_PRINT);
                $result = file_put_contents($file_name, $json_encode);
            }
        ?>
        <h4>Comments</h4>
        <?php
        $file_name = 'comments.json';

        if (file_exists($file_name)) {
            $comments = json_decode(file_get_contents($file_name), true);

            if (is_array($comments) && !empty($comments)) {
                foreach ($comments as $comment) {
                    echo '<div>';
                    echo '<p>Username: ' . $comment['username'] . '</p>';
                    echo '<p>Comment: ' . $comment['comment'] . '</p>';                    
                    echo '</div><hr>';
                }
            } else {
                echo '<p>No comments yet.</p>';
            }
        } else {
            echo '<p>No comments file found.</p>';
        }
        ?>
    </body>
</html>
