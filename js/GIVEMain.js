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
 * The table is then parsed and reconstructed as Javascript objects.
 */
function initAgenciesAndPrograms() {
	
	var i = 1;
	var tableId = "agency" + i;
	var agency_count = document.getElementById("agency_table").rows.length;
	for(i = 1; i <= agency_count; i++) {
		var agency = TableIdToGIVEAgency(tableId);
		
		agencies.push(agency);
		
		var j;
		for(j in agency.programs) {
			programs.push(agency.programs[j]);
		}
		i++;
		tableId = "agency" + i;
		table = document.getElementById(tableId);
		document.write(agency);
	}
}
/**
 * Constructs a GIVEAgency object from a table embedded in the HTML.
 * @param table_id - table's id property so that the DOM element can be retrieved
 * @returns GIVEAgency object representing the table data
 */
function TableIdToGIVEAgency(table_id) {
	var agency_DOM_element = document.getElementById(table_id);
	
	var id 			= TableDataFromInnerHTML(agency_DOM_element.rows[0].innerHTML);
	var name 		= TableDataFromInnerHTML(agency_DOM_element.rows[1].innerHTML);
	var descript 	= TableDataFromInnerHTML(agency_DOM_element.rows[2].innerHTML);
	var mail 		= TableDataFromInnerHTML(agency_DOM_element.rows[3].innerHTML);
	var phone 		= TableDataFromInnerHTML(agency_DOM_element.rows[4].innerHTML);
	var fax 		= TableDataFromInnerHTML(agency_DOM_element.rows[5].innerHTML);
	
	var p_contact 	= TableIdToGIVEProContact(table_id + "_p_contact");
	var addr 		= TableIdToGIVEAddr(table_id + "_addr");
	var program_arr	= TableIdToGIVEProgramsArray(table_id + "_program");
	
	var agency = new GIVEAgency(id, name, descript, mail, phone, fax, p_contact, addr, program_arr);

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
	var addr_DOM_element = document.getElementById(table_id);
	
	var street 		= TableDataFromInnerHTML(addr_DOM_element.rows[0].innerHTML);
	var city 		= TableDataFromInnerHTML(addr_DOM_element.rows[1].innerHTML);
	var state_us 	= TableDataFromInnerHTML(addr_DOM_element.rows[2].innerHTML);
	var zip 		= TableDataFromInnerHTML(addr_DOM_element.rows[3].innerHTML);
	
	return new GIVEAddr(street, city, state_us, zip);
}
/**
 * Constructs a GIVEAProContact object from a table embedded in the HTML.
 * @param table_id - table's id property so that the DOM element can be retrieved
 * @returns GIVEProContact object representing the table data
 */
function TableIdToGIVEProContact(table_id) {
	var p_contact_DOM_element = document.getElementById(table_id);
	
	var title 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[0].innerHTML);
	var l_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[1].innerHTML);
	var f_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[2].innerHTML);
	var m_name 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[3].innerHTML);
	var suf 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[4].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[5].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(p_contact_DOM_element.rows[6].innerHTML);
	var mail 		= TableDataFromInnerHTML(p_contact_DOM_element.rows[7].innerHTML);
	
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
	for(i = 1; i <= count; i++) {
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
	var program_DOM_element = document.getElementById(table_id);
	
	var id 			= TableDataFromInnerHTML(program_DOM_element.rows[0].innerHTML);
	var referal 	= TableDataFromInnerHTML(program_DOM_element.rows[1].innerHTML);
	var season 		= TableDataFromInnerHTML(program_DOM_element.rows[2].innerHTML);
	var times 		= TableDataFromInnerHTML(program_DOM_element.rows[3].innerHTML);
	var name 		= TableDataFromInnerHTML(program_DOM_element.rows[4].innerHTML);
	var descript 	= TableDataFromInnerHTML(program_DOM_element.rows[5].innerHTML);
	var duration 	= TableDataFromInnerHTML(program_DOM_element.rows[6].innerHTML);
	var notes 		= TableDataFromInnerHTML(program_DOM_element.rows[7].innerHTML);
	
	var issues 		= TableIdToIssuesArray(table_id + "_issue");
	var addr 		= TableIdToGIVEAddr(table_id + "_addr");
	var p_contact 	= TableIdToGIVEProContact(table_id + "_p_contact");
	var s_contact 	= TableIdToGIVEStudentContact(table_id + "_s_contact");
	
	return new GIVEProgram(id, referal, season, times, name, descript, duration, notes, issues, addr, null, p_contact, s_contact);
}
/**
 * Constructs a GIVEStudentContact object from a table embedded in the HTML.
 * @param table_id - table's id property so that the DOM element can be retrieved
 * @returns GIVEStudentContact object representing the table data
 */
function TableIdToGIVEStudentContact(table_id) {
	var s_contact_DOM_element = document.getElementById(table_id);
	
	var l_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[0].innerHTML);
	var f_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[1].innerHTML);
	var m_name 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[2].innerHTML);
	var suf 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[3].innerHTML);
	var w_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[4].innerHTML);
	var m_phone 	= TableDataFromInnerHTML(s_contact_DOM_element.rows[5].innerHTML);
	var mail 		= TableDataFromInnerHTML(s_contact_DOM_element.rows[6].innerHTML);
	
	return new GIVEStudentContact(l_name, f_name, m_name, suf, w_phone, m_phone, mail);
}
/**
 * Constructs an array of string objects from a table embedded in the HTML.
 * @param table_id - table's id property so that the DOM element can be retrieved
 * @returns array of string objects representing the table data
 */
function TableIdToIssuesArray(table_id) {
	var issues_arr = [];
	
	var i;
	var issue_DOM_element = document.getElementById(table_id);
	var count = issue_DOM_element.rows.length;
	for(i = 0; i < count; i++) {
		var issue = TableDataFromInnerHTML(issue_DOM_element.rows[i].innerHTML);
		issues_arr.push(issue);
	}
	return issues_arr;
}
/**
 * In most cases, content within <td> </td> tags could not be extracted
 * without also including the tags. This function strips off the <td> </td>
 * tags and returns the inner data.
 * @param innerHTML - string of the form "<td property1=value1, ..., propertyN=valueN>innerText</td>"
 * @returns inner text content of the <td> </td> tag
 */
function TableDataFromInnerHTML(innerHTML) {
	if(!innerHTML) {
		return null;
	}
	var pattern = "\<td (.+?)\>(.+?)\<\/td\>";
	var regex = new RegExp(pattern, "i");
	var matches = innerHTML.match(pattern);
	
	if(!matches) {
		return null;
	}
	return matches[2];	//match[0] = whole string
						//match[1] = text between "<td" and the closing ">"
						//match[2] = text between "<td ...>" and "</td>"
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
			issues		: issues,
			addr		: addr,
			agency		: agency,
			p_contact	: p_contact,
			s_contact	: s_contact,
			toString 	: function() {
				var str = "id=" + this.id + ",referal=" + this.referal + 
				",season=" + this.season + ",times=" + this.times + ",name=" + 
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