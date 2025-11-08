<?php 

	return [
		[
			'display' => ' Module Access',
			'uniqkey' => 'module.access',
			'url' => null,
			'classId' => '',
			'className' => '',
			'classIcon' => '',
			/*
			|--------------------------------------------------------------------------
			| Property Permission
			|--------------------------------------------------------------------------
			|
			| This is option for accessing permission of module
			|
			*/
			'permissions' => [],
			/*
			|--------------------------------------------------------------------------
			| Property Submenu
			|--------------------------------------------------------------------------
			|
			| If this menu have submenu
			|
			*/
			'childs' => [
				[
					'display' => 'Assign Permissions',
					'uniqkey' => 'module.access.assign.permission.index',
					'url' => '/admin/roles',
					'classId' => '',
					'className' => '',
					'classIcon' => '',
					/*
					|--------------------------------------------------------------------------
					| Property Permission
					|--------------------------------------------------------------------------
					|
					| You can set for rest full method Show, Update, Edit, Delete, and Store
					|
					*/
					'permissions' => [
						[
							'uniqkey' => 'module.access.assign.permission.show',
							'name' => 'Show detail role',
							'description' => 'Module for assign permission to any module'
						]

					]
				]
			]
		]	
	];