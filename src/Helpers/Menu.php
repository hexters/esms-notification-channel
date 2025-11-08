<?php 

namespace Hexters\Rolevel\Helpers;

class Menu extends Base {

    public function findKeys ($menus = []) {
        
        $keys = [];
        $subKeys = [];
        foreach($menus as $menu) {
            if(isset($menu['uniqkey'])) {
                $keys[] = $menu['uniqkey'];
            }

            if(isset($menu['childs'])) {
                if($this->findKeys($menu['childs'])) {
                    foreach($this->findKeys($menu['childs']) as $sub) {
                        $subKeys[] = $sub;
                    }
                }
            }
        }
        $result = array_merge($keys, $subKeys);
        return count($result) > 0 ? $result : null;
    }

    public function keys() {
        return $this->findKeys($this->file());
    }

    public function menus() {
        return $this->file();
    }

    

}
