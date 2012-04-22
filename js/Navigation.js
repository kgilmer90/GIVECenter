// JavaScript Document

var agencies = [];		//global agencies array, contains all agencies
var programs = [];		//global programs array, contains all programs
var issues = [];		//global issues array, contains all issues

var agency_search_results = [];
var program_search_results = [];

var DISPLAY_INTERESTS = 0;
var DISPLAY_RESULTS = 1;
var display_mode = DISPLAY_INTERESTS;

var LEFT_SIDEBAR_AGENCY = 0;
var LEFT_SIDEBAR_PROGRAM = 1;
var left_sidebar_display = LEFT_SIDEBAR_AGENCY;

function hidestuff(boxid){
	
	if(boxid == 'results') {
		display_mode = DISPLAY_INTERESTS;
	}
	else if(boxid == 'interests') {
		display_mode = DISPLAY_RESULTS;
	}
	var e = document.getElementById(boxid);
	e.style.visibility = "hidden";
  	e.style.position = "absolute";
  	e.style.display = "none";
}
function showstuff(boxid){
	
	if(boxid == 'results') {
		display_mode = DISPLAY_RESULTS;
	}
	else if(boxid == 'interests') {
		display_mode = DISPLAY_INTERESTS;
	}

	var e = document.getElementById(boxid);
	e.style.visibility="visible";
	e.style.position= "relative";
	e.style.display="block";
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

function init()
{
	initAgenciesAndPrograms();
	initIssues();
	
	left_sidebar_display = LEFT_SIDEBAR_AGENCY;
	clearLeftSideBar();
	addAgenciesToLeftSideBar(agency_search_results);
	
	showstuff('interests');
	hidestuff('results');
}

//**************************************************
////////////////////////////////////////////////////
//
//		GIVE AGENCY AND PROGRAM SEARCHING
//
////////////////////////////////////////////////////
//**************************************************

/**
 * Search one string for another.
 * @param stringToSearch - string being searched
 * @param searchTerms - string to see if stringToSearch contains
 * @returns starting index of searchTerms in stringToSearch or -1 if not found
 */
function stringSearch(stringToSearch, searchTerms) {
	return stringToSearch.indexOf(searchTerms);
}

/**
 * Search one string for another regardless of upper or lower case.
 * @param stringToSearch - string being searched
 * @param searchTerms - string to see if stringToSearch contains
 * @returns starting index of searchTerms in stringToSearch or -1 if not found
 */
function caseInsensitiveStringSearch(stringToSearch, searchTerms) {
	var s = stringToSearch.toLowerCase();
	var t = searchTerms.toLowerCase();
	return stringSearch(s, t);
}
/**
 * QuickSearch, searches by program or agency name/description
 * @returns false - so the form submit doesn't reload the page
 */
function quickSearch() {
	if(left_sidebar_display == LEFT_SIDEBAR_AGENCY) {
		searchAgency(document.getElementById('searchBar').value);
		
		clearLeftSideBar();
		addProgramsToLeftSideBar(program_search_results);
		if(program_search_results.length > 0) {
			displayProgramInfo(program_search_results[0]);
		}	
	}
	else if(left_sidebar_display == LEFT_SIDEBAR_PROGRAM) {
		searchProgram(document.getElementById('searchBar').value);
		
		clearLeftSideBar();
		addAgenciesToLeftSideBar(agency_search_results);
		if(agency_search_results.length > 0) {
			displayAgencyInfo(agency_search_results[0]);
		}
	}
	return false;
}
/**
 * AdvancedSearch, searches by selected interests
 * @returns false - so the form submit doesn't reload the page
 */
function advancedSearch() {
	var matching_issue_ids = [];
	
	var matching_agency_indices = [];
	var matching_program_indices = [];
	
	//collect all selected issue ids
	var i, j, k;
	for(i in issues) {
		var issue = issues[i];
		var checkbox = document.getElementById(issue.name);
		
		if(checkbox.checked) {
			matching_issue_ids.push(issue.id);
		}
	}
	
	//loop through each program's issues array
	//if program contains an issue id equal to a checked issue id,
	//add program's array index to matches
	for(i in matching_issue_ids) {
		var issue = matching_issue_ids[i];
		for(j in programs) {
			var p = programs[j];	
			for(k in p.issues) {
				var p_issue = p.issues[k];
				if(issue == p_issue) {
					matching_program_indices.push(j);
					break;
				}
			}
		}
	}
	//loop through each matching program
	//add program's agency index to matches
	for(i in matching_program_indices) {
		var index = matching_program_indices[i];
		var program = programs[index];
		for(j in agencies) {
			var agency = agencies[j];
			if(agency == program.agency) {
				matching_agency_indices.push(j);
			}
		}
	}
	agency_search_results = matching_agency_indices;
	program_search_results = matching_program_indices;

	clearLeftSideBar();
	addProgramsToLeftSideBar(program_search_results);
	if(program_search_results.length > 0) {
		displayProgramInfo(program_search_results[0]);
	}
	
	return false;
}
/**
 * Matches a search string to a list of programs whose names
 * contain the string. Search is case insensitive.
 * @param searchTerms - search string
 * @returns GIVEProgram array of programs whose names match the terms
 */
function searchProgram(searchTerms) {
	
	var matching_program_indices = [];
	
	if(!searchTerms) {
		searchTerms = '';
	}
	
	if(searchTerms == '') {
		var i;
		for(i in programs) {
			matching_program_indices.push(i);
		}
	}
	else
	{
		var i;
		for(i in programs) {
			
			//GIVEProgram reference and program name
			var p = programs[i];
			
			//if name contains the search terms anywhere in the string,
			//add the program to the list of search results
			if(caseInsensitiveStringSearch(p.name, searchTerms) >= 0) {
				matching_program_indices.push(i);
			}
			else if(p.descript) {
				if(caseInsensitiveStringSearch(p.descript, searchTerms) >= 0) {
					matching_program_indices.push(i);
				}
			}
		}
	}
	/*
	clearLeftSideBar();
	addProgramsToLeftSideBar(matching_program_indices);
	if(matching_program_indices.length > 0) {
		displayProgramInfo(matching_program_indices[0]);
	}
	 */
	program_search_results = matching_program_indices;
}

/**
 * Matches a search string to a list of agencies whose names
 * contain the string. Search is case insensitive.
 * @param searchTerms - search string
 * @returns GIVEAgency array of agencies whose names match the terms
 */
function searchAgency(searchTerms) {
	
	var matching_agency_indices = [];
	
	if(!searchTerms) {
		searchTerms = '';
	}
	
	if(searchTerms == '') {
		var i;
		for(i in agencies) {
			matching_agency_indices.push(i);
		}
	}
	else
	{
		var i;
		for(i in agencies) {
			
			//GIVEAgency reference and name
			var a = agencies[i];
			
			//if name contains the search terms anywhere in the string,
			//add the program to the list of search results
			if(caseInsensitiveStringSearch(a.name, searchTerms) >= 0) {
				matching_agency_indices.push(i);
			}
			else if(a.descript) {
				if(caseInsensitiveStringSearch(a.descript, searchTerms) >= 0) {
					matching_agency_indices.push(i);
				}
			}
		}
	}
	/*
	clearLeftSideBar();
	addAgenciesToLeftSideBar(matching_agency_indices);
	if(matching_agency_indices.length > 0) {
		displayAgencyInfo(matching_agency_indices[0]);
	}
	*/
	agency_search_results = matching_agency_indices;
}

/**
 * Removes a node from the DOM tree. First removes all 
 * event handlers to prevent memory leaks in IE, then
 * removes the node itself.
 * @param node - reference to the DOM node to remove
 */
function removeNode(node) {
	
	//set all event handlers null to avoid memory leaks in IE
	node.onclick = null;
	node.ondblclick = null;
	node.onmousedown = null;
	node.onmousemove = null;	
	node.onmouseover = null;
	node.onmouseout = null;
	node.onmouseup = null;
	node.onkeydown = null;
	node.onkeypress = null;
	node.onkeyup = null;
	
	//remove the node from the DOM tree
	node.parentNode.removeChild(node);
}

/**
 * Removes all elements from the left side bar.
 */
function clearLeftSideBar() {
	
	var leftSideBar = document.getElementById("leftSideBar");
	
	while(leftSideBar.hasChildNodes()) {
		removeNode(leftSideBar.childNodes[0]);
	}
}
/**
 * Displays the information contained within a GIVEProgram object at a specified index.
 * @param index - index in the global programs array where the 
 * GIVEProgram object can be found.
 */
function displayProgramInfo(index) {
	
	//valid index
	if(index < programs.length) {
		//switch display mode so program info is visible
		if(display_mode != DISPLAY_RESULTS) {
			searchtoresults();
		}
		var p = programs[index];
		
		document.getElementById("display_name").innerHTML = (p.name) ? p.name : "";
		document.getElementById("display_descript").innerHTML = (p.descript) ? p.descript : "";
		
		var pcon = p.p_contact;
		var scon = p.s_contact;
		var addr = p.addr;
		
		var str = (pcon.title) ? pcon.title + " " : "";
		str += (pcon.f_name) ? pcon.f_name + " " : "";
		str += (pcon.m_name) ? pcon.m_name + " " : "";
		str += (pcon.l_name) ? pcon.l_name + " " : "";
		
		document.getElementById("display_p_contact_name").innerHTML = str; 
		
		document.getElementById("display_p_contact_m_phone").innerHTML = (pcon.m_phone) ? pcon.m_phone : "";
		document.getElementById("display_p_contact_w_phone").innerHTML = (pcon.w_phone && pcon.w_phone != 0) ? pcon.w_phone : "";
		document.getElementById("display_p_contact_mail").innerHTML = (pcon.mail) ? pcon.mail : "";
		document.getElementById("display_p_contact_fax").innerHTML = (pcon.fax) ? pcon.fax : "";
		
		str = (addr.city) ? addr.city : "";
		str += (str && addr.state_us) ? ", " + addr.state_us : "";
		str += (str && addr.zip) ? " " + addr.zip : "";
		
		document.getElementById("display_address_street").innerHTML = (addr.street) ? addr.street : "";
		document.getElementById("display_address_city").innerHTML = str;
		
		document.getElementById("display_s_contact_m_phone").innerHTML = (scon.m_phone) ? scon.m_phone : "";
		document.getElementById("display_s_contact_w_phone").innerHTML = (scon.w_phone && scon.w_phone != 0) ? scon.w_phone : "";
		document.getElementById("display_s_contact_mail").innerHTML = (scon.mail) ? scon.mail : "";
		document.getElementById("display_s_contact_fax").innerHTML = (scon.fax) ? scon.fax : "";
	}
}

/**
 * Displays the information contained within the GIVEAgency object at a specified index.
 * @param index - index in the global agencies array where the 
 * GIVEAgency object can be found.
 */
function displayAgencyInfo(index) {
	if(index < agencies.length) {
		//switch display mode so program info is visible
		if(display_mode != DISPLAY_RESULTS) {
			searchtoresults();
		}
		var a = agencies[index];
		
		document.getElementById("display_name").innerHTML = (a.name) ? a.name : "";
		document.getElementById("display_descript").innerHTML = (a.descript) ? a.descript : "";
		
		var pcon = a.p_contact;
		
		var str = (pcon.title) ? pcon.title + " " : "";
		str += (pcon.f_name) ? pcon.f_name + " " : "";
		str += (pcon.m_name) ? pcon.m_name + " " : "";
		str += (pcon.l_name) ? pcon.l_name + " " : "";
		
		document.getElementById("display_p_contact_name").innerHTML = str; 
		
		document.getElementById("display_p_contact_m_phone").innerHTML = (pcon.m_phone) ? pcon.m_phone : "";
		document.getElementById("display_p_contact_w_phone").innerHTML = (pcon.w_phone && pcon.w_phone != 0) ? pcon.w_phone : "";
		document.getElementById("display_p_contact_mail").innerHTML = (pcon.mail) ? pcon.mail : "";
		document.getElementById("display_p_contact_fax").innerHTML = (pcon.fax) ? pcon.fax : "";

	}
}

/**
 * Toggles between displaying programs on the left
 * side bar and agencies.
 */
function toggleLeftSideBarDisplay() {
	if(left_sidebar_display == LEFT_SIDEBAR_AGENCY) {
		left_sidebar_display = LEFT_SIDEBAR_PROGRAM;
		document.getElementById('toggle').innerHTML = 'View Agencies';
		
		clearLeftSideBar();
		addProgramsToLeftSideBar(program_search_results);
		if(program_search_results.length > 0) {
			displayProgramInfo(program_search_results[0]);
		}	
	}
	else if(left_sidebar_display == LEFT_SIDEBAR_PROGRAM) {
		left_sidebar_display = LEFT_SIDEBAR_AGENCY;
		document.getElementById('toggle').innerHTML = 'View Programs';
		
		clearLeftSideBar();
		addAgenciesToLeftSideBar(agency_search_results);
		if(agency_search_results.length > 0) {
			displayAgencyInfo(agency_search_results[0]);
		}
	}
}

/**
 * Adds an array of GIVEProgram objects to the left side bar.
 * Sets the onclick handler to display the object's contents.
 * @param programIndicies - array of integers corresponding
 * to the GIVEProgram objects at indicies in the global programs array
 * to add to the sidebar
 */
function addProgramsToLeftSideBar(programIndices) {
	
	var leftSideBar = document.getElementById("leftSideBar");
	
	if(!programIndices) {
		programIndices = [];
	}
	
	if(programIndices.length == 0) {
		var a = document.createElement("a");
		a.id = "leftSideBar_program" + i;
		a.href = "javascript:void(0)";
		var t = document.createTextNode("No Matches");
		a.appendChild(t);
		var li = document.createElement("li");
		li.appendChild(a);
		leftSideBar.appendChild(li);
		return;
	}
	
	var i;
	for(i in programIndices) {
		
		var index = programIndices[i];
		var p = programs[index];
		
		//create a new <a> tag
		var a = document.createElement("a");
		
		//set the id and onclick handler
		a.id = "leftSideBar_program" + i;
		a.href = "javascript:displayProgramInfo(" + index + ")";
		
		//create text node to hold the visible description
		var t = document.createTextNode(p.name);
		a.appendChild(t);
		
		//create a new <li> tag to hold the <a> tag
		var li = document.createElement("li");
		
		//add the <a> tag as a child of <li>
		li.appendChild(a);
		
		//add the <li> tag as a child of leftSideBar
		leftSideBar.appendChild(li);
	}
}

/**
 * Adds an array of GIVEAgency objects to the left side bar.
 * Sets the onclick handler to display the object's contents.
 * @param agencyIndicies - array of integers corresponding
 * to the GIVEAgency objects at indices in the global agencies array
 * to add to the sidebar
 */
function addAgenciesToLeftSideBar(agencyIndices) {
	
	var leftSideBar = document.getElementById("leftSideBar");
	
	if(!agencyIndices) {
		agencyIndices = [];
	}

	if(agencyIndices.length == 0) {
		var a = document.createElement("a");
		a.id = "leftSideBar_agency" + i;
		a.href = "javascript:void(0)";
		var t = document.createTextNode("No Matches");
		a.appendChild(t);
		var li = document.createElement("li");
		li.appendChild(a);
		leftSideBar.appendChild(li);
		return;
	}
	
	var i;
	for(i in agencyIndices) {
		
		var index = agencyIndices[i];
		var agency = agencies[index];
		
		//create a new <a> tag
		var a = document.createElement("a");
		
		//set the id and onclick handler
		a.id = "leftSideBar_agency" + i;
		a.href = "javascript:displayAgencyInfo(" + index + ")";
		
		//create text node to hold the visible description
		var t = document.createTextNode(agency.name);
		a.appendChild(t);
		
		//create a new <li> tag to hold the <a> tag
		var li = document.createElement("li");
		
		//add the <a> tag as a child of <li>
		li.appendChild(a);
		
		//add the <li> tag as a child of leftSideBar
		leftSideBar.appendChild(li);
	}
}

//**************************************************
////////////////////////////////////////////////////
//
//		GIVE AGENCY AND PROGRAM INITIALIZATION
//
////////////////////////////////////////////////////
//**************************************************
/**
* HTML <body> onload function.
* All database query results are stored on the page as a hidden table.
* This function parses the table and reconstructs the data as JS objects.
*/
function initAgenciesAndPrograms() {

	var i = 0;
	//get the main table and count how many <tr> tags exist (number of agencies)
	var agency_count = document.getElementById("agency_table").rows.length;
	for(i = 0; i < agency_count; i++) {
	
		//get the table for each agency and construct a GIVEAgency object from it
		var tableId = "agency" + i;
		var agency = TableIdToGIVEAgency(tableId);
		
		//add to global agencies array
		agencies.push(agency);
		agency_search_results.push(i);
		
		//each GIVEAgency contains an array of GIVEPrograms
		//add each agency's programs to the global programs array
		var j;
		for(j in agency.programs) {
			programs.push(agency.programs[j]);
			program_search_results.push(j);
		}
		i++;
	}
}
/**
 * Initializes the global issues array
 */
function initIssues() {
	issues = [
            {id:5,	name:"Alumni"},
			{id:6,	name:"Animals"},
			{id:7,	name:"Children"},
			{id:8,	name:"Disabilities"},
			{id:9,	name:"Disasters"},
			{id:10,	name:"Education"},
			{id:11,	name:"Elderly"},
			{id:12,	name:"Environment"},
			{id:13,	name:"Female Issues"},
			{id:14, name:"Fine Arts"},
			{id:15,	name:"General Service"},
			{id:16,	name:"Health"},
			{id:17,	name:"Male Issues"},
			{id:18, name:"Minority Issues"},
			{id:19,	name:"Office"},
			{id:20,	name:"Patriotic"},
			{id:21,	name:"Poverty"},
			{id:22,	name:"PR"},
			{id:23,	name:"Recreation"},
			{id:24,	name:"Religious"},
			{id:25,	name:"Service Leaders"},
			{id:26,	name:"Technology"}
			];
}
/**
* Constructs a GIVEAgency object from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns GIVEAgency object representing the table data
*/
function TableIdToGIVEAgency(table_id) {

	//retreive the DOM element within the GIVEAgency table id
	var agency_DOM_element = document.getElementById(table_id);
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var id 			= TableDataFromInnerHTML(agency_DOM_element.rows[0].innerHTML);
	var name 		= TableDataFromInnerHTML(agency_DOM_element.rows[1].innerHTML);
	var descript 	= TableDataFromInnerHTML(agency_DOM_element.rows[2].innerHTML);
	var mail 		= TableDataFromInnerHTML(agency_DOM_element.rows[3].innerHTML);
	var phone 		= TableDataFromInnerHTML(agency_DOM_element.rows[4].innerHTML);
	var fax 		= TableDataFromInnerHTML(agency_DOM_element.rows[5].innerHTML);
	
	//retrieve the DOM element for the following tables and repeat the process above
	var p_contact 	= TableIdToGIVEProContact(table_id + "_p_contact");
	var addr 		= TableIdToGIVEAddr(table_id + "_addr");
	var program_arr	= TableIdToGIVEProgramsArray(table_id + "_program");
	
	//build the complete GIVEAgency object
	var agency = new GIVEAgency(id, name, descript, mail, phone, fax, p_contact, addr, program_arr);
	
	//GIVEAgency objects contain an array of GIVEProgram objects, each of which
	//contains a reference back to its owner, the GIVEAgency object.
	//The programs in the array initially have their agency property set null,
	//so now go back and assign the agency property to the owning GIVEAgency object
	var i;
	for(i in program_arr) {
		program_arr[i].agency = agency;
	}
	return agency;
}
/**
* Constructs a GIVEAddr object from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns GIVEAddr object representing the table data
*/
function TableIdToGIVEAddr(table_id) {
	//retreive the DOM element within the GIVEAgency table id
	var addr_DOM_element = document.getElementById(table_id);
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var street 		= TableDataFromInnerHTML(addr_DOM_element.rows[0].innerHTML);
	var city 		= TableDataFromInnerHTML(addr_DOM_element.rows[1].innerHTML);
	var state_us 	= TableDataFromInnerHTML(addr_DOM_element.rows[2].innerHTML);
	var zip 		= TableDataFromInnerHTML(addr_DOM_element.rows[3].innerHTML);
	
	//build and return the complete GIVEAddr object
	return new GIVEAddr(street, city, state_us, zip);
}
/**
* Constructs a GIVEAProContact object from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns GIVEProContact object representing the table data
*/
function TableIdToGIVEProContact(table_id) {

	//retreive the DOM element within the GIVEAgency table id
	var p_contact_DOM_element = document.getElementById(table_id);
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var title 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[0].innerHTML);
	var l_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[1].innerHTML);
	var f_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[2].innerHTML);
	var m_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[3].innerHTML);
	var suf 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[4].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[5].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[6].innerHTML);
	var mail 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[7].innerHTML);
	
	//build and return the complete GIVEProContact object
	return new GIVEProContact(title, l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}
/**
* Constructs an array of GIVEProgram objects from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns array of GIVEProgram objects representing the table data
*/
function TableIdToGIVEProgramsArray(table_id) {
	var program_arr = [];
	
	var i;
	var count = document.getElementById(table_id).rows.length;
	for(i = 0; i < count; i++) {
	
	//get the table for each program and construct a GIVEProgram object from it
	var program = TableIdToGIVEProgram(table_id + i);
		program_arr.push(program);
	}
	return program_arr;
}
/**
* Constructs a GIVEAProgram object from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns GIVEProgram object representing the table data
*/
function TableIdToGIVEProgram(table_id) {

	//retreive the DOM element within the GIVEAgency table id
	var program_DOM_element = document.getElementById(table_id);
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var id 			= TableDataFromInnerHTML(program_DOM_element.rows[0].innerHTML);
	var referal 	= TableDataFromInnerHTML(program_DOM_element.rows[1].innerHTML);
	var season 		= TableDataFromInnerHTML(program_DOM_element.rows[2].innerHTML);
	var times 		= TableDataFromInnerHTML(program_DOM_element.rows[3].innerHTML);
	var name 		= TableDataFromInnerHTML(program_DOM_element.rows[4].innerHTML);
	var descript 	= TableDataFromInnerHTML(program_DOM_element.rows[5].innerHTML);
	var duration 	= TableDataFromInnerHTML(program_DOM_element.rows[6].innerHTML);
	var notes 		= TableDataFromInnerHTML(program_DOM_element.rows[7].innerHTML);
	
	//retrieve the DOM element for the following tables and repeat the process above
//	var issues 		= TableIdToIssuesArray(table_id + "_issue");
	var issues = [];
	var addr 		= TableIdToGIVEAddr(table_id + "_addr");
	var p_contact 	= TableIdToGIVEProContact(table_id + "_p_contact");
	var s_contact 	= TableIdToGIVEStudentContact(table_id + "_s_contact");
	
	//build and return the complete GIVEProgram object
	return new GIVEProgram(id, referal, season, times, name, descript, duration, notes, issues, addr, null, p_contact, s_contact);
}
/**
* Constructs a GIVEStudentContact object from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns GIVEStudentContact object representing the table data
*/
function TableIdToGIVEStudentContact(table_id) {

	//retreive the DOM element within the GIVEAgency table id
	var s_contact_DOM_element = document.getElementById(table_id);
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var l_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[0].innerHTML);
	var f_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[1].innerHTML);
	var m_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[2].innerHTML);
	var suf 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[3].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[4].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[5].innerHTML);
	var mail 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[6].innerHTML);
	
	//build and return the complete GIVEStudentContact object
	return new GIVEStudentContact(l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}
/**
* Constructs an array of string objects from a table embedded in the HTML.
* @param table_id - table's id property so that the DOM element can be retrieved
* @returns array of string objects representing the table data
*/
function TableIdToIssuesArray(table_id) {

	var issues_arr = [];
	
	//retreive the DOM element within the GIVEAgency table id
	var issue_DOM_element = document.getElementById(table_id);
	
	var i;
	var count = issue_DOM_element.rows.length;
	for(i = 0; i < count; i++) {
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var issue = TableDataFromInnerHTML(issue_DOM_element.rows[i].innerHTML);
		issues_arr.push(issue);
	}
	return issues_arr;
}
/**
* In most cases, content within <td> </td> tags could not be extracted
* without also including the tags. This function strips off the <td> </td>
* tags and returns the inner data.
* @param innerHTML - string of the form "<td property1=value1 ... propertyN=valueN>innerText</td>"
* @returns inner text content of the <td> </td> tag
*/
function TableDataFromInnerHTML(innerHTML) {
	if(!innerHTML) {
		return null;
	}
	
	//<td prop1=value1 ... propN=valueN>text I actually care about</td>
	var pattern = "\<td (.+?)\>(.+?)\<\/td\>";
	var regex = new RegExp(pattern, "i");
	var matches = innerHTML.match(pattern);
	
	if(!matches) {
		return null;
	}
	
	//matches[0] = whole string
	//matches[1] = text between "<td" and the closing ">"
	//matches[2] = text between "<td ...>" and "</td>"
	return matches[2];
}

//**************************************************
////////////////////////////////////////////////////
//
//			GIVE OBJECT DEFINITIONS
//
////////////////////////////////////////////////////
//**************************************************

/**
* GIVEAddr object creation function, represents an address
* @param int id - numeric identifier
* @param string street - street location
* @param string city - city location
* @param string state - state location
* @param string zip - US zipcode
* @return GIVEAddr object with fields initialized to function arguments
*/
function GIVEAddr(street, city, state, zip) {
	var addr = {
		street 		: street,
		city 		: city,
		state_us 	: state,
		zip 		: zip,
		toString : function() {
			return "street=" + this.street + 
			",city=" + this.city + ",state_us=" + this.state_us + 
			",zip=" + this.zip;
		}
	};
	return addr;
}
/**
* GIVEAgency object creation function, represents an agency that
* hosts at least one program with the GIVE Center
* @param int id - numeric identifier
* @param string name - agency name
* @param string descript - agency description
* @param string mail - agency email
* @param string phone - agency phone number
* @param string fax - agency fax number
* @param GIVEProContact p_contact - agency professional contact
* @param GIVEAddr addr - agency address
* @return GIVEAgency object with fields initialized to function arguments
*/
function GIVEAgency(id, name, descript, mail, phone, fax, p_contact, addr, programs) {
	var agency = {
		id 			: id, 
		name		: name, 
		descript	: descript, 
		mail		: mail, 
		phone		: phone, 
		fax			: fax,
		p_contact	: p_contact,
		addr		: addr,
		programs	: programs,
		toString	: function() {
			var str = "id=" + this.id + ",name=" + this.name + ",descript=" + 
				this.descript + ",mail=" + this.mail + ",phone=" + this.phone + 
				",fax=" + this.fax + "<br />" + this.p_contact + "<br />" + this.addr +
				"<br />";
			
			var i;
			for(i in this.programs) {
				str += "program" + i + "=" + this.programs[i] + "<br />";
			}
			return str;
		}
	};
	return agency;
}
/**
* GIVEProContact object creation function, represents the contact information
* for a GIVEProgram's professional contact person.
* @param int id - numeric identifier
* @param string title - contact person's title (director, chair, etc.)
* @param string l_name - contact person's last name
* @param string f_name - contact person's first name
* @param string m_name - contact person's middle name 
* @param string suf - contact person's suffix (Mr, Ms, Mrs)
* @param string w_phone - contact person's work phone number
* @param string m_phone - contact person's mobile phone number
* @param string mail - contact person's email address
* @return GIVEProContact object with fields initialized to function arguments
*/
function GIVEProContact(title, l_name, f_name, m_name, suf, w_phone, m_phone, mail) {
	var pcon = {
		title 	: title,
		l_name 	: l_name,
		f_name	: f_name,
		m_name	: m_name,
		suf 	: suf,
		w_phone	: w_phone, 
		m_phone	: m_phone,
		mail	: mail,
		toString : function() {
			return "title=" + this.title + ",l_name=" + this.l_name + ",f_name=" + 
			this.f_name + ",m_name=" + this.m_name + ",suf=" + this.suf + ",w_phone=" +
			this.w_phone + ",m_phone=" + this.m_phone + ",mail=" + this.mail;
		}
	};
	return pcon;
}
/**
* GIVEProgram object creation function, represents a program hosted by an agency
* @param int id - numeric identifier
* @param bool referal - whether the program requires a referal
* @param int season - seasons of the year the program is active
* @param int times - time of the day volunteers are able to participate
* @param string name - name of the program
* @param string descript - program description
* @param string duration - program duration
* @param string notes - additional notes
* @param string[] issues - array of issue keywords that may attract volunteers
* @param GIVEAddr addr - program location
* @param GIVEAgency agency - hosting agency
* @param GIVEProContact p_contact - program's professional contact person
* @param GIVEStudentContact s_contact - program's student contact person
* @return GIVEProgram object with fields initialized to function arguments
*/
function GIVEProgram (id, referal, season, hours, name, descript, duration, notes, issues, addr, agency, p_contact, s_contact) {
	var program = {
		id 			: id,
		referal		: referal,
		season		: season,
		hours		: hours,
		name		: name, 
		descript	: descript,
		duration	: duration,
		notes		: notes,
		issues		: issues,
		addr		: addr,
		agency		: agency,
		p_contact	: p_contact,
		s_contact	: s_contact,
		toString 	: function() {
			
			var str = "id=" + this.id + ",referal=" + this.referal + 
				",season=" + this.season + ",hours=" + this.hours+ ",name=" + 
				this.name + ",descript=" + this.descript + ",duration=" + 
				this.duration + ",notes=" + this.notes + "<br />";
	
			var i;
			for(i in issues) {
				str += "issue" + i + "=" + issues[i] + ",";
			}
			str += "<br />";
			
			str += this.addr + "<br />" + this.p_contact + "<br />" + this.s_contact;
			return str;
		}
	};
	return program;
}
/**
* GIVEStudentContact object creation function, represents the contact information
* for a GIVEProgram's student contact person.
* @param int id - numeric identifier
* @param string l_name - contact person's last name
* @param string f_name - contact person's first name
* @param string m_name - contact person's middle name 
* @param string suf - contact person's suffix (Mr, Ms, Mrs)
* @param string w_phone - contact person's work phone number
* @param string m_phone - contact person's mobile phone number
* @param string mail - contact person's email address
* @return GIVEStudentContact object with fields initialized to function arguments
*/
function GIVEStudentContact(l_name, f_name, m_name, suf, w_phone, m_phone, mail) {
	var scon = {
		l_name 	: l_name,
		f_name	: f_name,
		m_name	: m_name,
		suf 	: suf,
		w_phone	: w_phone, 
		m_phone	: m_phone,
		mail	: mail,
		toString : function() {
			return "l_name=" + this.l_name + ",f_name=" + this.f_name + 
			",m_name=" + this.m_name + ",suf=" + this.suf + ",w_phone=" +
			this.w_phone + ",m_phone" + this.m_phone + ",mail=" + this.mail;
		}
	};
	return scon;
}