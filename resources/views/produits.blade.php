<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

// Route pour le Dashboard
Route::get('/', function () {
    $products = Product::paginate(20);
    return view('prototype', compact('products'));
})->name('dashboard');

// Route pour la page Produits
Route::get('/nos-produits', function () {
    $products = Product::paginate(20);
    return view('produits', compact('products'));
})->name('produits.index');