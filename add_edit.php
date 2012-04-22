<?php
include_once('php/MySQLDatabase/MySQLDatabaseConn.php');

$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
$update = array();

//to hold various error states
$error = array();

//set to 'failed' if previous login attempt yielded no matches for the uname/pass combo
if(isset($_GET['login'])) {
	$error['login'] = $_GET['login'];
}
//set to 'true' if user was redirected to the login page via another page's logout button
if(isset($_GET['logout'])) {
	$error['logout'] = $_GET['logout'];
}
//set to 'conn' if an exception was thrown during login connecting to the database
//set to 'query' if an exception was thrown during login querying the database
if(isset($_GET['except'])) {
	$error['except'] = $_GET['except'];
}
//set to the error code resulting from an exception during login
if(isset($_GET['code'])) {
	$error['code'] = $_GET['code'];
}

/*****************************************************************************
 * Edit Condition!
 * 
 * -Checks that flag for update is set
 * -Updates the objects that have an id set
 *****************************************************************************/


if($_POST['update']){     //  EDIT CONDITION
    if($_POST['addr_id']){
        $update['addr']['id'] = $_POST['addr_id'];
        $update['addr']['street'] = $_POST['street'];
        $update['addr']['city'] = $_POST['city'];
        $update['addr']['state_us'] = $_POST['state_us'];
        $update['addr']['zip'] = $_POST['zip'];
        
        update_generic($conn, 'addr', $_POST['addr']['id'], $update['addr']);
    }
    
    if($_POST['agency_id']){
        $update['agency']['name'] = $_POST;
        $update['agency']['descript'] = $_POST;
        $update['agency']['p_contact'] = $_POST;
        $update['agency']['addr'] = $_POST;
        $update['agency']['mail'] = $_POST;
        $update['agency']['phone'] = $_POST;
        $update['agency']['fax'] = $_POST;
   
        update_generic($conn, 'agency', $_POST['agency']['id'], $_POST['agency']);
    }
    
    if($_POST['hours_id']){
        $update['hours'] = array();
        if($_POST['Hours_0']){array_push($update['hours'], $_POST['Hours_0']);}
        if($_POST['Hours_1']){array_push($update['hours'], $_POST['Hours_1']);}
        if($_POST['Hours_2']){array_push($update['hours'], $_POST['Hours_2']);}
        if($_POST['Hours_3']){array_push($update['hours'], $_POST['Hours_3']);}
        update_hours($conn, $_POST['program_id'], $_POST['hours']);
    }
    
    if($_POST['issues_id']){
        update_issues($conn, $_POST['selectInterests']);
    }
    
    if($_POST['p_contact_id']){
        $update['p_contact']['f_name'] = $_POST['f_name'];
        $update['p_contact']['f_name'] = $_POST['l_name'];
        $update['p_contact']['m_name'] = $_POST['m_name'];
        $update['p_contact']['suf'] = $_POST['suf'];
        $update['p_contact']['m_phone'] = $_POST['m_phone'];
        $update['p_contact']['w_name'] = $_POST['w_contact'];
        $update['p_contact']['mail'] = $_POST['mail'];
        $update['p_contact']['fax'] = $_POST['fax'];
        
        update_generic($conn, 'pro_contact', $_POST['program_id'], $update['p_contact']);
    }
    
    if($_POST['program_id']){
        $update['program']['agency'] = $update['agency']['id'];
        $update['program']['addr'] = $update['addr']['id'];
        $update['program']['name'] = $update;
        $update['program']['p_contact'] = $update['p_contact']['id'];
        $update['program']['s_contact'] = $update['s_contact']['id'];
        $update['program']['descript'];
        $update['program']['referal'] = $_POST['ref_type'];
        $update['program']['notes'];
        $update['program']['duration'];
        
        update_generic($conn, 'program', $_POST['program_id'], $_POST['program']);
    }
    
    if($_POST['student_contact_id']){
        $update['s_contact']['f_name'] = $_POST['s_f_name'];
        $update['s_contact']['f_name'] = $_POST['s_l_name'];
        $update['s_contact']['m_name'] = $_POST['s_m_name'];
        $update['s_contact']['suf'] = $_POST['s_suf'];
        $update['s_contact']['m_phone'] = $_POST['s_m_phone'];
        $update['s_contact']['w_name'] = $_POST['s_w_contact'];
        $update['s_contact']['mail'] = $_POST['s_mail'];
        
        update_generic($conn, 'student_contact',$_POST['s_contact']['id'], $_POST['s_contact']);
    }
    
    if($_POST['season_id']){
        $update['season'] = array();
        if($_POST['winter']){array_push($update['season'], $_POST['winter']);}
        if($_POST['spring']){array_push($update['season'], $_POST['spring']);}
        if($_POST['summer']){array_push($update['season'], $_POST['summer']);}
        if($_POST['fall']){ array_push($update['season'], $_POST['fall']);}
        
        update_season($conn, $_POST['program_id'], $update['season']);
    }
}

/*****************************************************************************
 * Add Condition!
 * 
 * -Checks that the values are set before setting them, so that only the
 *      minimal number of calls are made
 * -Program however uses the name inside program to prevent false positives,
 *      as some will set values inside program in case that a program
 *      needs to be created
 *****************************************************************************/


elseif ($_POST['add']){     
    if($_POST['addr']){
        //  Need to return addr id
        $update['addr']['id'] = $_POST['addr_id'];
        $update['addr']['street'] = $_POST['street'];
        $update['addr']['city'] = $_POST['city'];
        $update['addr']['state_us'] = $_POST['state_us'];
        $update['addr']['zip'] = $_POST['zip'];
        
        $addr_id = create_new_addr($conn, $update['addr']);
        $update['program']['addr'] = $addr_id;
    }
    if($_POST['agency']){
        $update['agency']['name'] = $_POST;
        $update['agency']['descript'] = $_POST;
        $update['agency']['p_contact'] = $_POST;
        $update['agency']['addr'] = $_POST;
        $update['agency']['mail'] = $_POST;
        $update['agency']['phone'] = $_POST;
        $update['agency']['fax'] = $_POST;
        
        $agency_id = create_new_agency($conn, $update['agency']);
        $update['program']['agency'] = $agency_id;
    }
    if($_POST['hours']){
        if($_POST['Hours_0']){array_push($update['hours'], $_POST['Hours_0']);}
        if($_POST['Hours_1']){array_push($update['hours'], $_POST['Hours_1']);}
        if($_POST['Hours_2']){array_push($update['hours'], $_POST['Hours_2']);}
        if($_POST['Hours_3']){array_push($update['hours'], $_POST['Hours_3']);}
        
        create_new_hours($conn, $_POST['program_id'], $update['hours']);
    }
    if($_POST['issue']){
        create_new_issue($conn, $_POST['program_id'], $_POST['selectInterests']);
    }
    if($_POST['pro_contact']){
        $update['p_contact']['f_name'] = $_POST['f_name'];
        $update['p_contact']['f_name'] = $_POST['l_name'];
        $update['p_contact']['m_name'] = $_POST['m_name'];
        $update['p_contact']['suf'] = $_POST['suf'];
        $update['p_contact']['m_phone'] = $_POST['m_phone'];
        $update['p_contact']['w_name'] = $_POST['w_contact'];
        $update['p_contact']['mail'] = $_POST['mail'];
        $update['p_contact']['fax'] = $_POST['fax'];
        
        $p_id = create_new_p_contact($conn, $update['pro_contact']);
        $update['program']['p_contact'] = $p_id;
    }
    if($_POST['student_contact']){
        $update['s_contact']['f_name'] = $_POST['s_f_name'];
        $update['s_contact']['f_name'] = $_POST['s_l_name'];
        $update['s_contact']['m_name'] = $_POST['s_m_name'];
        $update['s_contact']['suf'] = $_POST['s_suf'];
        $update['s_contact']['m_phone'] = $_POST['s_m_phone'];
        $update['s_contact']['w_name'] = $_POST['s_w_contact'];
        $update['s_contact']['mail'] = $_POST['s_mail'];
        
        $s_id = create_new_s_contact($conn, $update['s_contact'], $_POST['program_id']);
        $update['program']['s_contact'] = $s_id;
    }
    if($_POST['seasons']){
        if($_POST['winter']){array_push($update['season'], $_POST['winter']);}
        if($_POST['spring']){array_push($update['season'], $_POST['spring']);}
        if($_POST['summer']){array_push($update['season'], $_POST['summer']);}
        if($_POST['fall']){ array_push($update['season'], $_POST['fall']);}
        
        create_new_seasons($conn,$_POST['program_id'], $update['season']);
    }
    if($_POST['program']['name']){
        $update['program']['agency'] = $update['agency']['id'];
        $update['program']['addr'] = $update['addr']['id'];
        $update['program']['name'] = $update;
        $update['program']['p_contact'] = $update['p_contact']['id'];
        $update['program']['s_contact'] = $update['s_contact']['id'];
        $update['program']['descript'];
        $update['program']['referal'] = $_POST['ref_type'];
        $update['program']['notes'];
        $update['program']['duration'];
        
        create_new_program_existing_agency($conn, $update['program']);
    }
}

header('Location: EditPage.php');

?>
