@extends('welcome')

@section('content')
<div class="min-h-screen p-6 bg-[#0f172a] text-white">
    <div class="max-w-6xl mx-auto space-y-6">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black tracking-tighter uppercase text-indigo-400">État de l'Inventaire</h2>
                <p class="text-slate-400 text-sm">Vue globale et valeur de vos actifs</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-2xl text-right">
                <span class="block text-[10px] font-black uppercase text-indigo-300">Valeur Totale du Stock</span>
                <span class="text-2xl font-black text-emerald-400">
                    {{-- Correction ici : on calcule la somme directement --}}
                    {{ number_format($products->sum(fn($p) => $p->current_stock * $p->price), 0, ',', ' ') }} 
                    <small class="text-xs">XAF</small>
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 border border-white/10 p-6 rounded-[2rem] backdrop-blur-xl">
                <i class="fa-solid fa-boxes-stacked text-indigo-500 text-2xl mb-3"></i>
                <h4 class="text-white/50 text-[10px] font-black uppercase">Articles Totaux</h4>
                <p class="text-3xl font-black">{{ $products->count() }}</p>
            </div>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <table class="w-full text-left">
                <thead class="bg-white/5">
                    <tr class="text-[10px] font-black uppercase tracking-widest text-indigo-300">
                        <th class="p-6">Désignation</th>
                        <th class="p-6 text-center">Stock Actuel</th>
                        <th class="p-6 text-right">Prix Unitaire</th>
                        <th class="p-6 text-right">Valeur Stock</th>
                        <th class="p-6 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($products as $product)
                    <tr class="hover:bg-white/5 transition-all">
                        <td class="p-6">
                            <span class="block font-bold text-lg">{{ $product->name }}</span>
                            <span class="text-[10px] text-white/30 font-mono">#{{ $product->barcode }}</span>
                        </td>
                        <td class="p-6 text-center">
                            <span class="text-xl font-black">{{ $product->current_stock }}</span>
                        </td>
                        <td class="p-6 text-right font-bold text-slate-400">
                            {{ number_format($product->price, 0, ',', ' ') }}
                        </td>
                        <td class="p-6 text-right font-black text-emerald-400">
                            {{ number_format($product->current_stock * $product->price, 0, ',', ' ') }}
                        </td>
                        <td class="p-6 text-center">
                            @if($product->current_stock <= $product->stock_min)
                                <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-[10px] font-black uppercase border border-red-500/30">Réapprovisionner</span>
                            @else
                                <span class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-[10px] font-black uppercase border border-emerald-500/30">Optimisé</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection