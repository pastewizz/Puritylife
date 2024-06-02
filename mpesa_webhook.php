<?php
// Handle payment notification from M-Pesa webhook
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the incoming JSON data
    $mpesaNotification = file_get_contents('php://input');
    // Decode JSON data
    $paymentInfo = json_decode($mpesaNotification, true);

    // Verify that payment was successful
    if ($paymentInfo['ResultCode'] == 0) {
        // Payment was successful, redirect user to download page
        header('Location: download.php');
        exit;
    }
}

// If payment notification is not received or payment was not successful,
// return a generic response
$response = [
    'ResultCode' => 1,
    'ResultDesc' => 'Payment not successful'
];

header('Content-Type: application/json');
echo json_encode($response);
?>
