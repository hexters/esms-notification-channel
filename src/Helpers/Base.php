<?php 

namespace Hexters\Rolevel\Helpers;

class Base {

    public function file () : Array {
        return include( app_path('/Roles/menu_and_permissions.php') );
    }

}