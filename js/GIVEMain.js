//**************************************************
////////////////////////////////////////////////////
//
//				GIVE MAIN SCRIPT
//
////////////////////////////////////////////////////
//**************************************************
var agencies = [];		//global agencies array, contains all agencies
var programs = [];		//global programs array, contains all programs

/**
 * HTML <body> onload function
 * All database query results are stored on the page as a hidden table.
 * The table is then parsed and reconstructed as Javascript objects
 * for convenience.
 */
function initAgenciesAndPrograms() {
	var agency_table = document.getElementById("agency_table");
	var all_agencies = agency_table.rows;
	
	for(var i in all_agencies) {
		var agency = DOMElementToGIVEAgency(all_agencies[i].rows);
		
		agencies.push(agency);
		for(var i in agency.programs) {
			programs.push(agency.programs[i]);
		}
	}
}

function DOMElementToGIVEAgency(agency_DOM_element) {
	var id 			= agency_DOM_element[0].cells[0].innerHTML;
	var name 		= agency_DOM_element[1].cells[0].innerHTML;
	var descript 	= agency_DOM_element[2].cells[0].innerHTML;
	var mail 		= agency_DOM_element[3].cells[0].innerHTML;
	var phone 		= agency_DOM_element[4].cells[0].innerHTML;
	var fax 		= agency_DOM_element[5].cells[0].innerHTML;
	
	var p_contact 	= DOMElementToGIVEProContact(agency_DOM_element[6].rows);
	var addr 		= DOMElementToGIVEAddr(agency_DOM_element[7].rows);
	var program_arr	= DOMElementToGIVEProgramsArray(agency_DOM_element[8].rows);
	
	var agency = GIVEAgency(id, name, descript, mail, phone, fax, p_contact, addr, program_arr);

	foreach(var i in program_arr) {
		program_arr[i].agency = agency;
	}
	
	return agency;
}

function DOMElementToGIVEAddr(addr_DOM_element) {
	var street 		= addr_DOM_element[0].cells[0].innerHTML;
	var city 		= addr_DOM_element[1].cells[0].innerHTML;
	var state_us 	= addr_DOM_element[2].cells[0].innerHTML;
	var zip 		= addr_DOM_element[3].cells[0].innerHTML;
	
	return new GIVEAddr(street, city, state_us, zip);
}

function DOMElementToGIVEProContact(p_contact_DOM_element) {
	var title 		= p_contact_DOM_element[0].cells[0].innerHTML;
	var l_name 		= p_contact_DOM_element[1].cells[0].innerHTML;
	var f_name 		= p_contact_DOM_element[2].cells[0].innerHTML;
	var m_name 		= p_contact_DOM_element[3].cells[0].innerHTML;
	var suf 		= p_contact_DOM_element[4].cells[0].innerHTML;
	var w_phone 	= p_contact_DOM_element[5].cells[0].innerHTML;
	var m_phone 	= p_contact_DOM_element[6].cells[0].innerHTML;
	var mail 		= p_contact_DOM_element[7].cells[0].innerHTML;
	
	return new GIVEProContact(title, l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}

function DOMElementToGIVEProgramsArray(programs_array_DOM_element) {
	
	var program_arr = [];
	for(var i in programs_array_DOM_element) {
		var program = DOMElementToGIVEProgram(programs_array_DOM_element[i].rows);
		program_arr.push(program);
	}
	return program_arr;
}

function DOMElementToGIVEProgram(program_DOM_element) {
	var id 			= program_DOM_element[0].cells[0].innerHTML;
	var referal 	= program_DOM_element[1].cells[0].innerHTML;
	var season 		= program_DOM_element[2].cells[0].innerHTML;
	var times 		= program_DOM_element[3].cells[0].innerHTML;
	var name 		= program_DOM_element[4].cells[0].innerHTML;
	var descript 	= program_DOM_element[5].cells[0].innerHTML;
	var duration 	= program_DOM_element[6].cells[0].innerHTML;
	var notes 		= program_DOM_element[7].cells[0].innerHTML;
	
	var issues 		= DOMElementToIssuesArray(program_DOM_element[8].rows);
	var addr 		= DOMElementToGIVEAddr(program_DOM_element[9].rows);
	var p_contact 	= DOMElementToProContact(program_DOM_element[10].rows);
	var s_contact 	= DOMElementToStudentContact(program_DOM_element[11].rows);
	
	return new GIVEProgram(id, referal, season, times, name, descript, duration, notes, issues, addr, null, p_contact, s_contact);
}

function DOMElementToGIVEStudentContact(s_contact_DOM_element) {
	var l_name 		= s_contact_DOM_element[0].cells[0].innerHTML;
	var f_name 		= s_contact_DOM_element[1].cells[0].innerHTML;
	var m_name 		= s_contact_DOM_element[2].cells[0].innerHTML;
	var suf 		= s_contact_DOM_element[3].cells[0].innerHTML;
	var w_phone 	= s_contact_DOM_element[4].cells[0].innerHTML;
	var m_phone 	= s_contact_DOM_element[5].cells[0].innerHTML;
	var mail 		= s_contact_DOM_element[6].cells[0].innerHTML;
	
	return new GIVEStudentContact(l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}

//**************************************************
////////////////////////////////////////////////////
//
//				GIVE OBJECT DEFINITIONS
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
			id 		: id, 
			name	: name, 
			descript: descript, 
			mail	: mail, 
			phone	: phone, 
			fax		: fax
	};
	agency.p_contact = (p_contact instanceof GIVEProContact) ? p_contact : null;
	agency.addr = (addr instanceof GIVEAddr) ? addr : null;
	agency.programs = (programs[0] instanceof GIVEProgram) ? programs : [];
	return agency;
}
/**
 * GIVEContactHistory object creation function
 * @param int id - numeric identifier
 * @param GIVEStudentContact contact - program's student contact
 * @param GIVEProgram program - student contact's program
 * @returns GIVEContactHistory object with fields initialized to function arguments
 */
function GIVEContactHistory(id, contact, program) {
	var hist = {
			id : id
	};
	hist.contact = (contact instanceof GIVEStudentContact) ? contact : null;
	hist.program = (program instanceof GIVEProgram) ? program : null;
	return hist;
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
function GIVEProgram (id, referal, season, times, name, descript, duration, notes, issues, addr, agency, p_contact, s_contact) {
	var program = {
			id 			: id,
			referal		: referal,
			season		: season,
			times		: times,
			name		: name, 
			descript	: descript,
			duration	: duration,
			notes		: notes,
			issues		: issues
	};
	program.addr = (addr instanceof GIVEAddr) ? addr : null;
	program.agency = (agency instanceof GIVEAgency) ? agency : null;
	program.p_contact = (p_contact instanceof GIVEProContact) ? p_contact : null;
	program.s_contact = (s_contact instanceof GIVEStudentContact) ? s_contact : null;
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
			mail	: mail
	};
	return scon;
}