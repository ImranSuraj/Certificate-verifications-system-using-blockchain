<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = generateOTP();

    // Send the OTP email using SendinBlue API
    sendOTPByEmail($email, $otp);

    echo $otp;
}

function generateOTP() {
    // Generate a random 6-digit OTP
    return str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
}

function sendOTPByEmail($email, $otp) {
    $url = "https://api.sendinblue.com/v3/smtp/email";

    $data = array(
        'sender' => array(
            'name' => 'Imran Wani',
            'email' => 'imranwani11111@gmail.com'
        ),
        'to' => array(
            array('email' => $email)
        ),
        'subject' => 'OTP Verification',
        'htmlContent' => "Your OTP is: $otp"
    );

    $payload = json_encode($data);

    $headers = array(
        'Content-Type: application/json',
        'api-key: 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'
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);
}
?>
