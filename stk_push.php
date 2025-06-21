
<?php
date_default_timezone_set('Africa/Nairobi');

// Credentials

$consumerkey="r0vpx85kSDNu7QmArky40rfpq84yecMQ8fn3BnqMjOhUHLSk";
$consumerSecret="WFXRgkpSCmmifuZveTntxvGpmp5xPWh6JnlxmHALCKH9VGJpUEqGhAAu7w0Hp3Hc";

$BusinessShortCode = '174379';
$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$phone = '254708374149'; // Test number

// Timestamp and Password
$Timestamp = date('YmdHis');
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

// Get Access Token
$credentials = base64_encode($consumerkey . ':' . $consumerSecret);
$ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// Decode access token
$response = json_decode($response);
$access_token = $response->access_token;

// Build STK Push request
$stkUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$curl_post_data = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => '1',
    'PartyA' => $phone,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $phone,
    'CallBackURL' => 'https://ww-mpesa.onrender.com/callback.php', // Replace with your real callback
    'AccountReference' => 'Test123',
    'TransactionDesc' => 'Testing STK Push'
];

// Send STK Push
$ch = curl_init($stkUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curl_post_data));
$response = curl_exec($ch);
curl_close($ch);

// Show response
echo $response;
?>
