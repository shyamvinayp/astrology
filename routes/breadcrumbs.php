<?php
// Home
/*Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push(__('home.breadcrumb'), route('home'));
});*/

Breadcrumbs::register('customers.home', function ($trail) {
    $trail->push('Customers', route('customers.home'));
});

//Customers
/*Breadcrumbs::register('admin.cities.list', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push("Cities", route('admin.cities.list'));
});*/

Breadcrumbs::register('customers.create', function($breadcrumbs) {
    $breadcrumbs->parent('customers.home');
    $breadcrumbs->push("Add Customer", route('customers.create'));
});

Breadcrumbs::register('customers.connections', function($breadcrumbs) {
    $breadcrumbs->parent('customers.home');
    $breadcrumbs->push("SIP Connections", route('customers.connections'));
});

Breadcrumbs::register('connections', function($breadcrumbs) {
    $breadcrumbs->parent('connections.index');
    $breadcrumbs->push("SIP Connections", route('connections'));
});

Breadcrumbs::for('connections.index', function ($trail) {
    $trail->push('SIP Connections', route('connections.index'));
});

/*Breadcrumbs::register('admin.cities.edit', function($breadcrumbs, $cityId) {
    $breadcrumbs->parent('admin.cities.list');
    $breadcrumbs->push("Edit City", route('admin.cities.edit', [$cityId]));
});*/

