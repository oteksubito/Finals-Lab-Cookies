<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Confirmation</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<?php
$firstname = "";
$fnameError = "";
$lastname = "";
$lnameError = "";
$emailError = "";
$email = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate firstname
    if (empty($_POST["firstname"])) {
        $fnameError = "First Name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        // Check if contains only leeter and whitespaces
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $fnameError = "Only letters and white space allowed";
        }
    }

    // validate lastname
    if (empty($_POST["lastname"])) {
        $lnameError = "Last Name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        // Check if contains only letter and whitespaces
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lnameError = "Only letters and white space allowed";
        }
    }

    // validate email
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = 'must be a valid email address';
        }
    }
    



    // Check if there are no errors before proceeding
    if (empty($fnameError) && empty($lnameError)) {
    setcookie("firstName", $firstname, time() + (86400 * 30), "/");
    setcookie("lastName", $lastname, time() + (86400 * 30), "/");

        // Redirect to viewMore.php after validation
        header("Location: viewMore.php");
        exit();
    }
}

// Function to filter inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="container">
    <!--  viewMore.php as the background-->
    <div class="iframe-container" id="iframeBackground">
        <iframe src="viewMore.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
    </div>

    <!-- Login Form -->
    <div class="login-form" id="loginForm">
        <h2>Login Form</h2>
        <!-- Display User Image -->
        <img id="userImage" src="images/default.jpg" class="user-image" alt="Devs Image">

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" id="email" name="email" placeholder="Email" oninput="updateImage()"> 
            <span class="error">* <?php echo $emailError; ?></span><br>

            <input type="text" id="firstname" name="firstname" placeholder="First Name" oninput="updateImage()"> 
            <span class="error">* <?php echo $fnameError; ?></span><br>

            <input type="text" id="lastname" name="lastname" placeholder="Last Name" oninput="updateImage()" >
            <span class="error">* <?php echo $lnameError; ?></span><br>
            
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</div>

<script>
    //To update the image based on the inputs
    function updateImage() {
        let firstName = document.getElementById('firstname').value.toLowerCase().trim();
        let lastName = document.getElementById('lastname').value.toLowerCase().trim();

        const users = {
            'justine': {
                'oliva': 'tine.jpg'
            },
            'marwin': {
                'subito': 'marrwwwi.jfif'
            },
            'joseph': {
                'quizana': 'seph.jpg'
            },
            'ruzel': {
                'borromeo': 'ruzel.jpg'
            },
            'gabriel': {
                'escolano': 'gab.jpg'
            }
        };

    //     if (firstName in users && lastName in users[firstName]) {
    //     // Enable the login button if both names match
    //     document.getElementsByName('login')[0].disabled = false;
    // } else {
    //     // Disable the login button if the names don't match
    //     document.getElementsByName('login')[0].disabled = true;
    // }

        let userImage = document.getElementById('userImage');

        if (users[firstName] && users[firstName][lastName]) {
            userImage.src = 'images/' + users[firstName][lastName];
        } else {
            userImage.src = 'images/default.jpg';
        }
    }

    // handle the navigation to the next form
    function navigateToForm(event) {
        event.preventDefault(); // Prevent form submission

        // Remove blur effect from the iframe
        let iframeBackground = document.getElementById('iframeBackground');
        iframeBackground.classList.add('iframe-clear');

        // Fade out the login form
        let loginForm = document.getElementById('loginForm');
        loginForm.style.opacity = '0';
        loginForm.style.transform = 'scale(0.8)'; // 

        // After transition, redirect to viewMore.php
        setTimeout(() => {
            // Redirect to viewMore.php 
            window.location.href = 'viewMore.php';
        }, 500); //
    }
</script>

</body>
</html>
