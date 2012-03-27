<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function return_issues($program_id)
{
    $conn = new MySQLDatabaseConn('localhost','give_ctr_agencies','root', 'mypass');
    $issues_array;
    
    $query = "SELECT issues.name
                FROM issue,program_issues
                WHERE issue.id=program_issues.issue_id
                AND program_issues.program_id = $program_id";

    $issues_array = $conn->fetchAllAsNumeric();
    return $issues_array;
}

function error_art()
{
	echo <<< _END
                     .--.      .'  `.                 _____
                   .' . :\    /   :  L               ( LOL )
                   F     :\  /   . : |        .-._   /   /
                  /     :  \/        J      .' ___\  / /
                 J     :   /      : : L    /--'   ``./
                 F      : J           |  .<'.o.  `-'>
                /        J             L \_>.   .--w)
               J        /              \_/|   . `-__|
               F                        / `    -' /|)
              |   :                    J   '        |
             .'   ':                   |    .    :  \
            /                          J      :     |L
           F                              |     \   ||
          F .                             |   :      |
         F  |                             ; .   :  : F
        /   |                                     : J
       J    J             )                ;        F
       |     L           /      .:'                J
    .-'F:     L        ./       :: :       .       F
    `-'F:     .\    `:.J         :::.             J
      J       ::\    `:|        |::::\            |
      J        |:`.    J        :`:::\            F
       L   :':/ \ `-`.  \       : `:::|        .-'
       |     /   L    >--\         :::|`.    .-'
       J    J    |    |   L     .  :::: :`, /
        L   F    J    )   |        >::   : /
        |  J      L   F   \     .-.:'   . /
        ): |     J   /     `-   | |   .--'
        /  |     |: J        L  J J   )
        L  |     |: |        L   F|   /
        \: J     \:  L       \  /  L |
         L |      \  |        F|   | )
         J F       \ J       J |   |J
          L|        \ \      | |   | L
          J L        \ \     F \   F |
           L\         \ \   J   | J   L
          /__\_________)_`._)_  |_/   \_____


_END;

}


?>
