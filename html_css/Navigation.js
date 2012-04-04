// JavaScript Document

function hidestuff(boxid){
   	document.getElementById(boxid).style.visibility="hidden";
  	document.getElementById(boxid).style.position= "absolute";
  	document.getElementById(boxid).style.display="none";
}
function showstuff(boxid){
  	document.getElementById(boxid).style.visibility="visible";
	document.getElementById(boxid).style.position= "relative";
	document.getElementById(boxid).style.display="block";
}
function searchtoresults()
{
	showstuff('results');
	hidestuff('interests');	
}
function backtosearch()
{
	showstuff('interests');
	hidestuff('results');
}
function clearChoices()
{
	 document.getElementById('form1').reset();
	 document.getElementById('form3').reset();
}

function login()
{
	location.href='file:///C:/Users/Karen/GIVECenter/html_css/HomepageJS.html';
}