<?php

include_once DOL_DOCUMENT_ROOT . "/core/modules/DolibarrModules.class.php";

class modEcheancier extends DolibarrModules
{
    public function __construct($db)
    {
        global $langs;
        $langs->load("echeancier@echeancier");

        $this->db = $db;
        $this->numero = 104001; // Unique ID (>100000 pour les modules personnalisés)
        $this->rights_class = 'echeancier';
        $this->family = "financial";
        $this->name = preg_replace('/^mod/i', '', get_class($this));
        $this->description = "Module de gestion d'échéancier de paiement";
        $this->version = '1.0.0';
        $this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);
        $this->picto = 'bill';
        $this->module_parts = array();
        $this->dirs = array("/echeancier/temp");

        $this->config_page_url = array("setup.php@echeancier");

        // Définir le fichier SQL à exécuter lors de l'installation
        $this->sql = array(
            array('mysql' => 'sql/install.sql')
        );

        // Aucun menu pour le moment
        $this->menu = array();
    }
}
