<?php
/*Exportuje data z databáze do XML*/

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

$xml .= "<events>";

    //send the xml header to the browser
    header("Content-Type:text/xml");

    @session_start();
    //select all items in table
    include "include/connect.php";

    if (!isset($_SESSION['user_id'])) {
    // $user_id->id = "";
    if (basename($_SERVER['PHP_SELF']) != "index.php") {
    header("location: index");
    }
    } else {
    $user_id = new User();
    $user_id->id = $_SESSION['user_id'];
    $user_id->user_data();
    }

    $sql = "SELECT * FROM events";

    global $con;
    $result = $con->query($sql);
    if (!$result) {
    die('Invalid query: ' . $con->error());
    }

    if ($result->num_rows > 0) {
    global $con, $user_id;
    while ($result_array = $result->fetch_assoc()) {
    $event_id = $result_array['event_id'];
    $admin = $result_array['event_admin'];
    $admin_explode = explode(",", $admin);

    $participation_query = $con->query("select * from participation where id='$event_id'");
    $participation_row = $participation_query->fetch_assoc();
    $attending = $participation_row['attending'];
    $attending_explode = explode(",", $attending);
    $not_going = $participation_row['not_going'];
    $not_going_explode = explode(",", $not_going);
    $invited = $participation_row['invited'];
    $invited_explode = explode(",", $invited);

    $ucast_a_invited = array_merge($attending_explode, $invited_explode);

    if (in_array($user_id->id, $admin_explode) || in_array($user_id->id, $ucast_a_invited)) {

    $xml .= "<event>";

        //loop through each key,value pair in row
        foreach ($result_array as $key => $value) {
        //$key holds the table column name
        $xml .= "<$key>";

            //embed the SQL data in a CDATA element to avoid XML entity issues
            $xml .= "$value";

            //and close the element
            $xml .= "</$key>";
        }
        $xml .= "<userid>$user_id->id</userid>";

        $xml .= "</event>";
    }
    }
    }

    //close the root element
    $xml .= "</events>";

//output the XML data
echo $xml;