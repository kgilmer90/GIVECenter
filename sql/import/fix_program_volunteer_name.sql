UPDATE program,agency
	SET program.name = agency.name
	WHERE program.name = 'Volunteer' 
	AND program.agency = agency.id
