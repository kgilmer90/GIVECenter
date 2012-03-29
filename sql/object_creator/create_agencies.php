/**
 * Creates Array Objects
 * @return agnecy object
 *
 */
function create_agencies()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $agency_array;

    $query = "SELECT id,name,descript,mail,phone,fax,p_contact,addr
                FROM agency";
  
    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $agency = new GIVEAgency($temp);
        array_push($agency_array,$agency);
    }
    		
    return $agency_array;
}
