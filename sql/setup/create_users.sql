USE give_ctr_agencies;

CREATE USER bgs@localhost IDENTIFIED BY 'dki2012!';

GRANT ALL ON give_ctr_agencies.* TO bgs@localhost;
