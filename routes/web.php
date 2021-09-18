<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('scam-form');
    //return view('welcome');
	//return Redirect::to('login');
});*/

Route::get('/admin','AdminController@index');
Auth::routes();

Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('login');
});

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('users', ['uses'=>'UsersController@index', 'as'=>'users.index']);
Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

// scam types routes
/*Route::get('scamtypes', 'AgentController@index')->name('scamtypes.index');
Route::get('/scamtypes/create', 'AgentController@create')->name('scamtypes.create');
Route::post('/scamtypes/store', 'AgentController@store')->name('scamtypes.store');
Route::get('/scamtypes/{type}/edit', 'AgentController@edit')->name('scamtypes.edit');
Route::post('/scamtypes/{type}/update', 'AgentController@update')->name('scamtypes.update');
Route::delete('/scamtypes/{type}', 'AgentController@destroy')->name('scamtypes.destroy');*/

// Agents routes
Route::get('agents', 'AgentController@index')->name('agents.index');
Route::get('/agents/create', 'AgentController@create')->name('agents.create');
Route::post('/agents/store', 'AgentController@store')->name('agents.store');
Route::get('/agents/{consultant}/edit', 'AgentController@edit')->name('agents.edit');
Route::post('/agents/{consultant}/update', 'AgentController@update')->name('agents.update');
Route::delete('/agents/{consultant}', 'AgentController@destroy')->name('agents.destroy');
Route::get('/agents/{consultant}/view', 'AgentController@view')->name('agents.view');

// Pacakages routes
Route::get('packages', 'PackageController@index')->name('packages.index');
Route::get('/packages/create', 'PackageController@create')->name('packages.create');
Route::post('/packages/store', 'PackageController@store')->name('packages.store');
Route::get('/packages/{pacakage}/edit', 'PackageController@edit')->name('packages.edit');
Route::post('/packages/{pacakage}/update', 'PackageController@update')->name('packages.update');
Route::delete('/packages/{pacakage}', 'PackageController@destroy')->name('packages.destroy');
Route::get('/packages/{pacakage}/view', 'PackageController@view')->name('packages.view');

// Extensions routes
Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
Route::get('/extensions/create', 'ExtensionController@create')->name('extensions.create');
Route::post('/extensions/store', 'ExtensionController@store')->name('extensions.store');
Route::get('/extensions/{extension}/edit', 'ExtensionController@edit')->name('extensions.edit');
Route::post('/extensions/{extension}/update', 'ExtensionController@update')->name('extensions.update');
Route::delete('/extensions/{extension}', 'ExtensionController@destroy')->name('extensions.destroy');
Route::get('/extensions/{extension}/view', 'ExtensionController@view')->name('extensions.view');

// Category routes
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::post('/categories/{category}/update', 'CategoryController@update')->name('categories.update');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');
Route::get('/categories/{category}/view', 'CategoryController@view')->name('categories.view');

// CDR routes
Route::get('cdrs', 'CdrsController@index')->name('cdrs.index');
Route::get('/cdrs/create', 'CdrsController@create')->name('cdrs.create');
Route::post('/cdrs/store', 'CdrsController@store')->name('cdrs.store');
Route::get('/cdrs/{cdr}/edit', 'CdrsController@edit')->name('cdrs.edit');
Route::post('/cdrs/{cdr}/update', 'CdrsController@update')->name('cdrs.update');
Route::delete('/cdrs/{cdr}', 'CdrsController@destroy')->name('cdrs.destroy');
Route::get('/cdrs/{cdr}/view', 'CdrsController@view')->name('cdrs.view');

// Orders routes
Route::get('orders', 'OrderController@index')->name('orders.index');
Route::get('/orders/create', 'OrderController@create')->name('orders.create');
Route::post('/orders/store', 'OrderController@store')->name('orders.store');
Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
Route::post('/orders/{order}/update', 'OrderController@update')->name('orders.update');
Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
Route::get('/orders/{order}/view', 'OrderController@view')->name('orders.view');

// Customers routes
Route::get('customers', 'CustomerController@index')->name('customers.index');
Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
Route::post('/customers/store', 'CustomerController@store')->name('customers.store');
Route::get('/customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
Route::post('/customers/{customer}/update', 'CustomerController@update')->name('customers.update');
Route::delete('/customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');
Route::get('/customers/{customer}/view', 'CustomerController@view')->name('customers.view');

// scamcenters routes
/*Route::get('scamcenters', 'ScamCentersController@index')->name('scamcenters.index');
Route::get('/scamcenters/create', 'ScamCentersController@create')->name('scamcenters.create');
Route::post('/scamcenters/store', 'ScamCentersController@store')->name('scamcenters.store');
Route::get('/scamcenters/{center}/edit', 'ScamCentersController@edit')->name('scamcenters.edit');
Route::post('/scamcenters/{center}/update', 'ScamCentersController@update')->name('scamcenters.update');
Route::delete('/scamcenters/{center}', 'ScamCentersController@destroy')->name('scamcenters.destroy');
Route::get('/scamcenters/{center}/view', 'ScamCentersController@view')->name('scamcenters.view');

// agency contacts routes
Route::get('agencycontact', 'GovernmentAgenciesController@index')->name('agencycontact.index');
Route::get('/agencycontact/create', 'GovernmentAgenciesController@create')->name('agencycontact.create');
Route::post('/agencycontact/store', 'GovernmentAgenciesController@store')->name('agencycontact.store');
Route::get('/agencycontact/{agency}/edit', 'GovernmentAgenciesController@edit')->name('agencycontact.edit');
Route::post('/agencycontact/{agency}/update', 'GovernmentAgenciesController@update')->name('agencycontact.update');
Route::delete('/agencycontact/{agency}', 'GovernmentAgenciesController@destroy')->name('agencycontact.destroy');

//Route::get('users', 'UsersController@index');
//Route::get('users-list', 'UsersController@datatable');

Route::get('users', 'UsersController@index')->name('users.index');
Route::get('/users/register', 'UsersController@register')->name('users.register');
Route::post('/users/store', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::post('/users/{user}/update', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
//Route::get('users.index.dt', 'UsersController@datatable')->name('users.index.dt');

//CDR routings
Route::get('cdrs', 'CdrsController@index')->name('cdrs.index');
Route::post('cdrs', 'CdrsController@index')->name('cdrs.index');
Route::get('/cdrs/search', 'CdrsController@search')->name('cdrs.search');
Route::post('/cdrs/search', 'CdrsController@search')->name('cdrs.search');
Route::get('/cdrs/exportCdrData', 'CdrsController@exportCdrData')->name('cdrs.exportCdrData');

//Customer routings
Route::get('customers', 'CustomersController@index')->name('customers.index');
Route::get('/customers/home', 'CustomersController@home')->name('customers.home');
Route::get('/customers/create', 'CustomersController@create')->name('customers.create');
Route::get('/customers/profile', 'CustomersController@profile')->name('customers.profile');
Route::post('/customers/store', 'CustomersController@store')->name('customers.store');
Route::get('/customers/{user}/edit', 'CustomersController@edit')->name('customers.edit');
Route::post('/customers/{user}/update', 'CustomersController@update')->name('customers.update');
Route::delete('/customers/{user}', 'CustomersController@destroy')->name('customers.destroy');
Route::get('customers/changeStatus/{connection}', 'CustomersController@changeStatus')->name('customers.changeStatus');
// customer left side nav tabs

//Route::get('/customers/numbers', 'CustomersController@numbers')->name('customers.numbers');
Route::get('/customers/connections', 'CustomersController@connections')->name('customers.connections');
Route::get('/customers/outbound', 'CustomersController@outbound')->name('customers.outbound');
Route::get('/customers/call-tracking', 'CustomersController@callTracking')->name('customers.callTracking');
Route::get('/customers/phone-system', 'CustomersController@phoneSystem')->name('customers.phoneSystem');
Route::get('/customers/reports', 'CustomersController@reports')->name('customers.reports');
Route::get('/customers/billing', 'CustomersController@billing')->name('customers.billing');
Route::get('/customers/api', 'CustomersController@api')->name('customers.api');



// customer->sip connections
Route::get('connections', 'ConnectionsController@index')->name('connections.index');
Route::post('/connections/store', 'ConnectionsController@store')->name('connections.store');
Route::get('/connections/{connection}/edit', 'ConnectionsController@edit')->name('connections.edit');
Route::post('/connections/{connection}/update', 'ConnectionsController@update')->name('connections.update');
Route::delete('/connections/{connection}', 'ConnectionsController@destroy')->name('connections.destroy');
Route::get('connections/changeStatus/{connection}', 'ConnectionsController@changeStatus')->name('connections.changeStatus');

Route::post('connections/update-status', 'ConnectionsController@updateStatus')->name('connections.update-status');
Route::post('connections/save-connection', 'ConnectionsController@saveConnection')->name('connections.save-connection');

// customers->numbers

Route::get('numbers', 'NumbersController@index')->name('numbers.index');
Route::get('/numbers/{number}/edit', 'NumbersController@edit')->name('numbers.edit');
Route::post('/numbers/{number}/update', 'NumbersController@update')->name('numbers.update');

Route::get('/numbers/port-numbers', 'NumbersController@portNumbers')->name('numbers.port-numbers');
Route::get('/numbers/port-numbers/new', 'NumbersController@createPortRequest')->name('numbers.port-numbers.new');
Route::post('/numbers/store-port-number', 'NumbersController@storePortRequest')->name('numbers.store-port-number');


Route::get('/numbers/order-numbers', 'NumbersController@orderNumbers')->name('numbers.order-numbers');
Route::get('/numbers/order-history', 'NumbersController@orderHistory')->name('numbers.order-history');
Route::get('/numbers/pricing', 'NumbersController@pricing')->name('numbers.pricing');*/
