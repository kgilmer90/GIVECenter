<?php

/*
 * import issues into database
 */
mysql_connect('localhost', 'bgs', 'dki2012!');
mysql_select_db('give_ctr_agencies');

$string = "alumni,animals,children,disabilities,disasters,education,elderly,environment,female issues,fine arts,general service,health,male issues,minority issues,office,patriotic,poverty,PR,recreation,religious,service leaders,technology";
$delim = ",";

$issues = explode($delim, $string);

foreach($issues as $temp){
    $query = "INSERT INTO issues (name) VALUES ('$temp')";
    mysql_query($query) or die(mysql_error());
}

?>
