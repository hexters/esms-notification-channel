<?php 

namespace Hexters\Rolevel\Helpers;

class Permission extends Base {

    public function findKeys ($menus = []) {
        $permissions = [];
        $childPermissions = [];
        foreach($menus as $menu) {
            $permissions[] = $menu['uniqkey'];
            if(isset($menu['permissions']) && is_array($menu['permissions'])) {
                foreach($menu['permissions'] as $permission) {
                    if(isset($permission['uniqkey'])) {
                        $permissions[] = $permission['uniqkey'];
                    }
                }
            }

            if(isset($menu['childs'])) {
                if($this->findKeys($menu['childs'])) {
                    foreach($this->findKeys($menu['childs']) as $child) {
                        $childPermissions[] = $child;
                    }
                }
            }
        }
        $result = array_merge($permissions, $childPermissions);
        return count($result) > 0 ? $result : null;
    }

    public function keys() {
        return $this->findKeys($this->file());
    }

}