/**
* All client-side code for the software. Contains functions for parsing the
* hidden HTML table and rebuilding the data into JS objects, functions for
* showing and hiding elements on screen as needed, and functions for filling
* out various forms with all available information.
*/

var agencies = [];		//global agencies array, contains all agencies
var programs = [];		//global programs array, contains all programs
var issues = [];		//global issues array, contains all issues
var referal = { limited:0, full:1 }; 	//referal type

//global hours array, contains all hours a program can require volunteers to dedicate
//hours ids start at 1 so fill in index 0 with no data
var hours = [0, 'Morning', 'Afternoon', 'Evening', 'Night', 'Graveyard'];

//global seasons array, contains all seasons a program can be active
//season ids start at 1 so fill in index 0 with no data
var seasons = [0, 'Spring', 'Summer', 'Fall', 'Winter'];

//previous quick or advanced search results, used to toggle 
//between the left sidebar displaying agencies or programs
//without having to perform the search all over again
var agency_search_results = [];
var program_search_results = [];

//display_mode is used to tell if the page is currently displaying the
//advanced search checkboxes (interests) or the search results
var DISPLAY_INTERESTS = 0;
var DISPLAY_RESULTS = 1;
var display_mode = DISPLAY_INTERESTS;

//left_sidebar_display is used to tell if the left sidebar is currently
//set to display programs or agencies
var LEFT_SIDEBAR_AGENCY = 0;
var LEFT_SIDEBAR_PROGRAM = 1;
var left_sidebar_display = LEFT_SIDEBAR_AGENCY;

/**
 * Called in Admin.php to set up the edit page to edit a
 * database entry for an Agency
 */
function editAgency() {
	var getID = document.getElementById("agencyDropdown").selectedIndex;
	location = "EditPage.php?mode=edit&what=agency&id="+ getID;
}
/**
 * Called in Admin.php to set up the edit page to edit a
 * database entry for a Program
 */
function editProgram() {
	var getID = document.getElementById("programDropdown").selectedIndex;
	location = "EditPage.php?mode=edit&what=program&id="+ getID;
}
/**
 * Called in Admin.php to set up the edit page to add a new 
 * database entry for an Agency
 */
function addAgency() {
	location = "EditPage.php?mode=add&what=agency";
}
/**
 * Called in Admin.php to set up the edit page to add a new 
 * database entry for a Program
 */
function addProgram() {
	location = "EditPage.php?mode=add&what=program";
}
/**
 * Called on Add/Edit pages to delete a database entry for an Agency or Program
 */
function deleteAgencyOrProgram() {
	
	var r = confirm("Are you sure you want to permanently DELETE this program/agency?");
	document.getElementById('editDBform').action = 'sql/remove/super_remover.php';
	return r;
}
/**
 * Called onload on the edit page. Fills in the form with all
 * available info about the Agency or Program
 * @param mode - "add" or "edit"
 * @param what - "program" or "agency"
 * @param id - index of the program or agency in its respective global array
 */
function loadEditPage(mode, what, id) { //onload editPage

	initIssues();
	initAgenciesAndPrograms();
	
	if(mode == 'none' || what == 'none' || !mode || !what) {
		return;
	}
	
	if(mode == "edit")
	{
		if(what == "program") //edit program
		{
			//set the descriptive headers
			document.getElementById("editHeader").innerHTML = "Edit Program";
			document.getElementById("agencyDescrip").style.visibility="visible";
			document.getElementById("agencyOpt").style.visibility="visible";
			document.getElementById("agencyDescrip").style.display="block";
			document.getElementById("agencyOpt").style.display="block";
			
			//display pro contact info
			document.getElementById("s_contact_label").style.visibility="visible";
			document.getElementById("s_contact_table").style.visibility="visible";
			document.getElementById("s_contact_label").style.display="block";
			document.getElementById("s_contact_table").style.display="block";
			
			// hide agency contact info
			document.getElementById("agency_contact_label").style.visibility="hidden";
			document.getElementById("agency_contact_table").style.visibility="hidden";
			document.getElementById("agency_contact_label").style.display="none";
			document.getElementById("agency_contact_table").style.display="none";
			
			//display checkboxes
			document.getElementById("getInterests").style.visibility="visible";
			document.getElementById("getInterests").style.display="block";
			document.getElementById("column3").style.visibility="visible";
			document.getElementById("column3").style.display="block";
			document.getElementById("column4").style.visibility="visible";
			document.getElementById("column4").style.display="block";
			
			//display notes & ref types
			document.getElementById("notesBox").style.visibility="visible";
			document.getElementById("notesLabel").style.visibility="visible";
			document.getElementById("notesBox").style.display="block";
			document.getElementById("notesLabel").style.display="block";
			document.getElementById("refTypes").style.visibility="visible";
			document.getElementById("refTypes").style.display="block";
			
			
			//fill the dropdown menu and set the selected index to the program index
			addAgenciesToEditPageDropdown(id);
			//fill the form with all the available information
			fillEditPageForm('program', 'edit', id);
		}
		else //edit agency
		{
			//set the descriptive headers
			document.getElementById("editHeader").innerHTML = "Edit Agency";
			document.getElementById("agencyDescrip").style.visibility="hidden";
			document.getElementById("agencyOpt").style.visibility="hidden";
			document.getElementById("agencyDescrip").style.display="none";
			document.getElementById("agencyOpt").style.display="none";
			
			// hide pro contact info
			document.getElementById("s_contact_label").style.visibility="hidden";
			document.getElementById("s_contact_table").style.visibility="hidden";
			document.getElementById("s_contact_label").style.display="none";
			document.getElementById("s_contact_table").style.display="none";
			
			//display agency contact info
			document.getElementById("agency_contact_label").style.visibility="visible";
			document.getElementById("agency_contact_table").style.visibility="visible";
			document.getElementById("agency_contact_label").style.display="block";
			document.getElementById("agency_contact_table").style.display="block";
			
			//hide checkboxes
			document.getElementById("getInterests").style.visibility="hidden";
			document.getElementById("getInterests").style.display="none";
			document.getElementById("column3").style.visibility="hidden";
			document.getElementById("column3").style.display="none";
			document.getElementById("column4").style.visibility="hidden";
			document.getElementById("column4").style.display="none";
			
			//hide notes & ref types
			document.getElementById("notesBox").style.visibility="hidden";
			document.getElementById("notesLabel").style.visibility="hidden";
			document.getElementById("notesBox").style.display="none";
			document.getElementById("notesLabel").style.display="none";
			document.getElementById("refTypes").style.visibility="hidden";
			document.getElementById("refTypes").style.display="none";
			
			//fill the form with all available information
			fillEditPageForm('agency', 'edit', id);	
		}
	}
	else //mode == 'add'
	{
		if(what == "program") //add program
		{
			//set the descriptive headers
			document.getElementById("editHeader").innerHTML = "Add Program";
			document.getElementById("agencyDescrip").style.visibility="visible";
			document.getElementById("agencyOpt").style.visibility="visible";
			document.getElementById("agencyDescrip").style.display="block";
			document.getElementById("agencyOpt").style.display="block";
			
			
			//display pro contact info
			document.getElementById("s_contact_label").style.visibility="visible";
			document.getElementById("s_contact_table").style.visibility="visible";
			document.getElementById("s_contact_label").style.display="block";
			document.getElementById("s_contact_table").style.display="block";
			
			// hide agency contact info
			document.getElementById("agency_contact_label").style.visibility="hidden";
			document.getElementById("agency_contact_table").style.visibility="hidden";
			document.getElementById("agency_contact_label").style.display="none";
			document.getElementById("agency_contact_table").style.display="none";
			
			
			//display checkboxes
			document.getElementById("getInterests").style.visibility="visible";
			document.getElementById("getInterests").style.display="block";
			document.getElementById("column3").style.visibility="visible";
			document.getElementById("column3").style.display="block";
			document.getElementById("column4").style.visibility="visible";
			document.getElementById("column4").style.display="block";
			
			//display notes & ref types
			document.getElementById("notesBox").style.visibility="visible";
			document.getElementById("notesLabel").style.visibility="visible";
			document.getElementById("notesBox").style.display="block";
			document.getElementById("notesLabel").style.display="block";
			document.getElementById("refTypes").style.visibility="visible";
			document.getElementById("refTypes").style.display="block";
			
			//fill the dropdown box and do not set the selected index
			addAgenciesToEditPageDropdown(-1);
			//set to anything less than -1 to disregard
			document.getElementById('program_id').value = -2;
			
			//alert('Setting the mode to add');
			document.getElementById('mode').value = 'add';
		}
		else // add agency
		{
			//set the descriptive headers
			document.getElementById("editHeader").innerHTML = "Add Agency";
			document.getElementById("agencyDescrip").style.visibility="hidden";
			document.getElementById("agencyOpt").style.visibility="hidden";
			document.getElementById("agencyDescrip").style.display="none";
			document.getElementById("agencyOpt").style.display="none";
			
			
			//hide pro contact info
			document.getElementById("s_contact_label").style.visibility="hidden";
			document.getElementById("s_contact_table").style.visibility="hidden";
			document.getElementById("s_contact_label").style.display="none";
			document.getElementById("s_contact_table").style.display="none";
			
			//display agency contact info
			document.getElementById("agency_contact_label").style.visibility="visible";
			document.getElementById("agency_contact_table").style.visibility="visible";
			document.getElementById("agency_contact_label").style.display="block";
			document.getElementById("agency_contact_table").style.display="block";
			
			//hide checkboxes
			document.getElementById("getInterests").style.visibility="hidden";
			document.getElementById("getInterests").style.display="none";
			document.getElementById("column3").style.visibility="hidden";
			document.getElementById("column3").style.display="none";
			document.getElementById("column4").style.visibility="hidden";
			document.getElementById("column4").style.display="none";
			
			//hide notes & ref types
			document.getElementById("notesBox").style.visibility="hidden";
			document.getElementById("notesLabel").style.visibility="hidden";
			document.getElementById("notesBox").style.display="none";
			document.getElementById("notesLabel").style.display="none";
			document.getElementById("refTypes").style.visibility="hidden";
			document.getElementById("refTypes").style.display="none";
			
			//set to anything less than -1 to disregard
			document.getElementById('program_id').value = -2;
			//alert('Setting the mode to add');
			document.getElementById('mode').value = 'add';
		}
	}
}
/**
 * Fills in the edit page's form with all available information
 * about the program or agency
 */
function fillEditPageForm(what, mode, id) {
	
	if(mode == 'add' || mode == 'edit') {
		document.getElementById('mode').value = mode;
	}
	else {
		return;
	}
	
	//collect the DOM elements for all the fields that need to be filled
	var name = document.getElementById('name');
	var descript = document.getElementById('descript');
	var ref_type_full = document.getElementById('ref_type_full');
	var ref_type_lim = document.getElementById('ref_type_lim');
	
	//pro contact information
	var p_contact_id = document.getElementById('p_contact_id');
	var title = document.getElementById('title');
	var f_name = document.getElementById('f_name');
	var l_name = document.getElementById('l_name');
	var m_name = document.getElementById('m_name');
	var suf = document.getElementById('suf');
	var m_phone = document.getElementById('m_phone');
	var w_phone = document.getElementById('w_phone');
	var mail = document.getElementById('mail');

	var s_contact_id = document.getElementById('s_contact_id');
	var s_f_name = document.getElementById('s_f_name');
	var s_l_name = document.getElementById('s_l_name');
	var s_m_name = document.getElementById('s_m_name');
	var s_m_phone= document.getElementById('s_m_phone');
	var s_w_phone= document.getElementById('s_w_phone');
	var s_mail = document.getElementById('s_mail');
	
	var addr_id = document.getElementById('addr_id');
	var street = document.getElementById('street');
	var city = document.getElementById('city');
	var state_us = document.getElementById('state_us');
	var zip = document.getElementById('zip');
	
	//agency or program depending on the what parameter
	var elem;
	
	if(what == 'agency') {
		elem = agencies[id];

		document.getElementById('agency_id').value = elem.id;
		document.getElementById('program_id').value = -1;
/*		document.getElementById('agency_phone').value = elem.phone;
		document.getElementById('agency_fax').value = elem.fax;
		document.getElementById('agency_mail').value = elem.mail;
*/		s_contact_id.value = -1;
	}
	else if(what == 'program') {
		elem = programs[id];
		
		//set the student contact info
		s_contact_id.value = (elem.s_contact.id) ? elem.s_contact.id : -1;
		s_f_name.value = elem.s_contact.f_name;
		s_l_name.value = elem.s_contact.l_name;
		s_f_name.value = elem.s_contact.f_name;
		s_m_phone.value = elem.s_contact.m_phone;
		s_w_phone.value = elem.s_contact.w_phone;
		s_mail.value = elem.s_contact.mail;
		
		document.getElementById('agency_id').value = elem.agency.id;
		document.getElementById('program_id').value = elem.id;
/*		document.getElementById('phone').value = elem.phone;
*/		
		if(elem.referal == referal.full) {
			ref_type_full.checked = true;
			ref_type_lim.checked = false;
		}
		else if(elem.referal == referal.limited){
			ref_type_full.checked = false;
			ref_type_lim.checked = true;
		}
		
		//check the interest boxes
		var i;
		for(i in elem.issues) {
			var issue_index = elem.issues[i];
			var currentIssue = issues[issue_index];
			var issue_elem = document.getElementById(currentIssue.name).checked = true;
		}
		
		//check the hours boxes
		for(i in elem.hours) {
			var hour_index = elem.hours[i];
			var currentHour = hours[hour_index];
			var hour_elem = document.getElementById(currentHour).checked = true;
		}
		//check the seasons boxes
		for(i in elem.seasons) {
			var season_index = elem.seasons[i];
			var currentSeason= seasons[season_index];
			var season_elem = document.getElementById(currentSeason).checked = true;
		}
		
	}
	name.value = elem.name;
	descript.value = elem.descript;
	
	p_contact_id.value = (elem.p_contact.id) ? elem.p_contact.id : -1;
	f_name.value = elem.p_contact.f_name;
	m_name.value = elem.p_contact.m_name;
	l_name.value = elem.p_contact.l_name;
	title.value = elem.p_contact.title;
	suf.value = elem.p_contact.suf;
	w_phone.value = elem.p_contact.w_phone;
	m_phone.value = elem.p_contact.m_phone;
	mail.value = elem.p_contact.mail;
	
	addr_id.value = (elem.addr.id) ? elem.addr.id : -1;
	street.value = elem.addr.street;
	city.value = elem.addr.city;
	state_us.value = elem.addr.state_us;
	zip.value = elem.addr.zip;
}
/**
 * Populates the dropdown box on the Program EditPage
 * @param program_index - array index of the program being edited
 */
function addAgenciesToEditPageDropdown(program_index) {
	var dropdown = document.getElementById("agencyOpt");
	dropdown.options.length = 0;
	
	dropdown.add(new Option('--No Agency--'), null);
	
	//add every agency to the list 
	var i;
	for(i in agencies) {
		var agency = agencies[i];
		dropdown.add(new Option(agency.name), null);
	}
	
	//change the value of the field holding the agency id for form submission
	//need to subtract 1 from selectedIndex to account for "No agency" entry
	dropdown.onchange = function() {
		var selectedIndex = document.getElementById('agencyOpt').selectedIndex;
		if(selectedIndex == 0) {
			location = 'EditPage.php?mode=add&what=agency';
		}
		else {
			document.getElementById('agency_id').value = agencies[selectedIndex - 1].id;
		}
	};
	
	//set the dropdown's selected index to match the agency of the program being edited
	if(program_index >= 0)
		dropdown.selectedIndex = programs[program_index].agency.index + 1;
}
/**
 * Displays a new window
 * @param url - address to open in a new window
 * @returns false
 */
function popitup(url) {
	newwindow=window.open(url,'name','height=600,width=800');
	if (window.focus) {newwindow.focus()}
	return false;
}
/**
 * Hides elements on screen
 * @param boxid - id of the element to hide
 */
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
/**
 * Displays elements on screen
 * @param boxid - id of the element to display
 */
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
/**
 * Switches from advanced search to search results
 * @returns
 */
function searchtoresults()
{
	showstuff('results');
	hidestuff('interests');	
}
/**
 * Switches from search results to advanced search
 * @returns
 */
function backtosearch()
{
	//clear previous search results and display all
	var i;
	program_search_results = [];
	for(i in programs) {
		program_search_results.push(i);
	}
	agency_search_results = [];
	for(i in agencies) {
		agency_search_results.push(i);
	}
	//clear the sidebar and repopulate with all
	if(left_sidebar_display == LEFT_SIDEBAR_PROGRAM) {
		toggleLeftSideBarDisplay();
	}
	else {
		clearLeftSideBar();
		addAgenciesToLeftSideBar(agency_search_results);
	}
	showstuff('interests');
	hidestuff('results');
}
/**
 * Uncheck all checked interest boxes
 */
function clearChoices()
{
	 document.getElementById('form1').reset();
	 document.getElementById('form3').reset();
}
/**
 * Homepage onload function, can be told to display 
 * a certain agency or program with arguments
 * @param what - "program" or "agency", sets display mode
 * @param id - index in global array of program or agency to display
 */
function init(what, id)
{
	initAgenciesAndPrograms();
	initIssues();
	
	left_sidebar_display = LEFT_SIDEBAR_AGENCY;
	clearLeftSideBar();
	addAgenciesToLeftSideBar(agency_search_results);
	
	showstuff('interests');
	hidestuff('results');
	
	if(!what || what == 'none' || id < 0) {
		return;
	}
	if(what == 'program') {
		displayProgramInfo(id);
	}
	else if(what == 'agency') {
		displayAgencyInfo(id);
	}
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
	if(!stringToSearch) {
		return -1;
	}
	if(!searchTerms) {
		return 0;
	}
	return stringToSearch.indexOf(searchTerms);
}

/**
 * Search one string for another regardless of upper or lower case.
 * @param stringToSearch - string being searched
 * @param searchTerms - string to see if stringToSearch contains
 * @returns starting index of searchTerms in stringToSearch or -1 if not found
 */
function caseInsensitiveStringSearch(stringToSearch, searchTerms) {
	if(!stringToSearch) {
		return -1;
	}
	if(!searchTerms) {
		return 0;
	}
	var s = stringToSearch.toLowerCase();
	var t = searchTerms.toLowerCase();
	return stringSearch(s, t);
}
/**
 * QuickSearch, searches by program or agency name/description
 * @returns false - so the form submit doesn't reload the page
 */
function quickSearch() {
	
	var searchTerms = document.getElementById('searchBar').value;
	
	searchAgency(searchTerms);
	searchProgram(searchTerms);
	clearLeftSideBar();
	
	if(left_sidebar_display == LEFT_SIDEBAR_AGENCY) {
		addAgenciesToLeftSideBar(agency_search_results);
		if(agency_search_results.length > 0) {
			displayAgencyInfo(agency_search_results[0]);
		}
	}
	else if(left_sidebar_display == LEFT_SIDEBAR_PROGRAM) {
		addProgramsToLeftSideBar(program_search_results);
		if(program_search_results.length > 0) {
			displayProgramInfo(program_search_results[0]);
		}
	}
	return false;
}
/**
 * AdvancedSearch, searches by selected interests
 * @returns false - so the form submit doesn't reload the page
 */
function advancedSearch() {
	var matching_issues = [];
	
	var matching_agency_indices = [];
	var matching_program_indices = [];
	
	//collect all selected issue ids
	var i, j, k;
	for(i in issues) {
		var issue = issues[i];
		if(issue != 0) {
			var checkbox = document.getElementById(issue.name);
					
			if(checkbox.checked) {
				matching_issues.push(issue);
			}
		}
	}
	
	if(display_mode != DISPLAY_RESULTS) {
		searchtoresults();
	}
	
	//loop through each program's issues array
	//if program contains an issue id equal to a checked issue id,
	//add program's array index to matches
	for(i in matching_issues) {
		var issue = matching_issues[i];
		for(j in programs) {
			var p = programs[j];
			for(k in p.issues) {
				var p_issue = p.issues[k];
				if(issue.id == p_issue) {
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
		matching_agency_indices.push(program.agency.index);
	}
	//save the search results
	agency_search_results = matching_agency_indices;
	program_search_results = matching_program_indices;

	if(left_sidebar_display == LEFT_SIDEBAR_AGENCY) {
		toggleLeftSideBarDisplay();
	}
	else {
		clearLeftSideBar();
		addProgramsToLeftSideBar(program_search_results);
		if(program_search_results.length > 0) {
			displayProgramInfo(program_search_results[0]);
		}
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
 * 
 * @returns
 */
function clearProgramAgenciesList() {
	var list = document.getElementById("link_to_prog_agency");
	
	while(list.hasChildNodes()) {
		removeNode(list.childNodes[0]);
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
		if(left_sidebar_display != LEFT_SIDEBAR_PROGRAM) {
			toggleLeftSideBarDisplay();
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
		document.getElementById("display_p_contact_w_phone").innerHTML = (pcon.w_phone) ? pcon.w_phone : "";
		document.getElementById("display_p_contact_mail").innerHTML = (pcon.mail) ? pcon.mail : "";
		
		str = (addr.city) ? addr.city : "";
		str += (str && addr.state_us) ? ", " + addr.state_us : "";
		str += (str && addr.zip) ? " " + addr.zip : "";
		
		document.getElementById("display_address_street").innerHTML = (addr.street) ? addr.street : "";
		document.getElementById("display_address_city").innerHTML = str;
		
		document.getElementById("display_s_contact_m_phone").innerHTML = (scon.m_phone) ? scon.m_phone : "";
		document.getElementById("display_s_contact_w_phone").innerHTML = (scon.w_phone) ? scon.w_phone : "";
		document.getElementById("display_s_contact_mail").innerHTML = (scon.mail) ? scon.mail : "";
		
		clearProgramAgenciesList();
		
		//Create agency link at bottom of display page
		var list = document.getElementById("link_to_prog_agency");
		var a = document.createElement("a");
		a.href = "javascript:displayAgencyInfo(" + p.agency.index + ")";
		var t = document.createTextNode(p.agency.name);
		a.appendChild(t);
		var li = document.createElement("li");
		li.appendChild(a);
		list.appendChild(li);
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
		if(left_sidebar_display != LEFT_SIDEBAR_AGENCY) {
			toggleLeftSideBarDisplay();
		}
		var agency = agencies[index];
		
		document.getElementById("display_name").innerHTML = (agency.name) ? agency.name : "";
		document.getElementById("display_descript").innerHTML = (agency.descript) ? agency.descript : "";
		document.getElementById("agency_phone").innerHTML = (agency.phone) ? agency.phone : "";
		document.getElementById("agency_fax").innerHTML = (agency.fax) ? agency.fax : "";
		document.getElementById("agency_mail").innerHTML = (agency.mail) ? agency.mail : "";

		
		var pcon = agency.p_contact;
		
		var str = (pcon.title) ? pcon.title + " " : "";
		str += (pcon.f_name) ? pcon.f_name + " " : "";
		str += (pcon.m_name) ? pcon.m_name + " " : "";
		str += (pcon.l_name) ? pcon.l_name + " " : "";
		
		document.getElementById("display_p_contact_name").innerHTML = str; 
		
		document.getElementById("display_p_contact_m_phone").innerHTML = (pcon.m_phone) ? pcon.m_phone : "";
		document.getElementById("display_p_contact_w_phone").innerHTML = (pcon.w_phone) ? pcon.w_phone : "";
		document.getElementById("display_p_contact_mail").innerHTML = (pcon.mail) ? pcon.mail : "";
		
		clearProgramAgenciesList();
		var i;
		var list = document.getElementById("link_to_prog_agency");
		for(i in agency.programs) {
			
			var program = agency.programs[i];
			var a = document.createElement("a");
			a.href = "javascript:displayProgramInfo(" + program.index + ")";
			var t = document.createTextNode(program.name);
			a.appendChild(t);
			var li = document.createElement("li");
			li.appendChild(a);
			list.appendChild(li);
		}
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
		
		//display student info if program
		document.getElementById('studInfo').style.visibility="visible";
		document.getElementById('studInfo').style.display="block";
		
		//hide agency info if program
		document.getElementById('agencyInfo').style.visibility="hidden";
		document.getElementById('agencyInfo').style.display="none";

		
		
		
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
		
		//hide student info if agency
		document.getElementById('studInfo').style.visibility="hidden";
		document.getElementById('studInfo').style.display="none";
		
		//display agency info if agency
		document.getElementById('agencyInfo').style.visibility="visible";
		document.getElementById('agencyInfo').style.display="block";
		
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
	var agency_count = 0;
	var agency_DOM_element = document.getElementById("agency_table");
	if(agency_DOM_element) {
		if(agency_DOM_element.rows) {
			agency_count = agency_DOM_element.rows.length;
		}
	}
	for(i = 0; i < agency_count; i++) {
	
		//get the table for each agency and construct a GIVEAgency object from it
		var tableId = "agency" + i;
		var agency = TableIdToGIVEAgency(tableId);
		
		//add to global agencies array
		agencies.push(agency);
		agency.index = i;
		
		//each GIVEAgency contains an array of GIVEPrograms
		//add each agency's programs to the global programs array
		var j;
		for(j in agency.programs) {
			var p = agency.programs[j];
			programs.push(p);
			p.index = programs.length - 1;
		}
	}
	for(i in programs) {
		program_search_results.push(i);
	}
	for(i in agencies) {
		agency_search_results.push(i);
	}
}
/**
 * Initializes the global issues array
 * Should be called on every page that needs the issues array.
 */
function initIssues() {
	//ids start at 5 so fill in 0-4 to make retrieval bawed on array index trivial
	issues = [0, 0, 0, 0, 0,
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
 * Onload function called on Browse All page.
 * Builds the list of all agencies and programs.
 */
function initBrowseAll() {
	//initialize the global arrays and add to the page
	initAgenciesAndPrograms();
	addAgenciesToBrowseAll();
	addProgramsToBrowseAll();
}
/**
 * Adds the list of all agencies to the browse all page.
 */
function addAgenciesToBrowseAll() {
	
	var list = document.getElementById("agencyList");
	if(!list) {
		return;
	}
	
	var i;
	for(i in agencies) {
		
		var agency = agencies[i];
		var a = document.createElement("a");
		a.href = "Homepage.php?what=agency&id="+i;
		var t = document.createTextNode(agency.name);
		a.appendChild(t);
		var li = document.createElement("li");
		li.appendChild(a);
		list.appendChild(li);
	}
}
/**
 * Adds the list of all programs to the browse all page
 */
function addProgramsToBrowseAll() {
	
	var list = document.getElementById("programList");
	
	if(!list) {
		return;
	}
	
	var i;
	for(i in programs) {
		
		var program = programs[i];
		var a = document.createElement("a");
		a.href = "Homepage.php?what=program&id="+i;
		var t = document.createTextNode(program.name);
		a.appendChild(t);
		var li = document.createElement("li");
		li.appendChild(a);
		list.appendChild(li);
	}
}
/**
 * Initializes the dropdown boxes to add and edit agencies and programs
 * and displays a warning message to alert the user that they are now in admin mode.
 */
function initAdmin() {
	initAgenciesAndPrograms();
	initAdminAgencyDropdown();
	initAdminProgramDropdown();
	alert('You have selected the "Administrator" option. Use this option only to add, delete, or edit programs or agencies and their descriptions.');
}
/**
 * Initializes the agency dropdown box on the Admin page with all agencies.
 */
function initAdminAgencyDropdown() {
	
	var dropdown = document.getElementById("agencyDropdown");
	//if the dropdown box exists
	if(dropdown) {
		//clear the dropdown box
		dropdown.options.length = 0;

		//add every agency to the dropdown box
		var i;
		for(i in agencies) {
			var agency = agencies[i];
			dropdown.add(new Option(agency.name), null);
		}
	}
}
/**
 * Initializes the program dropdown box on the admin page with all programs.
 */
function initAdminProgramDropdown() {
	var dropdown = document.getElementById("programDropdown");
	//if the dropdown box exists
	if(dropdown) {
		//clear the dropdown box
		dropdown.options.length = 0;
		
		//add every program to the dropdown box
		var i;
		for(i in programs) {
			var program = programs[i];
			dropdown.add(new Option(program.name), null);
		}
	}
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
	var id 			= TableDataFromInnerHTML(addr_DOM_element.rows[0].innerHTML);
	var street 		= TableDataFromInnerHTML(addr_DOM_element.rows[1].innerHTML);
	var city 		= TableDataFromInnerHTML(addr_DOM_element.rows[2].innerHTML);
	var state_us 	= TableDataFromInnerHTML(addr_DOM_element.rows[3].innerHTML);
	var zip 		= TableDataFromInnerHTML(addr_DOM_element.rows[4].innerHTML);
	
	//build and return the complete GIVEAddr object
	return new GIVEAddr(id, street, city, state_us, zip);
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
	var id			= TableDataFromInnerHTML(p_contact_DOM_element.rows[0].innerHTML);
	var title 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[1].innerHTML);
	var l_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[2].innerHTML);
	var f_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[3].innerHTML);
	var m_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[4].innerHTML);
	var suf 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[5].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[6].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[7].innerHTML);
	var mail 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[8].innerHTML);
	
	//build and return the complete GIVEProContact object
	return new GIVEProContact(id, title, l_name, f_name, m_name, suf, w_phone, m_phone, mail);
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
	var name 		= TableDataFromInnerHTML(program_DOM_element.rows[2].innerHTML);
	var descript 	= TableDataFromInnerHTML(program_DOM_element.rows[3].innerHTML);
	var duration 	= TableDataFromInnerHTML(program_DOM_element.rows[4].innerHTML);
	var notes 		= TableDataFromInnerHTML(program_DOM_element.rows[5].innerHTML);
	
	//retrieve the DOM element for the following tables and repeat the process above
	var season 		= TableIdToSeasonsArray(table_id + "_seasons");
	var hours 		= TableIdToHoursArray(table_id + "_hours");
	var issues 		= TableIdToIssuesArray(table_id + "_issues");
	var addr 		= TableIdToGIVEAddr(table_id + "_addr");
	var p_contact 	= TableIdToGIVEProContact(table_id + "_p_contact");
	var s_contact 	= TableIdToGIVEStudentContact(table_id + "_s_contact");
	
	//build and return the complete GIVEProgram object
	return new GIVEProgram(id, referal, season, hours, name, descript, duration, notes, issues, addr, null, p_contact, s_contact);
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
	var id 			= TableDataFromInnerHTML(s_contact_DOM_element.rows[0].innerHTML);
	var l_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[1].innerHTML);
	var f_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[2].innerHTML);
	var m_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[3].innerHTML);
	var suf 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[4].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[5].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[6].innerHTML);
	var mail 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[7].innerHTML);
	
	//build and return the complete GIVEStudentContact object
	return new GIVEStudentContact(id, l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}
function TableIdToSeasonsArray(table_id) {

	var seasons_arr = [];
	
	//retreive the DOM element within the GIVEAgency table id
	var season_DOM_element = document.getElementById(table_id);
	
	var i;
	var count = season_DOM_element.rows.length;
	for(i = 0; i < count; i++) {
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var season = TableDataFromInnerHTML(season_DOM_element.rows[i].innerHTML);
		seasons_arr.push(season);
	}
	return seasons_arr;
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
 * Constructs an array of the hours a program requires each volunteer to dedicate
 * @param table_id - table's id property so the DOM element can be retrieved
 * @returns {Array} - array if hours ids which can then be referenced to the
 * global hours array.
 */
function TableIdToHoursArray(table_id) {

	var hours_arr = [];
	
	//retreive the DOM element within the GIVEAgency table id
	var hours_DOM_element = document.getElementById(table_id);
	
	var i;
	var count = hours_DOM_element.rows.length;
	for(i = 0; i < count; i++) {
	
	//there's no way to reliably retrieve the data in between <td> </td> tags
	//using DOM element properties. Instead, obtain the innerHTML for the
	//<tr> </tr> tags, which will include the <td> </td> tags. Then slice off
	//the <td> </td> tags and obtain the data within
	var hour = TableDataFromInnerHTML(hours_DOM_element.rows[i].innerHTML);
		hours_arr.push(hour);
	}
	return hours_arr;
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
function GIVEAddr(id, street, city, state, zip) {
	var addr = {
		id			: id,
		street 		: street,
		city 		: city,
		state_us 	: state,
		zip 		: zip
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
		//keep track of index in global array, set to zero for now
		index		: 0,
		id 			: id, 
		name		: name, 
		descript	: descript, 
		mail		: mail, 
		phone		: phone, 
		fax			: fax,
		p_contact	: p_contact,
		addr		: addr,
		programs	: (!programs) ? [] : programs
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
function GIVEProContact(id, title, l_name, f_name, m_name, suf, w_phone, m_phone, mail) {
	var pcon = {
		id		: id,
		title 	: title,
		l_name 	: l_name,
		f_name	: f_name,
		m_name	: m_name,
		suf 	: suf,
		
		//some DB entries for phone numbers are 0 or -1 to denote
		//no phone number known, set to empty string for these
		w_phone	: (w_phone <= 0) ? '' : w_phone, 
		m_phone	: (m_phone <= 0) ? '' : m_phone,
		mail	: mail
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
function GIVEProgram (id, referal, seasons, hours, name, descript, duration, notes, issues, addr, agency, p_contact, s_contact) {
	var program = {
		//keep track of index in global array, set to zero for now
		index 		: 0,
		id 			: id,
		referal		: referal,
		seasons		: seasons,
		hours		: hours,
		name		: name, 
		descript	: descript,
		duration	: duration,
		notes		: notes,
		issues		: (!issues) ? [] : issues,
		addr		: addr,
		agency		: agency,
		p_contact	: p_contact,
		s_contact	: s_contact
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
function GIVEStudentContact(id, l_name, f_name, m_name, suf, w_phone, m_phone, mail) {
	var scon = {
		id		: id,
		l_name 	: l_name,
		f_name	: f_name,
		m_name	: m_name,
		suf 	: suf,
		
		//some DB entries for phone numbers are 0 or -1 to denote
		//no phone number known, set to empty string for these
		w_phone	: (w_phone <= 0) ? '' : w_phone, 
		m_phone	: (m_phone <= 0) ? '' : m_phone,
		mail	: mail
	};
	return scon;
}