<?php
/*
 * import_give.php
 * 
 * program will read in data from 
 * import_me.csv 
 * and then pass it into the give database
 */
include_once '../queries/camel.php';
<<<<<<< HEAD:sql/import/import_give_ian.php
include_once '../../php/ini/GIVECenterini.php';
=======

>>>>>>> cf1b6ddcf388a2778cb34a730d811e3a3f9aff71:sql/import/import_give.php
main();

function main()
{
    /****************************************************************************
    * Connect to Database, show error if unsuccessful
    ****************************************************************************/
    $db_host=$GIVE_MYSQL_SERVER; 
    $db_dbname=$GIVE_MYSQL_DATABASE;
    $db_user=$GIVE_MYSQL_UNAME;
    $db_pass=$GIVE_MYSQL_PASS;

    mysql_connect($db_host,$db_user,$db_pass) or die("db connection error".mysql_error()."\n".error_art());
    mysql_select_db($db_dbname) or die("db select error".mysql_error()."\n".error_art());

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
    
    $pointers['agency']=0;          //  agency -> db pointer for last agency made
    $pointers['addr']=0;            //  addr -> db pointer for last add made
    $pointers['pcontact']=0;        //  pcontact -> db pointer for last pro contact made
    $pointers['line']=1;     //  Line Number lets us know, if failure, where in the file it occured.  Also used for Program_id
    $pointers['last_agency']='';    //  last agency -> holds name of last agency for checking
    $pointers['program_id']=0;      //  holds id for current program bring created
    
    $bull['pcontact']=false;
    $bull['addr']=false;
    
    while($line = fgets($fh))
    {
        global $pointers;
        line_handler($line);
        $pointers['line']++;		
    }
    fclose($fh);
}

/*****************************************************************************
 * ***************************************************************************
 * ***************** FUNCTIONS FOR HANDLING INFORMATION **********************
 * ***************************************************************************
 *****************************************************************************/

function line_handler($line)
{
//  Break of Line to match CSV, separating fields
    $input = explode(';',$line);
    
//  Set exploded into the new array on each iteration
    $items=array();
    foreach($input as $temp)
    {
        if($temp=='')$temp='null';
        array_push($items, $temp);
    }
//  insert data into database!
    get_query_1($items[0]); //  Agency Table
    get_query_4($items);    //  Pro Contact Table
    get_query_5($items);    //  Addr Table
    get_query_2($items);    //  Program Table
}

/**
 *  Query is used for handling the agency information
 * @global type $pointers   pointers and similar info
 * @param type $newagency   agency to check for, usually $items[0]
 */
function get_query_1($newagency)
{
/******************************************************************************
 * this query is for handling the agency
 * 
 * the query is based on whether the current line has an agency
 * name that is unique, or one that already exists.
 * 
 * if the agency doesn't already exist, insert into database, increment the 
 * agency id counter, and the last agency created
 ******************************************************************************/
    global $pointers;
    //  agency_num holds the number of agencies and will be used for association with the correct agency
    
    //  Case of new agency, and the agency is used
    if ($newagency==$pointers['last_agency'])
    {   
        $query1 = "INSERT INTO agency(name)VALUES(".$newagency.")";
        $pointers['last_agency']=$newagency;
        $pointers['agency'] ++;
        
        mysql_query($query1) or die("query1-agency failed on ".$pointers['line'].mysql_error());
    }
}

/**
 *  Inserts Program Data into database
 * @global type $pointers   array holding pointers to ids and simmilar info
 * @global type $bull   bool array for whether addr & pcontact are set
 * @param type $items   array holding incoming data to be added
 */
function get_query_2($items)
{
    global $pointers,$bull;
    
    $bull['pcontact'] ? $contact_id = $pointers['pcontact'] : $contact_id = 'null';
    $bull['addr'] ? $addr_id = $pointers['addr'] : $addr_id = 'null';
    
    $query2 = "INSERT INTO program(name,desript,agency,addr,p_contact)
                VALUES($items[1],$items[2],".$pointers['agency'].",".$pointers['addr'].",".$pointers['pcontact'].")";
    
    mysql_query($query2) or die("query2-program failed on ".$pointers['line'].mysql_error());
    $pointers["program_id"]++;
}

/**
 *  Inserts p contact info when set, then updates appropriate pointers and bools
 * @global type $pointers   array holding pointers to ids and simmilar info
 * @global type $bull   bool array for whether addr & pcontact are set
 * @param type $items   array holding incoming data to be added
 */
function get_query_4($items)
{
    global $pointers,$bull;
    
    //  Case for there is a new contact
    if($items[10]!= 'null' || $items[12]!='null')
    {
        $query4 = "INSERT INTO pro_contact(title,f_name,m_name,l_name,suf,w_phone,m_phone,mail)
                VALUES($items[3],$items[4],$items[5],$items[6],$items[7],".phone_format($items[8]).",".phone_format($items[9]).",$items[10])";
        mysql_query($query4) or die("query4-pcontact failed on ".$pointers['line'].mysql_error());
        
        $bull['pcontact']=true;
        $pointers['pcontact']++;
    }
    else
    {
        $bull['pcontact']=false;
    }
}

/**
 *  inserts address when set, and updates appropriate bool and pointer values
 * @global type $pointers   array holding pointers to ids and simmilar info
 * @global type $bull   bool array for whether addr & pcontact are set
 * @param type $items   array holding incoming data to be added
 */
function get_query_5($items)
{
    global $pointers,$bull ;
    
    if($items[11]!='null')
    {
        $query5 = "INSERT INTO addr(street)
                VALUES($items[11])";
        mysql_query($query5) or die("query5-addr failed on ".$pointers['line'].mysql_error());
        
        $bull['addr']=true;
        $pointers['addr'] ++;
    }
    else
    {
        $bull['addr']=false;
    }   
}

/**
 *  Function takes phone numbers and makes them database friendly
 * @param type $input
 * @return type 
 */
function phone_format($input)
{
    //  Checks for proper formatting of phone number
    //  regex removes '-' from xxx-xxx-xxxx or () from
    //  (xxx)-xxx-xxxx or "" from "xxx-xxx-xxxx"
    
    $pattern = '/(\-|\(|\)|\")/';
    $replace = '';
    
    preg_replace($pattern,$replace,$input);
    
    return $input;
}