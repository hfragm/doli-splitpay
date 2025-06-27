CREATE TABLE IF NOT EXISTS llx_echeancier (
    rowid INT AUTO_INCREMENT PRIMARY KEY,
    fk_facture INT NOT NULL,
    date_echeance DATE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    statut VARCHAR(20) DEFAULT 'en attente',
    date_paiement DATE DEFAULT NULL,
    note TEXT,
    entity INT DEFAULT 1
) ENGINE=innodb DEFAULT CHARSET=utf8mb4;
