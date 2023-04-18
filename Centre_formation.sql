CREATE DATABASE IF NOT EXISTS centre_formation;

CREATE TABLE Apprenant (
    ID_apprenant INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100),
    mot_de_passe VARCHAR(100)
);

CREATE TABLE Admin (
    ID_apprenant INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100),
    mot_de_passe VARCHAR(100)
);

CREATE TABLE Session (
    ID_session INT PRIMARY KEY AUTO_INCREMENT,
    date_debut DATE,
    date_fin DATE,
    nbr_places_max INT,
    etat_session VARCHAR (50),
    Id_formateur INT,
    Id_formation INT,
    FOREIGN KEY (Id_formateur) REFERENCES Formateur(ID_formateur),
    FOREIGN KEY (Id_formation) REFERENCES Formation(ID_formation)
);

CREATE TABLE Inscription (
    ID_apprenant INT,
    ID_session INT,
    resultat VARCHAR(50),
    date_evaluation DATE,
    PRIMARY KEY (ID_apprenant, ID_session),
    FOREIGN KEY (ID_apprenant) REFERENCES Apprenant(ID_apprenant),
    FOREIGN KEY (ID_session) REFERENCES Session(ID_session)
);

CREATE TABLE Formation (
    ID_formation INT PRIMARY KEY AUTO_INCREMENT,
    sujet VARCHAR(100),
    categorie VARCHAR (100),
    duree INT,
    description VARCHAR 
);

CREATE TABLE Formateur (
    ID_formateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100),
    mot_de_passe VARCHAR(100)
);
