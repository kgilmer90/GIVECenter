USE give_ctr_agencies;

CREATE USER god@localhost IDENTIFIED BY 'mypassword';
CREATE USER guest@localhost;

GRANT ALL ON give_ctr_agencies.* TO god@localhost;
GRANT SELECT ON give_ctr_agencies.* TO guest@localhost;
