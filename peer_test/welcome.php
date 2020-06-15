<?php
// Initialize the session
session_start();
 
// Checking for user is loggedin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <?php
    
    //Fetching the Token from SESSION RESULT

/*
        $token = $_SESSION['result'];
        $token1 = (explode(" ",$token));
        $token2 = $token1[5];
        $token3 = (substr($token2,15));
        $token4 = (substr($token3,0,-12));
        print_r($token4);
*/
    //GET API TO FETCH ALL DEPARTMENTS
    $ch = curl_init();
    $apiKey = "";  //Get the oauth token using the api "https://accounts.zoho.com/oauth/v2/token" passing the client id client secret etc.
    $authorization = 'Authorization: Zoho-oauthtoken '.trim($apiKey);
    $orgid = 'orgId:2389290';
    $header = [
                    'Content-Type: application/json',
                    $authorization,
                    $orgid
    ];

    $data = array(
        'isEnabled' => true,
        'chatStatus' => 'AVAILABLE'

    );
    $postdata = json_encode($data);
    curl_setopt($ch, CURLOPT_URL,"https://desk.zoho.com/api/v1/departments");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);
    print_r($server_output);
    echo 'HIEEE';
    // Further processing ...
    if ($server_output == "OK") {
        echo "SUCESS";
     }else{
         echo "ERROR";
      }
    
     // die;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <div>
        <h1>HIIIIIII</h1>
        
    </div>
</body>
</html>