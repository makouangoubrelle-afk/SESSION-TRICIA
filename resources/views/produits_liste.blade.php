@extends('welcome')

@section('content')
<div class="animate-fadeIn p-4">

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-2xl font-bold flex items-center shadow-sm border border-emerald-200 animate-bounce">
            <i class="fa-solid fa-check-circle mr-3 text-xl"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- En-tête avec Titre et Boutons d'Action --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight tracking-tighter uppercase">Stock Pro</h2>
            <p class="text-indigo-500 font-medium">Gestion d'inventaire en temps réel</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <div class="relative group">
                <button class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-3 rounded-xl flex items-center gap-2 font-bold shadow-lg transition-all">
                    <i class="fa-solid fa-download"></i> Exporter <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </button>
                <div class="absolute right-0 hidden group-hover:block w-52 bg-white rounded-2xl shadow-2xl border border-slate-100 z-50 py-3 mt-2 animate-fadeIn">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-slate-700 hover:bg-indigo-50 transition font-bold text-sm">
                        <i class="fa-solid fa-file-excel text-emerald-600"></i> Format Excel (CSV)
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-slate-300 cursor-not-allowed font-bold text-sm">
                        <i class="fa-solid fa-file-pdf text-rose-300"></i> Format PDF <span class="text-[8px] bg-slate-100 px-1 rounded text-slate-400">Bientôt</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('movements.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-xl font-bold shadow-sm transition-all flex items-center gap-2 border border-slate-200">
                <i class="fa-solid fa-clock-rotate-left"></i> Historique
            </a>

            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-violet-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus-circle"></i> Nouveau
            </a>
        </div>
    </div>

    {{-- Tableau des Produits --}}
    <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 text-indigo-900 text-xs uppercase tracking-[0.2em]">
                    <th class="py-6 px-8 font-black">Produit</th>
                    <th class="py-6 px-8 font-black">Référence</th>
                    <th class="py-6 px-8 font-black text-center">Disponibilité</th>
                    <th class="py-6 px-8 font-black text-right">Prix</th>
                    <th class="py-6 px-8 font-black text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($products ?? [] as $product)
                <tr class="hover:bg-indigo-50/30 transition-all group">
                    <td class="py-5 px-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl border border-indigo-100 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <span class="font-bold text-slate-800 text-lg tracking-tight">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="py-5 px-8">
                        <span class="font-mono text-slate-400 bg-slate-50 px-3 py-1 rounded-lg text-xs border border-slate-100">#{{ $product->barcode ?? 'N/A' }}</span>
                    </td>
                    <td class="py-5 px-8">
                        <div class="flex flex-col items-center gap-2">
                            <span class="text-sm font-black {{ $product->current_stock <= ($product->stock_min ?? 0) ? 'text-rose-500' : 'text-indigo-600' }}">
                                {{ $product->current_stock }} en stock
                            </span>
                            <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                @php 
                                    $percent = $product->current_stock > 0 ? min(($product->current_stock / (($product->stock_min ?? 1) + 10)) * 100, 100) : 0;
                                @endphp
                                <div class="h-full bg-gradient-to-r {{ $product->current_stock <= ($product->stock_min ?? 0) ? 'from-rose-500 to-orange-400' : 'from-indigo-500 to-violet-500' }}" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 px-8 text-right font-black text-slate-900 text-lg">
                        {{ number_format($product->price, 0, ',', ' ') }} <small class="text-indigo-400 text-[10px] ml-1">XAF</small>
                    </td>
                    <td class="py-5 px-8">
                        <div class="flex justify-end gap-2">
                            {{-- Bouton Code-barres --}}
                            <button title="Générer étiquette" class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 border border-amber-100 hover:bg-amber-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-barcode text-sm"></i>
                            </button>

                            {{-- Bouton Modifier --}}
                            <a href="{{ route('products.edit', $product->id) }}" class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 border border-indigo-100 hover:bg-indigo-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </a>

                            {{-- Bouton Supprimer --}}
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-lg bg-rose-50 text-rose-500 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <i class="fa-solid fa-box-open text-8xl mb-4"></i>
                            <p class="text-2xl font-black uppercase">Entrepôt Vide</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection