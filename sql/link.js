/*
 * Functions for linking together objects by way of array passing of id's
 *
 * Search assumes that object arrays of the programs issues and agencies are all globally accessable
 * Also the returned variables are all declared locally
 * Arrays will be passed back by reference, so hopefully name shouldnt conflict
 */



/**
 *link issues to program
 *@param program_id to find issues
 *@return returns array containing id's of issues belonging to the specified program
 */

function get_issue($1)
{
    //$1 is program id to search against
    var $results_array;     //local array to hold results, but will have ref passed
    //search issue
    for ($temp in $issue_array)
    {
        if ($temp['program_id'] == $1)
        {
                $results_array.push ($temp['issue_id']);
        }
    }
    return $results_array;
}


/**
 * link program to agency
 * @param program_id to find agency for
 * @return returns string containing the id # for the agency
 */
function get_agency($1)
{
    // $1 is program id to search against
    var $result = "";       //locally stored result that will need to be copied
	
    // search for agency
    for ($temp in $agency_array)
    {
        if ($temp['program_id'] == $1)
        {
                $result = $temp['id'];
        }
    }
    return $result;
}

/**
 * link agency to program
 * @param agency_id to find programs for
 * @return returns array containing id's of programs belonging to the specified agency
 */
function get_programs($1)
{
    //$1 is agency id to search against
    var $results_array;     // local array, but will be returned by ref
    //search issue
    for ($temp in $program_array)
    {
        if (temp['program_id'] == $1)
        {
            $results_array.push (temp['issue_id']);
        }
    }
    return $results_array;
}
