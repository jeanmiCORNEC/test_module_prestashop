# test prestashop

## création de module et theme perso

### module

1 on créé le module dans le dossier modules
on peut mettre un logo à la racine en .png
le fichier principal doit avoir le meme nom que le dossier du module ex: mymodule.php

2 le fichier module.php doit commencer par une vérification afin d'interdir l'accès direct au module :
if (!defined('_PS_VERSION_')) {
exit; // On vérifie si la constante numéro de version de Ps est définit pour empécher l'accés direct au module
}

3 pour un module, il faut obligatoirement 3 mèthodes :

- un construct \_\_construct()
- une installation install()
- une de désistallation uninstall()
