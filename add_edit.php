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
        $update['addr']['id'] = $_POST['addr_id'];
        $update['addr']['street'] = $_POST['street'];
        $update['addr']['city'] = $_POST['city'];
        $update['addr']['state_us'] = $_POST['state_us'];
        $update['addr']['zip'] = $_POST['zip'];
        
        update_generic($conn, 'addr', $_POST['addr']['id'], $update['addr']);
    }
    
    if($_POST['agency']['id']){
        $update['agency']['name'] = $_POST;
        $update['agency']['descript'] = $_POST;
        $update['agency']['p_contact'] = $_POST;
        $update['agency']['addr'] = $_POST;
        $update['agency']['mail'] = $_POST;
        $update['agency']['phone'] = $_POST;
        $update['agency']['fax'] = $_POST;
   
        update_generic($conn, 'agency', $_POST['agency']['id'], $_POST['agency']);
    }
    
    if($_POST['hours']['id']){
        $update['hours'] = array();
        if($_POST['Hours_0']){array_push($update['hours'], $_POST['Hours_0']);}
        if($_POST['Hours_1']){array_push($update['hours'], $_POST['Hours_1']);}
        if($_POST['Hours_2']){array_push($update['hours'], $_POST['Hours_2']);}
        if($_POST['Hours_3']){array_push($update['hours'], $_POST['Hours_3']);}
        update_hours($conn, $_POST['program']['id'], $_POST['hours']);
    }
    
    if($_POST['issues']['id']){
        update_issues($conn, $_POST['issues']);
    }
    
    if($_POST['p_contact']['id']){
        $update['p_contact']['f_name'] = $_POST['f_name'];
        $update['p_contact']['f_name'] = $_POST['l_name'];
        $update['p_contact']['m_name'] = $_POST['m_name'];
        $update['p_contact']['suf'] = $_POST['suf'];
        $update['p_contact']['m_phone'] = $_POST['m_phone'];
        $update['p_contact']['w_name'] = $_POST['w_contact'];
        $update['p_contact']['mail'] = $_POST['mail'];
        $update['p_contact']['fax'] = $_POST['fax'];
        
        update_generic($conn, 'pro_contact', $update['p_contact']['id'], $update['p_contact']);
    }
    
    if($_POST['program']['id']){
        $update['program']['agency'] = $update['agency']['id'];
        $update['program']['addr'] = $update['addr']['id'];
        $update['program']['name'] = $update;
        $update['program']['p_contact'] = $update['p_contact']['id'];
        $update['program']['s_contact'] = $update['s_contact']['id'];
        $update['program']['descript'];
        $update['program']['referal'] = $_POST['ref_type'];
        $update['program']['notes'];
        $update['program']['duration'];
        
        update_generic($conn, 'program', $_POST['program']['id'], $_POST['program']);
    }
    
    if($_POST['student_contact']['id']){
        $update['s_contact']['f_name'] = $_POST['s_f_name'];
        $update['s_contact']['f_name'] = $_POST['s_l_name'];
        $update['s_contact']['m_name'] = $_POST['s_m_name'];
        $update['s_contact']['suf'] = $_POST['s_suf'];
        $update['s_contact']['m_phone'] = $_POST['s_m_phone'];
        $update['s_contact']['w_name'] = $_POST['s_w_contact'];
        $update['s_contact']['mail'] = $_POST['s_mail'];
        
        update_generic($conn, 'student_contact',$_POST['s_contact']['id'], $_POST['s_contact']);
    }
    
    if($_POST['season']['id']){
        $update['season'] = array();
        if($_POST['winter']){array_push($update['season'], $_POST['winter']);}
        if($_POST['spring']){array_push($update['season'], $_POST['spring']);}
        if($_POST['summer']){array_push($update['season'], $_POST['summer']);}
        if($_POST['fall']){ array_push($update['season'], $_POST['fall']);}
        
        update_season($conn, $update['program']['id'], $update['season']);
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
