-- Créer la base de données
CREATE DATABASE IF NOT EXISTS WEBgame;
USE WEBgame;

-- Table des rooms
CREATE TABLE IF NOT EXISTS rooms (
    roomCode VARCHAR(10) PRIMARY KEY,
    questionText TEXT NOT NULL
);

-- Table des joueurs
CREATE TABLE IF NOT EXISTS players (
    displayName VARCHAR(50) NOT NULL,
    roomCode VARCHAR(10) NOT NULL,
    FOREIGN KEY (roomCode) REFERENCES rooms(roomCode),
    PRIMARY KEY (displayName, roomCode)
);

-- Table des réponses
CREATE TABLE IF NOT EXISTS answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    displayName VARCHAR(50) NOT NULL,
    -- questionId INT,
    answerText TEXT NOT NULL,
    roomCode VARCHAR(10) NOT NULL,
    timeSent TIMESTAMP NOT NULL,
    -- FOREIGN KEY (questionId) REFERENCES questions(id),
    FOREIGN KEY (displayName) REFERENCES players(displayName),
    FOREIGN KEY (roomCode) REFERENCES rooms(roomCode)
);

-- Table des comptes
CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insérer des rooms de test
INSERT INTO rooms VALUES
    ("AAA", "As-tu mange aujourd'hui ?"),
    ("BBB", "Quel est ton fruit prefere ?"),
    ("CCC", "Quel est le plus grand ocean ?");
