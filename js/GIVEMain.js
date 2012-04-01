//**************************************************
////////////////////////////////////////////////////
//
//				GIVE MAIN SCRIPT
//
////////////////////////////////////////////////////
//**************************************************
var agencies = [];		//global agencies array, contains all agencies
var programs = [];		//global programs array, contains all programs

var GIVE_MAP = {		//translation map to aid in parsing onload strings
		
		agency:					"g",		//flags in the onload array
		agency_addr:			"ga",		//to signal what kind of object
		agency_proContact:		"gp",		//to create with the data that follows
		agency_program:			"gr",
		program_issues:			"ri",
		program_addr:			"ra",
		program_proContact:		"rp",
		program_studentContact:	"rs",
		
		numElements:{		//number of primitive (string or numeric) 
			addr:4, 		//elementsthat compose a single GIVE object
			agency:6, 		
			proContact:8, 	//used to advance the array index variable
			program:8, 		//when parsing onload strings
			studentContact:7
		}
};
/**
 * HTML <body> onload function
 * All database query results are passed as arguments to the function.
 * Arguments are then parsed for object type flags and corresponding
 * GIVE objects are created from the data. All GIVEProgram and 
 * GIVEAgency objects are stored in global arrays called
 * 'agencies' and 'programs'.
 */
function main() {
	var argc = arguments.length;
	var argv = arguments;
	
	var agency = null;
	var program = [];
	for(var i = 0; i < argc; i++) {
		
		var flag = argv[i];
		
		if(flag == GIVE_MAP.agency) {
			agency = new GIVEAgency(argv[i+1], argv[i+2], argv[i+3], argv[i+4], argv[i+5], argv[i+6], null, null, null);
			i += GIVE_MAP.numElements.agency;
		}
		else if(flag == GIVE_MAP.agency_proContact) {
			agency.p_contact = new GIVEProContact(argv[i+1], argv[i+2], argv[i+3], argv[i+4], argv[i+5], argv[i+6], argv[i+7], argv[i+8]);
			i += GIVE_MAP.numElements.proContact;
		}
		else if(flag == GIVE_MAP.agency_addr) {
			
		}
	}
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