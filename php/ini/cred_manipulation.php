<?php

/*
 * Functions for:
 * Adding, Changing, Removing
 * 
 * Users & Passwords
 *
 */
include ('../MySQLDatabase/MySQLDatabaseConn.php');
include ('GIVECenterini.php');

/**
 * Function Adds User for initial login to the site
 * @param type $conn    object holding database information
 * @param type $uname   name for the user to be created
 * @param type $passwd  password for new user
 */
function add_user($conn, $uname, $passwd)
{
    $query = "INSERT INTO users ('uname','passwd')
                VALUES ($uname, $passwd)";
    
    $conn->query($query);
}

/**
 *  Function for removing a specified user
 * @param type $conn    mysqldbconn object
 * @param type $uname   name for user to be removed
 */
function remove_user($conn,$uname,$passwd)
{
    $query = "DELETE FROM users
                WHERE uname = $uname AND passwd = $passwd";
    $conn->query($query);    
}

/**
 *  Function for changing password for a specified user
 * @param type $conn        mysqldbconn object
 * @param type $uname       user for whom to change the password
 * @param type $old_passwd  old password
 * @param type $new_passwd  new password for the user
 */
function change_pass($conn, $uname, $old_passwd, $new_passwd)
{
    $query = "UPDATE users
                SET passwd = $new_passwd
                WHERE uname = $uname AND passwd = $old_passwd";
    $conn->query($query);
}


?>
