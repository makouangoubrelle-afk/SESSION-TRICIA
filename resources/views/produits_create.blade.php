@extends('welcome')

@section('content')
<div class="min-h-screen p-4 flex items-center justify-center" 
     style="background: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;">
    
    <div class="w-full max-w-2xl bg-white/10 backdrop-blur-xl border border-white/20 rounded-[3rem] p-10 shadow-2xl">
        
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Nouveau Produit</h2>
            <a href="{{ route('products.index') }}" class="bg-white/10 px-4 py-2 rounded-full text-white text-xs font-bold border border-white/20 hover:bg-white/20 transition">Retour</a>
        </div>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-1">
                <label class="text-[10px] font-black uppercase text-white/70 ml-2">Nom du produit</label>
                <input type="text" name="name" required class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none focus:border-indigo-400 transition-all">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase text-white/70 ml-2">Référence (SKU)</label>
                    <input type="text" name="barcode" class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none focus:border-indigo-400">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase text-white/70 ml-2">Fournisseur</label>
                    <input type="text" name="supplier" class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none focus:border-indigo-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase text-white/70 ml-2">Stock Initial</label>
                    <input type="number" name="current_stock" value="0" class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase text-white/70 ml-2">Seuil d'alerte</label>
                    <input type="number" name="stock_min" value="5" class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-[10px] font-black uppercase text-white/70 ml-2">Prix Unitaire (XAF)</label>
                <input type="number" name="price" required class="w-full bg-black/20 border border-white/10 rounded-2xl p-4 text-white outline-none">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white p-5 rounded-2xl font-black uppercase tracking-widest transition-all shadow-xl shadow-indigo-500/20 active:scale-95">
                Enregistrer le produit
            </button>
        </form>
    </div>
</div>
@endsection