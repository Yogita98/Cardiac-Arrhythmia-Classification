<?php
/*
if (isset($_POST['someAction'])) {
        header("location: /login_with_google_using_php/index.php");
        exit;  

    //update action
}
else{
*/// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: firstpage.php");
  exit;
}
 
// Include config file
require_once "config.php";
global $link;


 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users2 WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
             // Set parameters
            $param_username = $username;
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
           
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                             //Password is correct, so start a new session
                            session_start();
                            
                            //Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                           
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: Doctor_Upload.php");
                        } else{
                          //  // Display an error message if password is not valid
                            $password_err = "The password you entered is incorrect.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
         // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}
}


// $cookie_name = "User";
// $cookie_value = $username;
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

// if(!isset($_COOKIE[$cookie_name])) {
//      echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
//      echo "Cookie '" . $cookie_name . "' is set!<br>";
//      echo "Value is: " . $_COOKIE[$cookie_name];
// }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardiac_Arrhythmia</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aguafina+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiko">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Andada">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arapey">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arima+Madurai">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/css/Article-Dual-Column.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean-1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-image:url(&quot;assets/img/Pat_log.jpg&quot;);background-size:cover;background-repeat:no-repeat;background-position:center;margin-top:0px;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="color:rgb(0,0,0);background-color:#c5c5c5;height:80px;margin-top:20px;">
        <div class="container"><a class="navbar-brand" href="#"><img src="assets/img/Final.png" style="height:80px;"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto"></ul><span class="navbar-text actions"> </span><a class="btn btn-link action-button" role="button" href="Pat_Doc.html" style="font-family:Arimo, sans-serif;background-color:#c5c5c5;color:#104685;font-weight:bold;">BACK</a><a class="btn btn-link action-button"
                    role="button" href="index.html" style="font-family:Arimo, sans-serif;background-color:#c5c5c5;color:#104685;font-weight:bold;">HOME</a><a class="btn btn-link action-button" role="button" href="Login.html" style="font-family:Arimo, sans-serif;background-color:#c5c5c5;color:#104685;font-weight:bold;">CONTACT US</a></div>
        </div>
    </nav>
    <div class="login-clean" style="width:350px;height:390px;padding-top:0px;margin-left:450px;margin-top:75px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="height:390px;padding-top:15px;padding-bottom:20px;width:340px;">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration" style="background-size:cover;height:130px;width:120px;margin-left:30px;"><i class="icon ion-ios-pulse-strong" style="color:#104685;margin-left:50px;"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" style="padding-top:0px;" value="<?php echo $username; ?>"><?php echo $username_err; ?></div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"><input class="form-control" type="password" name="password" placeholder="Password"><span class="help-block"><?php echo $password_err; ?></span></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" onclick="document.location.href='Doctor_Upload.php'" style="padding-bottom:8px;padding-top:8px;margin-top:20px;">Log In</button></div>
            <a href="#" class="forgot" style="width:170px;margin-left:40px;">Forgot your email or password?</a>
            <a
                href="Signup_Pat.php" class="forgot" style="width:170px;margin-top:5px;margin-left:40px;">New user? Create new account.</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/Simple-Slider1.js"></script>
</body>

</html>