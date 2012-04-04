<?php

/*
 * Functions for:
 * Adding, Changing, Removing
 * 
 * Users & Passwords
 *
 */
include ('../MySQLDatabase/MySQLDatabaseConn.php');
include ('GIVECenterIni.php');

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
                SET passwd = ".md5($new_passwd)."
                WHERE uname = $uname AND passwd = ".md5($old_passwd);
    $conn->query($query);
}

/**
 *  Checks credentials for person attempting to login
 * @param type $conn    database connection object
 * @param type $uname   username
 * @param type $passwd    password
 * @return type $varified boolean that returns if user and pass are correct
 */
function check_user($conn, $uname, $passwd)
{
    $verified = false;
    
    $query = "SELECT FROM users
                WHERE uname = $uname AND passwd = ".md5($passwd);
    
    $conn->query($query);
            
    if ($conn->numRows() == 1)
        $verified = true;
    
    return $verified;
}

?>
