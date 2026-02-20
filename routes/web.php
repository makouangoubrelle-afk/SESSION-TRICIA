<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// --- PARTAGE DES DONNÉES AVEC TOUTES LES VUES ---
view()->composer('*', function ($view) {
    if (Schema::hasTable('products')) {
        // Calcul de la valeur totale du stock (Prix * Quantité)
        $totalValue = Product::all()->sum(function($product) {
            return $product->current_stock * $product->price;
        });

        $view->with([
            'totalProducts' => Product::count() ?? 0,
            'alertStock'    => Product::whereColumn('current_stock', '<=', 'stock_min')->count() ?? 0,
            'totalValue'    => $totalValue
        ]);
    } else {
        $view->with([
            'totalProducts' => 0, 
            'alertStock'    => 0,
            'totalValue'    => 0
        ]);
    }
});

// --- DASHBOARD ---
Route::get('/', function () {
    $movements = Movement::with('product')->latest()->take(5)->get();
    return view('welcome', compact('movements'));
})->name('dashboard');

// --- PRODUITS ---
// Liste des produits
Route::get('/produits', function () {
    $products = Product::latest()->get();
    return view('produits_liste', compact('products'));
})->name('products.index');

// Formulaire de création
Route::get('/produits/creer', function () {
    return view('produits_create');
})->name('products.create');

// Enregistrement d'un nouveau produit
Route::post('/produits/enregistrer', function (Request $request) {
    $data = $request->validate([
        'name'          => 'required|string|max:255',
        'barcode'       => 'nullable|string|unique:products,barcode', 
        'supplier'      => 'nullable|string|max:255',
        'price'         => 'required|numeric|min:0',
        'current_stock' => 'required|integer|min:0',
        'stock_min'     => 'required|integer|min:0',
    ]);

    Product::create($data);
    return redirect()->route('products.index')->with('success', 'Article ajouté avec succès !');
})->name('products.store');

// Modifier un produit
Route::get('/produits/{id}/modifier', function ($id) {
    $product = Product::findOrFail($id);
    return view('produits_edit', compact('product'));
})->name('products.edit');

// Supprimer un produit
Route::delete('/produits/{id}', function ($id) {
    Product::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Produit supprimé !');
})->name('products.destroy');

// --- INVENTAIRE ET MOUVEMENTS ---
Route::get('/inventaire', function () {
    $products = Product::all();
    return view('inventaire_index', compact('products'));
})->name('inventory.index');

Route::get('/mouvements', function () {
    $allMovements = Movement::with('product')->latest()->get();
    return view('movements_index', compact('allMovements'));
})->name('movements.index');

// Enregistrement d'un flux (Entrée/Sortie)
Route::post('/mouvements/enregistrer', function (Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'type'       => 'required|in:Entrée,Sortie',
    ]);

    // 1. Créer le mouvement dans l'historique
    Movement::create([
        'product_id' => $request->product_id,
        'quantity'   => $request->quantity,
        'type'       => $request->type,
    ]);

    // 2. Mettre à jour le stock réel du produit
    $product = Product::find($request->product_id);
    if ($request->type == 'Entrée') {
        $product->increment('current_stock', $request->quantity);
    } else {
        $product->decrement('current_stock', $request->quantity);
    }

    return redirect()->back()->with('success', 'Flux de stock mis à jour !');
})->name('movements.store');