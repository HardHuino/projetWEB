-- Créer la base de données
CREATE DATABASE IF NOT EXISTS WEBgame;
USE WEBgame;

-- Table des rooms
CREATE TABLE IF NOT EXISTS rooms (
    roomCode VARCHAR(10) PRIMARY KEY
);

-- Table des joueurs
CREATE TABLE IF NOT EXISTS players (
    displayName VARCHAR(50) NOT NULL,
    roomCode VARCHAR(10) NOT NULL,
    FOREIGN KEY (roomCode) REFERENCES rooms(roomCode),
    PRIMARY KEY (displayName, roomCode)
);

-- Table des questions
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    questionText TEXT NOT NULL
);

-- Table des réponses
CREATE TABLE IF NOT EXISTS answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    displayName VARCHAR(50) NOT NULL,
    questionId INT,
    answerText TEXT NOT NULL,
    FOREIGN KEY (questionId) REFERENCES questions(id),
    FOREIGN KEY (displayName) REFERENCES players(displayName)
);

-- Insérer des rooms de test
INSERT INTO rooms VALUES
    ("AAA"),
    ("BBB"),
    ("CCC");

-- Insérer des questions de test
INSERT INTO questions (id, questionText) VALUES
    (1, "As-tu mangé aujourd'hui ?"),
    (2, "Quel est ton fruit préféré ?"),
    (3, "Quel est le plus grand océan ?");
