CREATE DATABASE IF NOT EXISTS users;
USE users;
CREATE TABLE IF NOT EXISTS blogs (
    name varchar(255) NOT NULL,
    content varchar(255) NOT NULL,
    images varchar(255) NOT NULL,
    public boolean
);
CREATE TABLE IF NOT EXISTS userdata  (
    id  int NOT NULL AUTO_INCREMENT,
    username  varchar(45) NOT NULL,
    email  varchar(45) NOT NULL,
    password  varchar(45) NOT NULL,
    PRIMARY KEY ( id ),
    UNIQUE KEY  id_UNIQUE  ( id )
);
INSERT INTO `blogs`(`name`, `content`, `images`, `public`) VALUES 
    ('Tips of coding','Sharing tips of coding here.','coding','1'),
    ('Life sessions for you','Life sessions.','life','1'),
    ('Darkness Demands','My new poems.','poems','1'),
    ('Science fiction','Student should read more about fictions.','fiction','1'),
    ('Inspiration for you','Inspiration for you.','Inspiration','1'),
    ('Admin Credentials','admin:admin@123!','hacker','0');