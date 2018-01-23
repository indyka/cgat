<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function(){
	return "<a href='".url('/')."/admin/generator'>Visit Admin</a>";
});
   
Route::auth();

Route::group(['middleware' => ['auth']], function() {



	///////////// Generator Routes //////////////////////////////////////////

	Route::get('/admin/generator',['as'=>'admin.generator','uses'=>'GeneratorController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

	Route::get('/generator/index',['as'=>'generator.index','uses'=>'GeneratorController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::get('/generator/one_to_many_add',['as'=>'generator.one_to_many_add','uses'=>'GeneratorController@one_to_many_add','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

	Route::post('/generator/getFields',['as'=>'generator.getFields','uses'=>'GeneratorController@getFields','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/getFieldsOneToMany',['as'=>'generator.getFieldsOneToMany','uses'=>'GeneratorController@getFieldsOneToMany','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/get_multi_table_html',['as'=>'generator.get_multi_table_html','uses'=>'GeneratorController@get_multi_table_html','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/get_key_dropdown',['as'=>'generator.get_key_dropdown','uses'=>'GeneratorController@get_key_dropdown','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/get_table_dropdown',['as'=>'generator.get_table_dropdown','uses'=>'GeneratorController@get_table_dropdown','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/r_get_key_value',['as'=>'generator.r_get_key_value','uses'=>'GeneratorController@r_get_key_value','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/one_many_get_key_dropdown',['as'=>'generator.one_many_get_key_dropdown','uses'=>'GeneratorController@one_many_get_key_dropdown','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/popuplate_multi_get_key_value',['as'=>'generator.popuplate_multi_get_key_value','uses'=>'GeneratorController@popuplate_multi_get_key_value','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/multi_get_key_value',['as'=>'generator.multi_get_key_value','uses'=>'GeneratorController@multi_get_key_value','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/get_multi_table_html',['as'=>'generator.get_multi_table_html','uses'=>'GeneratorController@get_multi_table_html','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

	Route::post('/generator/getKeyValue',['as'=>'generator.getKeyValue','uses'=>'GeneratorController@getKeyValue','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

	Route::post('/generator/add',['as'=>'generator.add','uses'=>'GeneratorController@add','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);

    Route::post('/generator/one_to_many_add_post',['as'=>'generator.one_to_many_add_post','uses'=>'GeneratorController@one_to_many_add_post','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	/////////// ./ Generator Routes /. //////////////////////////////////////

	Route::get('/admin/dashboard', function(){
        return view('admin/dashboard');
    });


   

   

   

    // BO : Products 

   Route::get("/admin/products/export/{type}", [ 'as'=>'admin.products.edit','uses'=>'admin\ProductsController@postEdit','middleware' => ['permission:item-list']]);

   Route::get("/admin/products/view/{id}", [ 'as'=>'admin.products.view','uses'=>'admin\ProductsController@view','middleware' => ['permission:item-list']]);

    Route::post("/admin/products/deleteAll", [ 'as'=>'admin.products.deleteAll','uses'=>'admin\ProductsController@deleteAll','middleware' => ['permission:item-delete']]);

    Route::get("/admin/products", [ 'as'=>'admin.products.index','uses'=>'admin\ProductsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::get("/admin/products/{field}/{id}/", [ 'as'=>'admin.products.index','uses'=>'admin\ProductsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::post("/admin/products/{field}/{id}/", [ 'as'=>'admin.products.index','uses'=>'admin\ProductsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::get("/admin/products/add/{field}/{id}", [ 'as'=>'admin.products.add','uses'=>'admin\ProductsController@getAdd','middleware' => ['permission:item-create']]);

    Route::get("/admin/products/add", [ 'as'=>'admin.products.add','uses'=>'admin\ProductsController@getAdd','middleware' => ['permission:item-create']]);

    Route::post("/admin/products/add/{field}/{id}", [ 'as'=>'admin.products.add','uses'=>'admin\ProductsController@postAdd','middleware' => ['permission:item-create']]);

    Route::post("/admin/products/add", [ 'as'=>'admin.products.add','uses'=>'admin\ProductsController@postAdd','middleware' => ['permission:item-create']]);

    Route::get("/admin/products/edit/{id}", [ 'as'=>'admin.products.edit','uses'=>'admin\ProductsController@getEdit','middleware' => ['permission:item-edit']]);

    Route::get("/admin/products/edit/{edit_id}/{field}/{id}", [ 'as'=>'admin.products.edit','uses'=>'admin\ProductsController@getEdit','middleware' => ['permission:item-edit']]);

    Route::get("/admin/products/status/{field}/{id}", [ 'as'=>'admin.products.edit','uses'=>'admin\ProductsController@status','middleware' => ['permission:item-edit']]);

    Route::post("/admin/products/edit", [ 'as'=>'admin.products.edit','uses'=>'admin\ProductsController@postEdit','middleware' => ['permission:item-edit']]);

    Route::post("/admin/products/delete", [ 'as'=>'admin.products.delete','uses'=>'admin\ProductsController@delete','middleware' => ['permission:item-delete']]);

    Route::post("/admin/products/delete/{field}/{id}", [ 'as'=>'admin.products.delete','uses'=>'admin\ProductsController@delete','middleware' => ['permission:item-delete']]);

     // EO : Products 

   

    // BO : Category 

    Route::post("/admin/category/deleteAll", [ 'as'=>'admin.category.deleteAll','uses'=>'admin\CategoryController@deleteAll','middleware' => ['permission:item-delete']]);
    Route::get("/admin/category", [ 'as'=>'admin.category.index','uses'=>'admin\CategoryController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
    Route::get("/admin/category/add", [ 'as'=>'admin.category.add','uses'=>'admin\CategoryController@getAdd','middleware' => ['permission:item-create']]);
    Route::post("/admin/category/add", [ 'as'=>'admin.category.add','uses'=>'admin\CategoryController@postAdd','middleware' => ['permission:item-create']]);
    Route::get("/admin/category/edit/{id}", [ 'as'=>'admin.category.edit','uses'=>'admin\CategoryController@getEdit','middleware' => ['permission:item-edit']]);
    Route::get("/admin/category/status/{field}/{id}", [ 'as'=>'admin.category.edit','uses'=>'admin\CategoryController@status','middleware' => ['permission:item-edit']]);
    Route::get("/admin/category/export/{type}", [ 'as'=>'admin.category.edit','uses'=>'admin\CategoryController@getExport','middleware' => ['permission:item-list']]);
    Route::post("/admin/category/edit", [ 'as'=>'admin.category.edit','uses'=>'admin\CategoryController@postEdit','middleware' => ['permission:item-edit']]);
    Route::post("/admin/category/delete", [ 'as'=>'admin.category.delete','uses'=>'admin\CategoryController@delete','middleware' => ['permission:item-delete']]);
    Route::get("/admin/category/view/{id}", [ 'as'=>'admin.category.edit','uses'=>'admin\CategoryController@view','middleware' => ['permission:item-list']]);

     // EO : Category

   

    // BO : Items 

   Route::get("/admin/items/export/{type}", [ 'as'=>'admin.items.edit','uses'=>'admin\ItemsController@postEdit','middleware' => ['permission:item-list']]);

   Route::get("/admin/items/view/{id}", [ 'as'=>'admin.items.view','uses'=>'admin\ItemsController@view','middleware' => ['permission:item-list']]);

    Route::post("/admin/items/deleteAll", [ 'as'=>'admin.items.deleteAll','uses'=>'admin\ItemsController@deleteAll','middleware' => ['permission:item-delete']]);

    Route::get("/admin/items", [ 'as'=>'admin.items.index','uses'=>'admin\ItemsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::get("/admin/items/{field}/{id}/", [ 'as'=>'admin.items.index','uses'=>'admin\ItemsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::post("/admin/items/{field}/{id}/", [ 'as'=>'admin.items.index','uses'=>'admin\ItemsController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);

    Route::get("/admin/items/add/{field}/{id}", [ 'as'=>'admin.items.add','uses'=>'admin\ItemsController@getAdd','middleware' => ['permission:item-create']]);

    Route::get("/admin/items/add", [ 'as'=>'admin.items.add','uses'=>'admin\ItemsController@getAdd','middleware' => ['permission:item-create']]);

    Route::post("/admin/items/add/{field}/{id}", [ 'as'=>'admin.items.add','uses'=>'admin\ItemsController@postAdd','middleware' => ['permission:item-create']]);

    Route::post("/admin/items/add", [ 'as'=>'admin.items.add','uses'=>'admin\ItemsController@postAdd','middleware' => ['permission:item-create']]);

    Route::get("/admin/items/edit/{id}", [ 'as'=>'admin.items.edit','uses'=>'admin\ItemsController@getEdit','middleware' => ['permission:item-edit']]);

    Route::get("/admin/items/edit/{edit_id}/{field}/{id}", [ 'as'=>'admin.items.edit','uses'=>'admin\ItemsController@getEdit','middleware' => ['permission:item-edit']]);

    Route::get("/admin/items/status/{field}/{id}", [ 'as'=>'admin.items.edit','uses'=>'admin\ItemsController@status','middleware' => ['permission:item-edit']]);

    Route::post("/admin/items/edit", [ 'as'=>'admin.items.edit','uses'=>'admin\ItemsController@postEdit','middleware' => ['permission:item-edit']]);

    Route::post("/admin/items/delete", [ 'as'=>'admin.items.delete','uses'=>'admin\ItemsController@delete','middleware' => ['permission:item-delete']]);

    Route::post("/admin/items/delete/{field}/{id}", [ 'as'=>'admin.items.delete','uses'=>'admin\ItemsController@delete','middleware' => ['permission:item-delete']]);

     // EO : Items 

   

    // BO : Demo 

    Route::post("/admin/demo/deleteAll", [ 'as'=>'admin.demo.deleteAll','uses'=>'admin\DemoController@deleteAll','middleware' => ['permission:item-delete']]);
    Route::get("/admin/demo", [ 'as'=>'admin.demo.index','uses'=>'admin\DemoController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
    Route::get("/admin/demo/add", [ 'as'=>'admin.demo.add','uses'=>'admin\DemoController@getAdd','middleware' => ['permission:item-create']]);
    Route::post("/admin/demo/add", [ 'as'=>'admin.demo.add','uses'=>'admin\DemoController@postAdd','middleware' => ['permission:item-create']]);
    Route::get("/admin/demo/edit/{id}", [ 'as'=>'admin.demo.edit','uses'=>'admin\DemoController@getEdit','middleware' => ['permission:item-edit']]);
    Route::get("/admin/demo/status/{field}/{id}", [ 'as'=>'admin.demo.edit','uses'=>'admin\DemoController@status','middleware' => ['permission:item-edit']]);
    Route::get("/admin/demo/export/{type}", [ 'as'=>'admin.demo.edit','uses'=>'admin\DemoController@getExport','middleware' => ['permission:item-list']]);
    Route::post("/admin/demo/edit", [ 'as'=>'admin.demo.edit','uses'=>'admin\DemoController@postEdit','middleware' => ['permission:item-edit']]);
    Route::post("/admin/demo/delete", [ 'as'=>'admin.demo.delete','uses'=>'admin\DemoController@delete','middleware' => ['permission:item-delete']]);
    Route::get("/admin/demo/view/{id}", [ 'as'=>'admin.demo.edit','uses'=>'admin\DemoController@view','middleware' => ['permission:item-list']]);

     // EO : Demo

   

    // BO : Pages 

    Route::post("/admin/pages/deleteAll", [ 'as'=>'admin.pages.deleteAll','uses'=>'admin\PagesController@deleteAll','middleware' => ['permission:item-delete']]);
    Route::get("/admin/pages", [ 'as'=>'admin.pages.index','uses'=>'admin\PagesController@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
    Route::get("/admin/pages/add", [ 'as'=>'admin.pages.add','uses'=>'admin\PagesController@getAdd','middleware' => ['permission:item-create']]);
    Route::post("/admin/pages/add", [ 'as'=>'admin.pages.add','uses'=>'admin\PagesController@postAdd','middleware' => ['permission:item-create']]);
    Route::get("/admin/pages/edit/{id}", [ 'as'=>'admin.pages.edit','uses'=>'admin\PagesController@getEdit','middleware' => ['permission:item-edit']]);
    Route::get("/admin/pages/status/{field}/{id}", [ 'as'=>'admin.pages.edit','uses'=>'admin\PagesController@status','middleware' => ['permission:item-edit']]);
    Route::get("/admin/pages/export/{type}", [ 'as'=>'admin.pages.edit','uses'=>'admin\PagesController@getExport','middleware' => ['permission:item-list']]);
    Route::post("/admin/pages/edit", [ 'as'=>'admin.pages.edit','uses'=>'admin\PagesController@postEdit','middleware' => ['permission:item-edit']]);
    Route::post("/admin/pages/delete", [ 'as'=>'admin.pages.delete','uses'=>'admin\PagesController@delete','middleware' => ['permission:item-delete']]);
    Route::get("/admin/pages/view/{id}", [ 'as'=>'admin.pages.edit','uses'=>'admin\PagesController@view','middleware' => ['permission:item-list']]);

     // EO : Pages

   // @@@@@#####@@@@@

    

    

    

    

    

    

    

    

    


	Route::get('/home', 'HomeController@index');

	Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => ['permission:role-create']]);
	Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => ['permission:role-create']]);
	Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show']);
	Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('users/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => ['permission:role-edit']]);
	Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
	Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
	Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
	Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
	Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
	Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
	Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);

});

