<?php
$sender = 'zemk05@vse.cz';
$htmlFirstPart = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>E-shop lukostřelby</title>
</head>
<body>';
$htmlSecondPart = '
</body>
</html>';
$templates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/' . phpversion()
    ],
    'Registrace' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        global $subject;
        $subject = 'Registrace';
        return (
            $htmlFirstPart .
            '<h2>Potvrzení registrace</h2>' .
            '<p>Děkujeme za vaši registraci na našem e-shopu!!</p>' .
            '<h4>E-mail registrovaného uživatele:</h4>' .
            '<p><a href="mailto:' . $recipient. '">' . $recipient . '</a></p>' .
            '<p>Přihlasit se můžete zde: <a href="https://eso.vse.cz/~zemk05/SP/">https://eso.vse.cz/~zemk05/SP/</a></p>' .
            '<hr>' .
            '<p>V případě jakýchkoliv dotazů nás neváhejte kontaktovat: <a href="mailto:' . $sender . '">' . $sender. '</a></p>' .
            $htmlSecondPart
        );
    },
    'Objednavka' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        global $subject;
        $subject = 'Potvrzení objednávky';
        return (
            $htmlFirstPart .
            '<h2>Potvrzení vaší objednávky</h2>' .
            '<p>Děkujeme za vaši objednávku!</p>' .
            '<p>Souhrn vaší objednávky naleznete na našich stránkách v sekci Objednávky: <a href="https://eso.vse.cz/~zemk05/SP/">https://eso.vse.cz/~zemk05/SP/</a></p>' .
            '<hr>' .
            '<p>V případě jakýchkoliv dotazů nás neváhejte kontaktovat: <a href="mailto:' . $sender . '">' . $sender. '</a></p>' .
            $htmlSecondPart
        );
    },
];
    function sendEmail($args) {
        global $templates;
        global $subject;
        $headers = implode("\r\n", $templates['headers']);
        $message = $templates[$args['subject']]($args['to']);
        return mail(
            $args['to'], 
            $subject, 
            $message, 
            $headers
        );
    };
    if(isset($_GET['recipient'])){
        $recipient = $_GET['recipient'];
        if(isset($_GET['email'])){
            $mailType = $_GET['email'];
            $sendStatus = sendEmail([
                'to' => $recipient, 
                'subject' => $mailType
            ]);
        }    
    }
    header('Location: index.php');
?>