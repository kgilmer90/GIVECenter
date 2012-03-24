// #1
SELECT name
FROM agency
ORDER BY name ASC;

// #2
SELECT agency.*, program.*,add.*
FROM agency
JOIN program
ON agency.id = program.agency
JOIN addr
ON agency.addr = addr.id
WHERE agency.id = $this_agency;

// #3
SELECT program.*,s_contact.*,p_contact.*,addr.*
FROM program
JOIN s_contact
ON program.s_contact = s_contact.id
JOIN p_contact
ON progtam.p_contact = p_contact.id
JOIN addr
ON program.addr = addr.id
WHERE program.id = $this_program;

