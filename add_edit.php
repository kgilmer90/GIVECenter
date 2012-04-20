<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Have Add & Edit Flags?
 * 
 */

if($_POST['update']){     //  EDIT CONDITION
    if($_POST['addr_id']){
        $_POST['addr']['id'] = $_POST['addr_id'];
        
        
        update_generic($conn, 'addr', $_POST['addr']['id'], $_POST['addr']);
    }
    if($_POST['agency']['id']){
        update_generic($conn, 'agency', $_POST['agency']['id'], $_POST['agency']);
    }
    if($_POST['hours']['id']){
        update_hours($conn, $_POST['program']['id'], $_POST['hours']);
    }
    if($_POST['issues']['id']){
        update_issues($conn, $_POST['issues']);
    }
    if($_POST['p_contact']['id']){
        update_generic($conn, 'pro_contact', $_POST['p_contact']['id'], $_POST['p_contact']);
    }
    if($_POST['program']['id']){
        update_generic($conn, 'program', $_POST['program']['id'], $_POST['program']);
    }
    if($_POST['student_contact']['id']){
        update_generic($conn, 'student_contact',$_POST['student_contact']['id'], $_POST['student_contact']);
    }
    if($_POST['season']['id']){
        update_season($conn, $_POST['program']['id'], $_POST['season']);
    }
}

if ($_POST['add']){     //  Add Condition
    if($_POST['addr']){
        //  Need to return addr id
        $addr_id = create_new_addr($conn, $_POST['addr']);
        $_POST['program']['addr'] = $addr_id;
    }
    if($_POST['agency']){
        $agency_id = create_new_agency($conn, $_POST['agency']);
        $_POST['program']['agency'] = $agency_id;
    }
    if($_POST['hours']){
        create_new_hours($conn, $_POST['program']['id'], $_POST['hours']);
    }
    if($_POST['issue']){
        create_new_issue($conn, $_POST['program']['id'], $_POST['issue']);
    }
    if($_POST['pro_contact']){
        $p_id = create_new_p_contact($conn, $_POST['pro_contact']);
        $_POST['program']['p_contact'] = $p_id;
    }
    if($_POST['student_contact']){
        $s_id = create_new_s_contact($conn, $_POST['s_contact'], $_POST['program']['id']);
        $_POST['program']['s_contact'] = $s_id;
    }
    if($_POST['seasons']){
        create_new_seasons($conn,$_POST['program']['id'], $_POST['season']);
    }
    if($_POST['program']['name']){
        create_new_program_existing_agency($conn, $_POST['program']);
    }
}

header('Location: EditPage.php');

?>
