<?php
/*
 * Create_Agencies.php
 * 
 * ************************************************************************ *
 * Function Creates Array Objects, and returns them.  Nests Respective      *
 * Objects as well.                                                         *
 *                                                                          *
 * create_agencies($conn)                                                   *
 * ************************************************************************ *
 */

include_once(dirname(__FILE__).'/object_creater.php');
include_once(dirname(__FILE__).'/../queries/camel.php');
include_once(dirname(__FILE__).'/../../php/GIVE/GIVEAgency.php');
include_once(dirname(__FILE__).'/../../php/MySQLDatabase/MySQLDatabaseConn.php');
 
/**
 *  Creates Objects for all the agencies and their information and returns them
 *  in an array
 * @param MySQLDatabaseConn $conn
 * @return array 
 */
function create_agencies($conn,$type)
{
    /*
     * Setup for function whereby we will create the query, pass it and store
     * it before our later manipulation
     */
    $agency_array = array();        

    $query = "SELECT id,name,descript,mail,phone,fax,p_contact_id,addr
                FROM agency";      
    $conn->query($query);          
 
    
    /*  Results is a numerical indexed Assoc Array of all the Agencies
     *  which we are going to step through every agency, create a object for it
     *  to which we pass all the information.
     * 
     *  As well, where the assoc is holding an id for another table,
     *  we will be creating an object for it and storing it there instead.
     * 
     *  In the case of programs where there are multiple programs, we will be
     *  storing an array of objects, more specifically a reference to them.
     * 
     *  
     */
    if($conn->numRows()==0){
        return null;
    }
    $results = $conn->fetchAllAsAssoc();  
    
    foreach($results as $temp)
    {
        //crete program objects
        $temp['program'] = create_programs($conn, $temp['id'],$type);
        //p contact object
        if($type){
            $temp['p_contact_id'] = create_p_contact($conn, $temp['p_contact_id']);}
            
        else{
            $temp['p_contact_id'] = create_p_contact_limited($conn, $temp['p_contact_id']);
        }
        //addr object
        $temp['addr'] = create_addr($conn, $temp['addr']);
        
        //Create Agency Object to Hold Everything
        $agency = new GIVEAgency($temp);
        array_push($agency_array,$agency);
    }
    		
    return $agency_array;
}
?>
