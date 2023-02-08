<?php
header("Content-Type: application/json");
require 'userLogin.php';
$data = json_encode(array('LOGIN' => array('LOGINRESULT' => LoginUser::proofLoginData($_GET['password'], $_GET['username']))));
if ($data === false) {
    // Avoid echo of empty string (which is invalid JSON), and
    // JSONify the error message instead:
    $data = json_encode(["jsonError" => json_last_error_msg()]);
    if ($data === false) {
        // This should not happen, but we go all the way now:
        $data = '{"jsonError":"unknown"}';
    }
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}
echo $data;
?>