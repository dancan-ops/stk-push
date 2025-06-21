<?php
date_default_timezone_set('Africa/Nairobi');

$consumerkey="r0vpx85kSDNu7QmArky40rfpq84yecMQ8fn3BnqMjOhUHLSk";
$consumerSecret="WFXRgkpSCmmifuZveTntxvGpmp5xPWh6JnlxmHALCKH9VGJpUEqGhAAu7w0Hp3Hc";

$BusinessShortCode = '174379';
$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';


// 3. Timestamp and Password
$Timestamp = date('YmdHis'); // Format: 20250614174212
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

// 4. Phone number (use 2547... format in sandbox)
$phone = '254708374149'; // Test number from Safaricom docs

//access token url
$access_token_url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic cjB2cHg4NWtTRE51N1FtQXJreTQwcmZwcTg0eWVjTVE4Zm4zQm5xTWpPaFVITFNrOldGWFJna3BTQ21taWZ1WnZlVG50eHZHcG1wNXhQV2g2Sm5seG1IQUxDS0g5VkdKcFVFcUdoQUF1N3cwSHAzSGM=']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$response=json_decode($response);
echo $access_token_url=$response ->access_token;
//echo $response;
curl_close($ch);


// 6. Set STK Push URL
$stkUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

// 7. Build data for the request
$curl_post_data = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => '1', // Amount in KES
    'PartyA' => $phone,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $phone,
    'CallBackURL' => 'https://example.com/callback', // Use your ngrok or localtunnel here
    'AccountReference' => 'Test123',
    'TransactionDesc' => 'Testing STK Push'
];

// 8. Make the STK Push
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

echo $response;
?>
