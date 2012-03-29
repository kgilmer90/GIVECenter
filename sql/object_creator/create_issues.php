/**
 *  Do we want this?
 * @param program identifier for issues array?
 * @return return array of issues for the supplied program
 */
function create_issues($program_id)
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $issue_array;

    $query = "";

    $conn->query($query);

    $results = $conn->fetchAllAsAssoc();

    foreach($results as $temp)
    {
        $issue = new GIVEAgency($temp);
        array_push($issue_array,$issue);
    }

    return $issue_array;
}
