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
user_group boolean,
pwrd varchar(255) NOT NULL,
PRIMARY KEY(eid)
);

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

# Group table to store info about the group
CREATE TABLE groups(
groupId int NOT NULL AUTO_INCREMENT,
groupName varchar(255),
groupDescription varchar(255),
PRIMARY KEY(gid)
);

#TEST Data
INSERT INTO CONMANSYSTEM.groups VALUES(null, 'Friends', 'Group for Friends');
INSERT INTO CONMANSYSTEM.groups VALUES(null, 'Family', 'Group for Family');
INSERT INTO CONMANSYSTEM.groups VALUES(null, 'Colleagues', 'Group for Colleagues');

#Group Membership
CREATE TABLE groupMembership(
groupId int NOT NULL,
ownerId int NOT NULL,
userId  int NOT NULL,
FOREIGN KEY (ownerId) REFERENCES entity(eid) ON DELETE CASCADE,
FOREIGN KEY (userId) REFERENCES entity(eid) ON DELETE CASCADE,
FOREIGN KEY (groupId) REFERENCES groups(groupId) ON DELETE CASCADE
);