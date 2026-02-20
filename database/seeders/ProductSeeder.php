<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Importation du modèle Product

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Produit 1 : Stock Normal
        Product::create([
            'name' => 'Ordinateur Portable Dell Latitude',
            'description' => 'Ecran 14 pouces, Core i7, 16GB RAM, SSD 512GB',
            'barcode' => 'DELL-LAT-001',
            'supplier' => 'Dell France',
            'price' => 1250.00,
            'stock_min' => 2,
            'stock_optimal' => 10,
            'current_stock' => 8,
        ]);

        // Produit 2 : Stock Critique (Alerte)
        Product::create([
            'name' => 'Souris Sans Fil Logitech MX',
            'description' => 'Souris ergonomique haute précision',
            'barcode' => 'LOGI-MX-99',
            'supplier' => 'LogiDistri',
            'price' => 85.50,
            'stock_min' => 5,
            'stock_optimal' => 20,
            'current_stock' => 3, // <--- Déclenchera l'alerte
        ]);

        // Produit 3 : Stock Optimal
        Product::create([
            'name' => 'Clavier Mécanique Razer',
            'description' => 'Clavier RGB Gamer switchs rouges',
            'barcode' => 'RAZ-KBD-05',
            'supplier' => 'Gaming Gear Corp',
            'price' => 145.00,
            'stock_min' => 3,
            'stock_optimal' => 15,
            'current_stock' => 15,
        ]);

        // Produit 4 : Nouveau Produit (Stock bas)
        Product::create([
            'name' => 'Ecran 27 pouces Samsung',
            'description' => 'Dalle incurvée 144Hz 1ms',
            'barcode' => 'SAM-27-CURV',
            'supplier' => 'Samsung Electronics',
            'price' => 299.99,
            'stock_min' => 2,
            'stock_optimal' => 8,
            'current_stock' => 2, // <--- Déclenchera l'alerte
        ]);

        // Produit 5 : Accessoire
        Product::create([
            'name' => 'Câble HDMI 2.1 - 2 mètres',
            'description' => 'Câble haute vitesse 4K/8K',
            'barcode' => 'HDMI-21-8K',
            'supplier' => 'Connectique Pro',
            'price' => 19.90,
            'stock_min' => 10,
            'stock_optimal' => 50,
            'current_stock' => 45,
        ]);
    }
}
