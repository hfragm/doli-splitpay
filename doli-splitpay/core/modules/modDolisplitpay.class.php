<?php

include_once DOL_DOCUMENT_ROOT . "/core/modules/DolibarrModules.class.php";

class modDolisplitpay extends DolibarrModules
{
    public function __construct($db)
    {
        global $langs;
        $langs->load("dolisplitpay@dolisplitpay");

        $this->db = $db;
        $this->numero = 104001;
        $this->rights_class = 'dolisplitpay';
        $this->family = "financial";
        $this->name = preg_replace('/^mod/i', '', get_class($this));
        $this->description = "Module de gestion d'échéancier de paiement (fractionnement)";
        $this->version = '1.0.0';
        $this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);
        $this->picto = 'bill';
        $this->module_parts = array();
        $this->dirs = array("/doli-splitpay/temp");
        $this->config_page_url = array("setup.php@doli-splitpay");

        $this->sql = array(
            array('mysql' => 'sql/install.sql')
        );

        $this->menu = array();
    }
}

$this->module_parts = array(
    'hooks' => array('invoicecard')
);