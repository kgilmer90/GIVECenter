/**
 *  Creates all program objects
 * @return returns array holding objects
 */
function create_programs()
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $program_array;

    $query = "SELECT id,referal,season,time,name,duration,notes,issues,addr,agency,p_contact,s_contact,descript
                FROM program";

    // missing s_contact & descript in GIVEPROGRAM

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $program = new GIVEAgency($temp);
        array_push($program_array,$program);
    }

    return $program_array;
}
