CREATE TABLE adresse (
    id_adresse SERIAL PRIMARY KEY,
    cp INTEGER,
    ville TEXT,
    nom_rue TEXT,
    num_rue TEXT
);

CREATE TABLE type (
    id_type SERIAL PRIMARY KEY,
    nom_type VARCHAR(50) UNIQUE
);

CREATE TABLE client (
    id_client SERIAL PRIMARY KEY,
    nom_client TEXT,
    prenom_client TEXT,
    email TEXT UNIQUE,
    mot_de_passe TEXT,
    telephone TEXT UNIQUE,
    id_adresse INTEGER NOT NULL REFERENCES adresse(id_adresse)
);

CREATE TABLE article (
    id_article SERIAL PRIMARY KEY,
    nom_article TEXT UNIQUE,
    description TEXT,
    prix DOUBLE PRECISION,
    stock INTEGER,
    id_type INTEGER NOT NULL REFERENCES type(id_type),
    image TEXT
);

CREATE TABLE panier (
    id_client INTEGER REFERENCES client(id_client),
    id_article INTEGER REFERENCES article(id_article),
    quantite INTEGER NOT NULL DEFAULT 1,
    statut TEXT DEFAULT 'actif',
    PRIMARY KEY (id_client, id_article)
);

CREATE TABLE commande (
    id_commande SERIAL PRIMARY KEY,
    date_commande DATE,
    date_livraison DATE,
    prix_commande DOUBLE PRECISION,
    id_client INTEGER NOT NULL REFERENCES client(id_client)
);

CREATE TABLE commande_article (
    id_article INTEGER REFERENCES article(id_article),
    id_commande INTEGER REFERENCES commande(id_commande),
    quantite INTEGER,
    prix_unitaire DOUBLE PRECISION,
    PRIMARY KEY (id_article, id_commande)
);
