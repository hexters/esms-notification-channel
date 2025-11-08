<?php 

namespace Hexters\Rolevel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Hexters\Rolevel\Helpers\Menu;
use Gate;

class RolevelAssignController extends BaseController {

    protected $role;
    protected $menu;

    public function __construct(Menu $menu) {
        $this->role = app()->make(config('rolevel.models.roles'));
        $this->menu = $menu;
    }

    public function assign () {

        if (Gate::denies('module.access.assign.permission.index')) abort(403);

        $data['roles'] = $this->role->all();
        return view('rolevel::assign.index', $data);
    }

    public function detail($id) {

        if (Gate::denies('module.access.assign.permission.show')) abort(403);

        $data['role'] = $this->role->findOrFail($id);
        $data['menu'] = $this->menu;
        return view('rolevel::assign.detail', $data);
    }

    public function assigned(Request $request, $id) {

        if (Gate::denies('module.access.assign.permission.show')) abort(403);

        $role = $this->role->findOrFail($id);
        $permissions = isset( $request->uniqkeys) ?  $request->uniqkeys : [];
        $role->update([
            'permissions' => $permissions
        ]);
        return redirect()->back();
    }

}