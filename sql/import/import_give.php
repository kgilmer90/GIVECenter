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
    
    //  last agency -> holds name of last agency for checking
    //  agency -> db pointer for last agency made
    //  addr -> db pointer for last add made
    //  pcontact -> db pointer for last pro contact made
    //  Line Number lets us know, if failure, where in the file it occured

    $pointers['agency']=0;
    $pointers['addr']=0;
    $pointers['pcontact']=0;
    $pointers['line_number']=1;
    $pointers['last_agency']='';
    
    while($line = fgets($fh))
    {
        line_handler($line);
        $pointers['line_number']++;		
    }
    fclose($fh);
}

/*****************************************************************************
 * ***************************************************************************
 * ***************** FUNCTIONS FOR HANDLING INFORMATION **********************
 * ***************************************************************************
 *****************************************************************************/

/*  Data Sample
 * $agency = compact("name1");
 * $program = compact("name2","desript3","season4","times5","issues6","notes7","ref8");
 * $student_contact = compact("mail9");
 * $pro_contact = compact("title10","f_name11","m_name12","l_name13","suf14","w_phone15","m_phone16","mail17");
 * $agency_addr = compact("street18");      
 * 
 * 0    "100 Black Men of Milledgeville Oconee Area";
 * 1    "Volunteer";
 * 2    "The mission of the 100 Black Men of America, Inc. is to improve the quality of life within our communities and enhance educational and economic opportunities for all African Americans.";
 * 3    ;
 * 4    ;
 * 5    ;
 * 6    ;
 * 7    ;
 * 8    "James";
 * 9    ;
 * 10   "Lunsford";
 * 11   ;
 * 12   "478-452-7990";
 * 13   ;
 * 14   "jameslunsford1@yahoo.com";
 * 15   ;
 * 16   ;
 * 17   ;
 * 18   "310 S Clark St"
 */

function line_handler($line)
{
//    global $agency, $agency_num;
    
//  Break of Line to match CSV, separating fields
    $input = explode(';',$line);
    
//  Set exploded into the new array on each iteration
    $items=array();
    foreach($input as $temp)
    {
        if($temp=='')$temp=null;
        array_push($items, $temp);
    }
//  insert data into database!
    get_query_1($items[0]); //  Agency Table
    get_query_4($items);    //  Pro Contact Table
    get_query_5($items);    //  Addr Table
    get_query_2($items);    //  Program Table
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
    global $pointers ;
    //  agency_num holds the number of agencies and will be used for association with the correct agency
    
    //  Case of new agency, and the agency is used
    if ($items[0]==pointers['last_agency'])
    {   
        $agency[$pointers['agency']]=$newagency;
        $query1 = "INSERT INTO agency(name)VALUES(".$items[0].")";
        $pointers['agency'] ++;
        
        mysql_query($query1) or die("query1 failed on $line_number ".mysql_error());
    }
    
    //  Case of existing agency, and a new agency is not created
    else
    {} 
}

/**
 *  Inserts Program into DB
 * @global type $line_number
 * @global type $agency_num
 * @param type $items 
 */
function get_query_2($items)
{
    global $line_number,$agency_num,$pcontact_num,$addr_num ;
    
    $query2 = "INSERT INTO program(name,desript,season,times,issues,notes,ref,agency)
                VALUES($items[1],$items[2],$items[3],$items[4],$items[5],$items[6],$items[7],$agency_num)";
    
    mysql_query($query2) or die("query2 failed on $line_number ".mysql_error());
}

/**
 *  Query for pro_contact
 * @global type $line_number 
 */
function get_query_4($items)
{
    global $line_number,$pcontact_num;
    
    if($items[10]!= null || $items[12]!=null)
    {
        $query4 = "INSERT INTO pro_contact(title,f_name,m_name,l_name,suf,w_phone,m_phone,mail,program_id)
                VALUES($items[9],$items[10],$items[11],$items[12],$items[13],$items[14],$items[15],$items[16],$line_number)";
        mysql_query($query4) or die("query4 failed on $line_number ".mysql_error());
        $pcontact_num++;
    }
}

/**
 *  Query for Agency Address
 * @global type $line_number 
 */
function get_query_5($items)
{
    global $line_number,$addr_num ;
    
    if($items[18]!=null)
    {
        $query5 = "INSERT INTO agency_addr(street)
                VALUES($items[18])";
        mysql_query($query5) or die("query5 failed on $line_number ".mysql_error());
        $addr_num++;
    }
    
       
    
}

function phone_format($input)
{
    //  Checks for proper formatting of phone number
    //  regex removes '-' from xxx-xxx-xxxx or () from
    //  (xxx)-xxx-xxxx or "" from "xxx-xxx-xxxx"
    
    $pattern = '/(\-|\(|\)|\")/g';
    $replace = '';
    
    preg_replace($pattern,$replace,$input);
}