## ROLEVEL

Package for hendle role & permission in laravel

### Require
* Bootstrap 4

### Installation

You can install this package via composer:
```
$ composer require hexters/rolevel
```

Publish vendor from Rolevel
```
$ php artisan vendor:publish --tag=rolevel
```

Put trait to your User Model
```
<?php

namespace App;

. . .

use Hexters\Rolevel\RolevelModelTrait;

class User extends Authenticatable {

    use Notifiable, RolevelModelTrait;

    . . .
```

Installing database
```
$ php artisan migrate
```

### Getting Started

Open file menu & permission in folder `app/Roles/menu_and_permissions.php`. In this file you can set menu and permission to provide access to your application module, for example.
```
<?php

  return [
    [
      'display' => 'Menu Access', // display name
      'uniqkey' => 'module.access.index', // must uniq
      'url' => null, // URL can set null if menu have submenu
      'classId' => '', // id attribute
      'className' => '', // class style attribute
      'classIcon' => '', // font icon code

      /*
      | ------ Submenu ------
      */
      'childs' => [
        [
          'display' => 'Assign Permissions',
          'uniqkey' => 'module.access.assign.permission.index',
          'url' => '/admin/assign/permission',
          'classId' => '',
          'className' => '',
          'classIcon' => '',

          'permissions' => [
            [
              'uniqkey' => 'module.access.assign.permission.show',
              'name' => 'Detail Permissions', // title
              'description' => 'Show detail for permission' // info description
            ],

            [
              // More permission...
            ]
          ]
        ],

        [
          // More submenu...
        ]
      ]
    ],

    [
      // More menu...
    ]
  ];
```
After that please put script in your master layout, for showing menu access.

```
@if(auth()->check())
  @php
      $permissions = auth()->user()->permissions();
      $viewMenu = function($menus) use (&$viewMenu, $permissions) {
          $html = '';
          foreach($menus as $menu) {
              if(in_array($menu['uniqkey'], $permissions)) {
                  $html .= view('vendor.rolevel.menu', ['menu' => $menu, 'view' => $viewMenu]);
              }
          }
          return $html;
      }
  @endphp

  <ul>
      <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      {!! $viewMenu(rolevel()->menus()) !!}
  </ul>
@endif

@yield('content')
```
You can custom style for your menu, open blade file in `resources/views/vendor/rolevel/menu.blade.php`

You should assign role to your User account before.
```
  $user = App\User::find(1);
  $role = App\Role::find(1);

  $user->roles()->sync([ $role->id ]);
```

In your any controller you should declaration `Gate` to provide access to your module, for example
```
<?php

namespace App\Http\Controllers;

use Gate;

use Illuminate\Http\Request;

class MenuAccessController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /**
      * Get module.access.assign.permission.index from uniqkey in file menu_and_permissions.php
      */
      if(Gate::denies('module.access.assign.permission.index')) abort(403);

      return view('access.index');
    }

    . . .
```
If you have provide access to the button and any condition you can set, for example
```
@can('module.access.assign.permission.store')
  <a href="{{ url('/admin/account/create') }}">Create Account</a>
@endcan

// OR

if($user->can('module.access.assign.permission.store')) {
  // Condition
}

```
You can check [this link](https://laravel.com/docs/5.8/authorization#via-blade-templates) and [this link](https://laravel.com/docs/5.8/authorization#via-the-user-model)

Check config file in `config/rolevel.php` if you have change such as:
  * Model Role possition
  * Link admin prefix
  * Middleware for access module assign
  * Template reference

For default you can access module assign permission in `http://localhost:8000/admin/roles`
