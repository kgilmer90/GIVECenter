<?php
/*
 * import_give.php
 * 
 * program will read in data from 
 * import_me.csv 
 * and then pass it into the give database
 */

$db_host="localhost"; 
$db_user="root";
$db_pass="2poopy";

mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db("give_ctr_agencies");

$fh = fopen("import.csv", 'r') or
		die("File not opened! lol");

$agency[0]=NULL;
$agency_num=0;
$line_number = 1;

//	Read input from File
while($line = fgets($fh))
{
	//	Array holds exploded items, with index keeping track of association
	$items[0]="";
	$index = 0;
	array_pad($items,17,NULL);
	
	//	Break of Line to match CSV, separating fields
	$input = explode(',',$line);

	//	Set exploded into the new array on each iteration
	foreach($input as $temp)
	{
		$items[$index] = $temp;
		$index++;
	}
	
	//	Agency array holds unique array names and replaces the duplicates with 0's
	if (in_array($items[0],$agency))
	{
		$agency[$agency_num]=$items[0];
		$query1 = "INSERT INTO agency(name)VALUES('$agency[$agency_num]')";
	}
	//	agency_num holds the number of agencies and will be used for association with the correct agency
	else
	{
		$agency[$agency_num]=0;
		$query1 = "INSERT INTO agency(name)VALUES(".$items[0].")";
		$agency_num ++;
	}
	
	//	The rest of the queries for inserting data
	$query2 = "INSERT INTO program(name,desript,season,times,issues,notes,ref,agency)
				VALUES($items[1],$items[2],$items[3],$items[4],$items[5],$items[6],$items[7],$agency_num)";
	$query3 = "INSERT INTO student_contact(mail)
				VALUES($items[8])";	
	$query4 = "INSERT INTO pro_contact(title,f_name,m_name,l_name,suf,w_phone,m_phone,mail,program_id)
				VALUES($items[9],$items[10],$items[11],$items[12],$items[13],$items[14],$items[15],$items[16],$line_number)";
	$query5 = "INSERT INTO agency_addr(street)
				VALUES($items[17])";
				
	echo $query1."<br/>";
	echo $query2."<br/>";
	echo $query3."<br/>";
	echo $query4."<br/>";
	echo $query5."<br/>";
				
	//	Insert the data into the database
	mysql_query($query1) or
		die("query1 failed on $line_number ".mysql_error());	
	mysql_query($query2) or
		die("query2 failed on $line_number ".mysql_error());
//	mysql_query($query3) or
//		die("query3 failed on $line_number ".mysql_error());
	mysql_query($query4) or
		die("query4 failed on $line_number ".mysql_error());
	mysql_query($query5) or
		die("query5 failed on $line_number ".mysql_error());
		
	$line_number++;			
}
fclose($fh);

/*
$agency = compact("name");
$program = compact("name","desript","season","times","issues","notes","ref");
$student_contact = compact("mail");
$pro_contact = compact("title","f_name","m_name","l_name","suf","w_phone","m_phone","mail");
$agency_addr = compact("street");
*/
