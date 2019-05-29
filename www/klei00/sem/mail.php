<?php

$sender = 'klei00@vse.cz';

// template
$location;
$subject;
$htmlFirstPart = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BookShop</title>
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
        global $location;
        global $subject;
        $location = 'index.php?signup';
        $subject = 'Registrace';
        return (
            $htmlFirstPart .
            '<h2>Potvrzení registrace</h2>' .
            '<p>Děkujeme, že jste se u nás registrovali!</p>' .
            '<h4>Registrovaný e-mail:</h4>' .
            '<p><a href="mailto:' . $recipient. '">' . $recipient . '</a></p>' .
            '<p>Přihlasit se můžete zde: <a href="https://eso.vse.cz/~klei00/sem/">https://eso.vse.cz/~klei00/sem/</a></p>' .
            '<hr>' .
            '<p>V případě jakýchkoliv dotazů nás neváhejte kontaktovat: <a href="mailto:' . $sender . '">' . $sender. '</a></p>' .
            $htmlSecondPart
        );
    },
    'Objednavka' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        global $location;
        global $subject;
        $location = 'cart.php?sent';
        $subject = 'Objednávka';
        return (
            $htmlFirstPart .
            '<h2>Přijetí objednávky</h2>' .
            '<p>Děkujeme, že jste si u nás objednali!</p>' .
            '<p>Objednávku Vám potvrdíme, až ověříme dostupnost Vámi objednaného zboží.</p>' .
            '<p>Stav vaší objednávky můžete sledovat na našich stránkách v sekci Můj profil: <a href="https://eso.vse.cz/~klei00/sem/">https://eso.vse.cz/~klei00/sem/</a></p>' .
            '<hr>' .
            '<p>V případě jakýchkoliv dotazů nás neváhejte kontaktovat: <a href="mailto:' . $sender . '">' . $sender. '</a></p>' .
            $htmlSecondPart
        );
    },
    'Stav' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        global $location;
        global $subject;
        $location = 'orders.php?submit';
        $subject = 'Stav objednávky';
        return (
            $htmlFirstPart .
            '<h2>Změna stavu objednávky</h2>' .
            '<p>Vaše objednávka byla potvrzena a je připravena k vyzvednutí!</p>' .
            '<p>Zboží si můžete přijít osobně vyzvednout na pobočku v našich otvíracích hodinách.</p>' .
            '<p>Stav vaší objednávky můžete sledovat na našich stránkách v sekci Můj profil: <a href="https://eso.vse.cz/~klei00/sem/">https://eso.vse.cz/~klei00/sem/</a></p>' .
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
    var_dump($headers);
    return mail(
        $args['to'], 
        $subject, 
        $message, 
        $headers
    );
};


// Sending a mail
if(isset($_GET['recipient'])){
    $recipient = $_GET['recipient'];

    if(isset($_GET['mail'])){
        $mailType = $_GET['mail'];
        $sendStatus = sendEmail([
            'to' => $recipient, 
            'subject' => $mailType
        ]);
    }    
}

header('Location: '.$location);

?>