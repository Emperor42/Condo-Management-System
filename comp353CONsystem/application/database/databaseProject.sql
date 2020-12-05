#Matthew GIANCOLA-40019131
#Khadija SUBTAIN-40040952
#Daniel GAUVIN-40061905
CREATE database CONMANSYSTEM;
#an entity can be a user or group of some type
#must be validated in the front end if it needs a password

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
FOREIGN KEY (msgTo) REFERENCES entity(eid) ON DELETE CASCADE,
msgFrom int,
FOREIGN KEY (msgFrom) REFERENCES entity(eid) ON DELETE CASCADE,
msgSubject varchar(255),
msgText varchar(2550),
msgAttach  varchar(2550),
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
FOREIGN KEY (eid) REFERENCES entity(eid) ON DELETE CASCADE,
FOREIGN KEY (pid) REFERENCES property(pid) ON DELETE CASCADE
);

#the property is owned by an entity
CREATE TABLE own(
eid int,
pid int,
myShare int,
FOREIGN KEY (eid) REFERENCES entity(eid) ON DELETE CASCADE,
FOREIGN KEY (pid) REFERENCES property(pid) ON DELETE CASCADE
);

#relation has a specific relationship between entites
CREATE TABLE relate(
relType int NOT NULL,
relSup int,
eid int,
tid int,
FOREIGN KEY (eid) REFERENCES entity(eid) ON DELETE CASCADE,
FOREIGN KEY (tid) REFERENCES entity(eid) ON DELETE CASCADE
);

#show tables;

# Group table to store info about the group
CREATE TABLE groups(
groupId int NOT NULL,
FOREIGN KEY (groupId) REFERENCES entity(eid) ON DELETE CASCADE,
groupName varchar(255),
groupDescription varchar(255),
PRIMARY KEY(groupId)
);

INSERT INTO entity (eid, userId, pwrd) VALUES (-1, 'PUBLIC', '');
INSERT INTO entity (eid, userId, pwrd) VALUES (0, 'admin', 'admin');

#TODO triggers and refernce keys
CREATE TABLE email(
emailId int NOT NULL AUTO_INCREMENT,
fromEid int NOT NULL,
toEid int NOT NULL,
subject varchar(256),
body varchar(1000),
emailStatus varchar(256),
createDate DATETIME,
outboxDelete int NOT NULL,
inboxDelete int NOT NULL,
PRIMARY KEY(emailId)
);

#simple payment table to store information regarding payments for various things (planed transfers of money)
CREATE TABLE payment(
    pid INT AUTO_INCREMENT,
    payTo int,
    FOREIGN KEY (payTo) REFERENCES entity(eid),
    payFrom int,
    FOREIGN KEY (payFrom) REFERENCES entity(eid),
    total int NOT NULL, 
    outstanding int NOT NULL,
    class VARCHAR(255),
    memo VARCHAR(255),
    posted TIMESTAMP NOT NULL,
    PRIMARY KEY (pid)
)
