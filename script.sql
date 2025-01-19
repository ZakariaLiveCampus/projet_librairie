CREATE TABLE Categorie (
    id CHARACTER(36) PRIMARY KEY,
    nom VARCHAR(48) NOT NULL
);

CREATE TABLE Produit (
    id VARCHAR(13) PRIMARY KEY,
    nom VARCHAR(48) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    id_categorie CHAR(36) NOT NULL
);

CREATE TABLE Utilisateur (
    id CHARACTER(36) PRIMARY KEY,
    nom VARCHAR(48) NOT NULL,
    prenom VARCHAR(48) NOT NULL,
    email VARCHAR(240) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(48) NOT NULL,
    role VARCHAR(48) NOT NULL
);

CREATE TABLE Commande (
    id CHARACTER(36) PRIMARY KEY,
    id_utilisateur CHARACTER(36) NOT NULL,
    date_commande TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    statut VARCHAR(48) NOT NULL
);

CREATE TABLE Commande_Produit (
    id CHARACTER(36) PRIMARY KEY,
    id_commande CHARACTER(36) NOT NULL,
    id_produit VARCHAR(13) NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL
);

ALTER TABLE Produit 
ADD CONSTRAINT fk_produit_categorie 
FOREIGN KEY (id_categorie) REFERENCES Categorie(id) ON DELETE CASCADE;

ALTER TABLE Commande 
ADD CONSTRAINT fk_commande_utilisateur 
FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id) ON DELETE CASCADE;

ALTER TABLE Commande_Produit 
ADD CONSTRAINT fk_commande_produit_commande 
FOREIGN KEY (id_commande) REFERENCES Commande(id) ON DELETE CASCADE;

ALTER TABLE Commande_Produit 
ADD CONSTRAINT fk_commande_produit_produit 
FOREIGN KEY (id_produit) REFERENCES Produit(id) ON DELETE CASCADE;

