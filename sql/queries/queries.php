<?php

/*
 * QUERIES FOR ADVANCED SEARCH
 * 
 */

    /**
     *  Queries Database for List of All Issues for Advanced Search
     * @param type $conn    database connection
     * @return type     Num'd Sock'd Array of Issues: id,name
     */
    function get_issues($conn)
    {
        $query = "SELECT * FROM issues";
        $conn->query($query);
        
        $issues = $conn->fetchAllAsAssoc();
        return $issues;
    }

    /**
     *  Queries db for hours 
     * @param type $conn
     * @return type NUm'd Sock Array of Hours:
     */
    function get_hours($conn)
    {
        $query="SELECT * FROM hours";
        $conn->query($query);
        $hours = $conn->fetchAllAsAssoc();
        return $hours;
    }
    
    /**
     *
     * @param type $conn
     * @return type NUm'd Sock Array of seasons: id,season
     */
    function get_seasons($conn)
    {
        $query="SELECT * FROM seasons";
        $conn->query($query);
        $hours = $conn->fetchAllAsAssoc();
        return $hours;
    }

?>
