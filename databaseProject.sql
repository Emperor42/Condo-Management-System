CREATE database CONMANSYSTEM;
#an entity can be a user or group of some type

CREATE TABLE entity(
eid int NOT NULL AUTO_INCREMENT,
userId varchar(255),
firstName varchar(255),
lastName varchar(255), 
age int,
email varchar(255),
phone varchar(10),
entityType int,
group boolean,
pwrd varchar(255) NOT NULL,
PRIMARY KEY(eid)
);

#a basic admin user which can be user later on
INSERT INTO entity (eid,userId, firstName, lastName, age,email,phone, entityType,group, pwrd) VALUES (0,"admin", "System", "Administrator", 2020,"admin@conman.ca","1234567890", 0,False, "admin");

#a messages combines many different types of data
CREATE TABLE messages(
mid int NOT NULL AUTO_INCREMENT,
replyTO int,
msgTo int, 
FOREIGN KEY (msgTo) REFERENCES entity(eid), 
msgFrom int, 
FOREIGN KEY (msgFrom) REFERENCES entity(eid),
msgSubject varchar(255),
msgText varchar(2550),
msgAttach varchar(2250),
PRIMARY KEY(mid)
);

#the property has an address and some other data
CREATE TABLE property(
pid int NOT NULL AUTO_INCREMENT,
address varchar(255),
PRIMARY KEY(pid)
);

#the property is managed by an entity
CREATE TABLE manager(
eid int,
pid int,
FOREIGN KEY (eid) REFERENCES entity(eid), 
FOREIGN KEY (pid) REFERENCES property(pid) 
);

#the property is owned by an entity
CREATE TABLE own(
eid int,
pid int,
myShare int,
FOREIGN KEY (eid) REFERENCES entity(eid), 
FOREIGN KEY (pid) REFERENCES property(pid) 
);

#relation has a specific relationship between entites
CREATE TABLE relate(
relType int,
relSup int,
eid int,
tid int,
FOREIGN KEY (eid) REFERENCES entity(eid), 
FOREIGN KEY (tid) REFERENCES entity(eid) 
);

#show tables;
