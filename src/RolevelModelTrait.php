<?php 

namespace Hexters\Rolevel;

trait RolevelModelTrait {

    public function roles () {
        return $this->belongsToMany(config('rolevel.models.roles'));
    }

    public function permissions() {
        $role = $this->roles()->first();
        if($role) {
            return $role->permissions;
        }

        return [];
    }
}