@extends('welcome')

@section('content')
<div class="min-h-screen p-6 text-white" style="background: radial-gradient(circle at top, #1e1b4b, #111827);">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <div class="flex items-center gap-4 mb-6">
            <div class="bg-indigo-500/20 p-4 rounded-3xl border border-indigo-400/30">
                <i class="fa-solid fa-arrow-right-arrow-left text-2xl text-indigo-300"></i>
            </div>
            <div>
                <h2 class="text-3xl font-black uppercase tracking-tighter">Flux de Stock</h2>
                <p class="text-indigo-200/50 text-sm font-bold">Entrées (+) et Sorties (-)</p>
            </div>
        </div>

        {{-- Section Formulaire --}}
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 shadow-2xl">
            <form action="{{ route('movements.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-indigo-200 mb-2 tracking-widest">Produit</label>
                    <select name="product_id" required class="w-full bg-indigo-950/40 border border-indigo-400/30 rounded-2xl p-3 text-white outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Dispo: {{ $product->current_stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-indigo-200 mb-2 tracking-widest">Quantité</label>
                    <input type="number" name="quantity" min="1" required class="w-full bg-indigo-950/40 border border-indigo-400/30 rounded-2xl p-3 text-white outline-none" placeholder="0">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-indigo-200 mb-2 tracking-widest">Opération</label>
                    <select name="type" required class="w-full bg-indigo-950/40 border border-indigo-400/30 rounded-2xl p-3 text-white outline-none">
                        <option value="Entrée">Entrée (+)</option>
                        <option value="Sortie">Sortie (-)</option>
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white p-3.5 rounded-2xl font-black text-xs uppercase transition-all shadow-lg active:scale-95">
                    Valider le flux
                </button>
            </form>
        </div>

        {{-- Section Tableau --}}
        <div class="bg-indigo-950/30 backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <table class="w-full text-left">
                <thead class="bg-white/5">
                    <tr class="text-[10px] uppercase font-black text-indigo-300 tracking-[0.2em]">
                        <th class="p-6">Date</th>
                        <th class="p-6">Produit</th>
                        <th class="p-6 text-center">Type</th>
                        <th class="p-6 text-right">Mouvement</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    {{-- Utilisation de collect() pour éviter l'erreur si la variable est vide --}}
                    @forelse($allMovements ?? [] as $movement)
                    <tr class="hover:bg-white/5 transition-all">
                        <td class="p-6 text-indigo-200/50 text-xs font-bold">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-6 font-black text-white uppercase tracking-tight">{{ $movement->product->name ?? 'Produit supprimé' }}</td>
                        <td class="p-6 text-center">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase {{ $movement->type == 'Entrée' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                {{ $movement->type }}
                            </span>
                        </td>
                        <td class="p-6 text-right font-black text-lg {{ $movement->type == 'Entrée' ? 'text-emerald-400' : 'text-rose-400' }}">
                            {{ $movement->type == 'Entrée' ? '+' : '-' }} {{ $movement->quantity }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center text-indigo-300/40 font-bold uppercase text-xs">Aucun historique de mouvement</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection