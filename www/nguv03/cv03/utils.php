<?php 
// create an object with key value pairs
$sender = 'Bilbo Baggins <bilbo@baggins.cz>';

// associative array to keep templates
$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/'.phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return (
            "<h2>Registration confirmation</h2>" .
            "<p>Thank you for signing up!</p>" .
            "<h4>You registered email:</h4>" .
            "<p><a href='mailto:$recipient'>$recipient</a></p>"
        );
    },
];
function sendEmail($args) {
    // access variables from outside using keyword global
    global $emailTemplates;
    $headers = implode("\r\n", $emailTemplates['headers']);
    $recipient = $args['recipient'];
    $subject = $args['subject'];
    $body = $emailTemplates[$subject]($recipient);
    //echo $headers . '<br>';
    //echo $recipient . '<br>';
    //echo $subject . '<br>';
    //echo $body . '<br>';
    //return true;
    return 1; //mail($recipient, $subject, $body, $headers);
};
?>