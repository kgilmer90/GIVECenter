<?php

/*
 * same as other fix, but for longer names
 */

$import = "Volunteer
Volunteer
Survivor Buddies
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Blood Drives
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Young @ Heart
DM for the Kids
Volunteer
Volunteer
Volunteer
Volunteer
Creative Expressions
Best Buddies
Volunteer
Volunteer
Young @ Heart
Volunteer
Academic Outreach
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Survivor Buddies
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Visit-A-Veteran
Volunteer
Volunteer
Kappa Delta
Volunteer
Volunteer
Volunteer
Young @ Heart
Strong Enough to Care
Circle K
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Best Buddies
Creative Expressions
Volunteer
Volunteer
Make-A-Wish
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
SNAP
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Survivor Buddies
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Campus Catholics
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Best Buddies
Volunteer
Volunteer
Soul Food??
Zeta Tau Alpha??
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
First Book
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer
Volunteer";

mysql_connect('localhost', 'bgs', 'dki2012!');
mysql_select_db('give_ctr_agencies');

$import_array = explode("\n",$import);
$index = 1;

echo $import_array[$index];

foreach($import_array as $temp){
    $query = "UPDATE program
        SET name = '$temp'
        WHERE id = $index";
    mysql_query($query);
    $index++;
}
echo mysql_error();

?>