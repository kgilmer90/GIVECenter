<?php

/*
 *      Generic Will Work on All Updates Except Images, Hours, Issues, & Seasons
 * 
 *      update works by taking in an Assoc array and for each key, which matches
 *      a field in the database, it will set the value for the key, by appending
 *      them all to a string which is part of the update sql statement
 */

/**
 *  Update function that should work for all tables except issues hours & seasons 
 * @param type $conn    database connection
 * @param type $table   table to update
 * @param type $id      id of table entry
 * @param type $info_array  information to update 
 */
function update_generic($conn,$table,$id,$info_array)
{
    $set = "";
    if ($info_array['id']) unset ($info_array['id']);
    
    foreach($info_array as $k => $v)
    {
        if (is_numeric($v)) {
            $set .= "$k = $v,";
        }
        else{
            $set .= "$k = '$v',";
        }
    }
    
    $set = substr($set, 0, strlen($set)-1); 
    
    $query = "UPDATE $table
                SET $set
                WHERE id = $id";
    try{
        $conn->query($query);
    }
    catch(Exception $e){
        echo $e;
    }
}
?>
