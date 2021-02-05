<?php
if (!defined('_PS_VERSION_')) {
    exit; // On vérifie si la constante numéro de version de Ps est définit pour empécher l'accés direct au module
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface; // On rend le module compatible avec les widgets

// Pour créér un module, il faut obligatoirement 3 méthodes, construct install et uninstall

class Mymodule extends Module implements WidgetInterface
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

    public function install()
    {
        /**
         * vérifie si la fonction multistore est activée et si c'est le cas, attribue le context actuel a tous les magasins de cette installation de PS
         */
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        /**
         * Vérifie si le module parent est installé
         * vérifie si le module peut être attaché au hook colonne de gauche
         * vérifie si le module peut être attaché au hook header
         * créé la configuration MYMODULE_NAME et lui attibue la valeur "my friend"
         */
        if (!parent::install() ||
            !$this->registerHook('leftColumn') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('MYMODULE_NAME', 'my friend')
            ) {
            return false;
        }
        return true;
    }

    /**
     * @throws  PrestaShopException
     *
     * @return bool
     */
    public function uninstall()
    {
        if (!parent::uninstall() || // ici on fait l'inverse de l'install, si on a créé une table ds la bdd on l'enleve, si on a créé des dossiers on les enleves etc

            !Configuration::deleteByName('MYMODULE_NAME')
            ) {
            return false;
        }
        return true;
    }
    // {widget name="mymodule"}
    public function hookHeader($params) // mêthode qui  va être "accochée" sur le hook header
    {
        return "hello from " . $this->name;
        Hook::coreRenderWidget("mymodule", "header", $params);
    }

    // Hook::exec("mymodule");
    public function renderWidget($hookName, array $configuration)
    {
        return "hello from a widget";
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
    }
}
