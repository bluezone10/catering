<?php
require_once 'vendor/autoload.php'; 

session_start();

// Initialize Google Client
$client = new Google_Client();
$client->setClientId('722602168876-pig2khvccp2m6hbjogbn720do5knai9b.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/catering/call_back.php');
$client->addScope("email");
$client->addScope("profile");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['code'])) {
    // Fetch access token with the authorization code
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    echo($token);
    // Check for errors in token fetching
    if (isset($token['error'])) {
        echo 'Error: ' . htmlspecialchars($token['error_description']);
        exit();
    }

    // Store access token in the session
    $_SESSION['access_token'] = $token;

    // Set access token for future requests
    $client->setAccessToken($token);

    // Fetch user profile information
    $service = new Google_Service_Oauth2($client);
    $user_info = $service->userinfo->get();

    // Extract user information
    $google_id = $user_info->id;
    $name = $user_info->name;
    $email = $user_info->email;

    $conn = new mysqli('localhost', 'root', '', 'catering');

    if ($conn->connect_error) {
        die('Connection failed: ' . htmlspecialchars($conn->connect_error));
    }

    $stmt = $conn->prepare("SELECT * FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO account (customer_id, name, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $google_id, $name, $email);
        $stmt->execute();
    }

    $_SESSION['login'] = true;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['user'] = true;
    $_SESSION['google'] = true;

    header('Location: index.php');
    exit();
} else {
    echo 'Authorization code not found.';
}
?>
