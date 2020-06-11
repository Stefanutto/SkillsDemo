CREATE SCHEMA system;
CREATE TABLE system.user(
    id serial, 
    email character varying(128), 
    passwd character varying(128)
);
ALTER TABLE system.user ADD COLUMN valid boolean DEFAULT false;
ALTER TABLE system.user ADD COLUMN valid_date timestamp without time zone DEFAULT now();
ALTER TABLE system.user ADD COLUMN recover_passwd character varying(128) DEFAULT '';
ALTER TABLE system.user ADD COLUMN name character varying(256);