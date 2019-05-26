<?php
/*Exportuje data z databáze do XML*/

//database configuration
/*$config['mysql_host'] = "localhost";
$config['mysql_user'] = "root";
$config['mysql_pass'] = "";
$config['db_name']    = "prazdninovac";
$config['table_name'] = "events";

//connect to host
mysql_connect($config['mysql_host'],$config['mysql_user'],$config['mysql_pass']);
//select database
@mysql_select_db($config['db_name']) or die( "Unable to select database");
 */
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
//$root_element = $config['table_name']."s"; //fruits
$xml .= "<events>";

    //send the xml header to the browser
    header("Content-Type:text/xml");

    @session_start();
    //select all items in table
    include "include/connect.php";

    if (!isset($_SESSION['user_id'])) {
    $user_id->id = "";
    if (basename($_SERVER['PHP_SELF']) != "index.php") {
    header("location: index");
    }
    } else {
    $user_id = new User($_SESSION['user_id']);
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
    $ucastni_se = $participation_row['ucastni_se'];
    $ucastni_se_explode = explode(",", $ucastni_se);
    $nemuze = $participation_row['nemuze'];
    $nemuze_explode = explode(",", $nemuze);
    $pozvani = $participation_row['pozvani'];
    $pozvani_explode = explode(",", $pozvani);

    $ucast_a_pozvani = array_merge($ucastni_se_explode, $pozvani_explode);

    if (in_array($user_id->id, $admin_explode) || in_array($user_id->id, $ucast_a_pozvani)) {

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

        $xml .= "</event>";
    }
    }
    }

    //close the root element
    $xml .= "</events>";

//output the XML data
echo $xml;