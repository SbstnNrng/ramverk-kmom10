--
-- Creating a User table.
--

--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "country" TEXT,
    "city" TEXT,
    "email" TEXT,
    "score" INTEGER
);

--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT
);

--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "acronym" TEXT NOT NULL,
    "topic" TEXT NOT NULL,
    "question" TEXT NOT NULL,
    "tag1" TEXT,
    "tag2" TEXT,
    "tag3" TEXT,
    FOREIGN KEY(userid) REFERENCES User(id)
);

--
-- Table Answers
--
DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "acronym" TEXT NOT NULL,
    "questionid" INTEGER NOT NULL,
    "answer" TEXT NOT NULL,
    FOREIGN KEY(userid) REFERENCES User(id),
    FOREIGN KEY(questionid) REFERENCES Question(id)
);

--
-- Table QuestionComment
--
DROP TABLE IF EXISTS QuestionComments;
CREATE TABLE QuestionComments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "acronym" TEXT NOT NULL,
    "questionid" INTEGER NOT NULL,
    "comment" TEXT NOT NULL,
    FOREIGN KEY(userid) REFERENCES User(id),
    FOREIGN KEY(questionid) REFERENCES Question(id)
);

--
-- Table AnswerComment
--
DROP TABLE IF EXISTS AnswerComments;
CREATE TABLE AnswerComments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "acronym" TEXT NOT NULL,
    "answerid" INTEGER NOT NULL,
    "comment" TEXT NOT NULL,
    FOREIGN KEY(userid) REFERENCES User(id),
    FOREIGN KEY(answerid) REFERENCES Answer(id)
);

INSERT INTO Tags (tag) VALUES ('Bike');
INSERT INTO Tags (tag) VALUES ('Car');
INSERT INTO Tags (tag) VALUES ('Helicopter');
INSERT INTO Tags (tag) VALUES ('Tank');
INSERT INTO Tags (tag) VALUES ('Motorbike');
INSERT INTO Tags (tag) VALUES ('Boat');
INSERT INTO Tags (tag) VALUES ('Skateboard');