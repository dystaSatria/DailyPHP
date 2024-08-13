<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = "[Your Own Twilio Account SID]";
    $authToken = "[Your Own Twilio Auth Token]";
    $to = $_POST['to'];
    $from = $_POST['from'];
    $body = $_POST['message'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$sid:$authToken");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'To' => $to,
        'From' => $from,
        'Body' => $body
    )));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get the HTTP status code
    curl_close($ch);

    // Output the raw response and HTTP status code
    echo "<pre>";
    echo "HTTP Status Code: " . $http_code . "\n";
    echo "Response: " . $response . "\n";
    echo "</pre>";

    // Check if the message was queued
    if ($http_code == 201) {
        echo '<div class="alert alert-success text-center">Message sent successfully!</div>';
    } else {
        echo '<div class="alert alert-danger text-center">Failed to send message. Please try again.</div>';
    }
}
