<?php
$usererr = $emailerr = $websiterr = $phoneerr = "";
$user = $email = $phone = $website = $msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["user"])) {
        $usererr = "Name is required";
    } else {
        $user = test_input($_POST["user"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $user)) {
            $usererr = "Only letters and white space allowed";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailerr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Invalid email format";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneerr = "Phone no is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^\+?[0-9]{10,15}$/", $phone)) {
            $phoneerr = "Invalid phone number format. Please enter a valid number.";
        }
    }

    // Validate website (optional)
    if (!empty($_POST["website"])) {
        $website = test_input($_POST["website"]);
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $websiterr = "Invalid URL";
        }
    }

    // Validate message (optional)
    if (!empty($_POST["msg"])) {
        $msg = test_input($_POST["msg"]);
    }

    // Process the data if no errors
    if (empty($usererr) && empty($emailerr) && empty($websiterr) && empty($phoneerr)) {
        echo "Thank you, $user! Your message has been received.";
    } else {
        echo "Please correct the errors and try again.";
        echo "<br>User Error: $usererr";
        echo "<br>Email Error: $emailerr";
        echo "<br>Phone Error: $phoneerr";
        echo "<br>Website Error: $websiterr";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>