/*
    Script is used to REMOVE ALL INFO from tables!
    Should be used only to reverse the import_give action during testing!
*/

USE give_ctr_agencies;

DELETE FROM addr;
DELETE FROM agency;
DELETE FROM contact_history;
DELETE FROM issues;
DELETE FROM program;
DELETE FROM program_issues;
DELETE FROM pro_contact;
DELETE FROM student_contact;