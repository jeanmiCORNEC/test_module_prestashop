<?php
if (!defined('_PS_VERSION_')) {
    exit; // On vérifie si la constante numéro de version de Ps est définit pour empécher l'accés direct au module
}

class Mymodule extends Module // Pour créér un module, il faut obligatoirement 3 méthodes, construct install et uninstall
{
    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Jmi Cornec';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('my test module');
        $this->description = $this->l('My module created for testing prestashop module creation.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall ?');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }
}
