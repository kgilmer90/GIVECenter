<?php
/*
 * import_give.php
 * 
 * program will read in data from 
 * import_me.csv 
 * and then pass it into the give database
 */
include_once '../queries/queries_for_ian.php';
main();

function main()
{
    /****************************************************************************
    * Connect to Database, show error if unsuccessful
    ****************************************************************************/
    $db_host="localhost"; 
    $db_user="bgs";
    $db_pass="dki2012!";

    mysql_connect($db_host,$db_user,$db_pass) or die("db connection error".mysql_error()."\n".error_art());
    mysql_select_db("give_ctr_agencies") or die("db select error".mysql_error()."\n".error_art());

    /****************************************************************************
    * Open CSV file containing information to upload, die if fail
    ****************************************************************************/

    $fh = fopen("import.csv", 'r') or die("File not opened! lol".  error_art());

    /****************************************************************************
    * Read input from file and handle appropriately before uploading into
    * the database.
    * 
    * behaviour of the algorithm:
    * 
    *      Read line from file
    *      split line into cells, using comma as delim
    *      store information into an array, pad nulls where necessary
    *      
    * 
    *      
    ****************************************************************************/

    $agency = array();      //	Agency array holds unique array names
    $agency_num = 0;        //  Number of Unique Agencies, used during program creation for agency_id
    $line_number = 1;       //  Line Number lets us know, if failure, where in the file it occured

    while($line = fgets($fh))
    {
        line_handler($line);
        $line_number++;		
    }
    fclose($fh);

}
/*
$agency = compact("name");
$program = compact("name","desript","season","times","issues","notes","ref");
$student_contact = compact("mail");
$pro_contact = compact("title","f_name","m_name","l_name","suf","w_phone","m_phone","mail");
$agency_addr = compact("street");
*/



/*****************************************************************************
 * ***************************************************************************
 * ***************** FUNCTIONS FOR HANDLING INFORMATION **********************
 * ***************************************************************************
 *****************************************************************************/


function line_handler($line)
{
//    global $agency, $agency_num;
    
//  Break of Line to match CSV, separating fields
    $input = explode(',',$line);
    
//  Set exploded into the new array on each iteration
    $items=array();
    foreach($input as $temp)
    {
        array_push($items, $temp, $_ = null);
    }
    
//  insert data into database!
    get_query_1($items[0]);
    get_query_2($items);
//  query 3 doesnt exist because there isnt any student info at the moment
    get_query_4($items);
    get_query_5($items);
}




/**
 *  Query is used for handling the agency information.  It creates a new agency
 * if it does not already exists, and shares the agency id if it does
 * @param type $newagency   agency name to look for
 * @param type $agency      array of existing agency names numerical indexed
 */
function get_query_1($newagency)
{
/******************************************************************************
 * this query is for handling the agency
 * 
 * the query is based on whether the current line has an agency
 * name that is unique, or one that already exists.
 * 
 * if the agency doesn't already exist, create a new entry for it and 
 * 
 * else the agency already exists, link it to the existing one by way of
 * using the agency_id 
 ******************************************************************************/
    global $agency, $agency_num, $line_number;
    //  agency_num holds the number of agencies and will be used for association with the correct agency
    
    //  Case of new agency, and the agency is used
    if (!in_array($newagency,$agency))
    {   
        $agency[$agency_num]=$newagency;
        $query1 = "INSERT INTO agency(name)VALUES(".$items[0].")";
        $agency_num ++;
        
        mysql_query($query1) or die("query1 failed on $line_number ".mysql_error());
    }
    
    //  Case of existing agency, and a new agency is not created
    else
    {} 
}

function get_query_2($items)
{
    global $line_number;
    
    $query2 = "INSERT INTO program(name,desript,season,times,issues,notes,ref,agency)
                VALUES($items[1],$items[2],$items[3],$items[4],$items[5],$items[6],$items[7],$agency_num)";
    
    mysql_query($query2) or die("query2 failed on $line_number ".mysql_error());
}

function get_query_3()
{
    global $line_number;
    
    $query3 = "INSERT INTO student_contact(mail)
                VALUES($items[8])";
    
    mysql_query($query3) or die("query3 failed on $line_number ".mysql_error());
}

function get_query_4()
{
    global $line_number;
    
    $query4 = "INSERT INTO pro_contact(title,f_name,m_name,l_name,suf,w_phone,m_phone,mail,program_id)
                VALUES($items[9],$items[10],$items[11],$items[12],$items[13],$items[14],$items[15],$items[16],$line_number)";
    
    mysql_query($query4) or die("query4 failed on $line_number ".mysql_error());
}

function get_query_5()
{
    global $line_number;
    
    $query5 = "INSERT INTO agency_addr(street)
                VALUES($items[17])";
    
    mysql_query($query5) or die("query5 failed on $line_number ".mysql_error());
}

function phone_format($input)
{
    //  Checks for proper formatting of phone number
    //regex removes '-' from xxx-xxx-xxxx or () from (xxx)-xxx-xxxx
    $pattern = '/(\-|\(|\))/g';
    $replace = '';
    
    preg_replace($pattern,$replace,$input);
}