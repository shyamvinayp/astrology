<?php
// Home
/*Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push(__('home.breadcrumb'), route('home'));
});*/

Breadcrumbs::register('customers.home', function ($trail) {
    $trail->push('Title Here', route('customers.home'));
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

/*Breadcrumbs::register('admin.cities.edit', function($breadcrumbs, $cityId) {
    $breadcrumbs->parent('admin.cities.list');
    $breadcrumbs->push("Edit City", route('admin.cities.edit', [$cityId]));
});*/

