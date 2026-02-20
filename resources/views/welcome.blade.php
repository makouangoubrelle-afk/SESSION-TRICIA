<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#0f172a] text-white">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 border-r border-white/10 p-6">
            <h2 class="text-xl font-bold text-indigo-400 mb-8 tracking-tighter">STOCK PRO</h2>
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="block p-3 hover:bg-indigo-600 rounded-xl transition {{ Route::is('dashboard') ? 'bg-indigo-600' : '' }}">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block p-3 hover:bg-indigo-600 rounded-xl transition">Produits</a>
                <a href="{{ route('inventory.index') }}" class="block p-3 hover:bg-indigo-600 rounded-xl transition">Inventaire</a>
                <a href="{{ route('movements.index') }}" class="block p-3 hover:bg-indigo-600 rounded-xl transition">Mouvements</a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            {{-- BANDEAU D'ALERTE --}}
            @if(($alertStock ?? 0) > 0)
                <div class="mb-8 bg-rose-500/20 border border-rose-500/50 p-4 rounded-2xl flex items-center gap-4 animate-pulse">
                    <div class="bg-rose-500 p-2 rounded-lg shadow-lg">
                        <i class="fa-solid fa-triangle-exclamation text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-rose-400 font-black uppercase text-xs tracking-widest">Alerte Réapprovisionnement</h4>
                        <p class="text-white text-sm font-bold">{{ $alertStock }} produit(s) en alerte !</p>
                    </div>
                    <a href="{{ route('inventory.index') }}" class="ml-auto bg-rose-500 hover:bg-rose-400 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase transition-all">Gérer</a>
                </div>
            @endif

            @if(Route::is('dashboard'))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-slate-900/50 border-2 border-indigo-500/50 p-6 rounded-3xl shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                        <span class="text-xs uppercase font-black text-indigo-400">Articles</span>
                        <p class="text-4xl font-black mt-2">{{ $totalProducts ?? 0 }}</p>
                    </div>

                    <div class="bg-slate-900/50 border-2 border-rose-500/50 p-6 rounded-3xl shadow-[0_0_15px_rgba(244,63,94,0.2)]">
                        <span class="text-xs uppercase font-black text-rose-400">Alertes</span>
                        <p class="text-4xl font-black mt-2 text-rose-500">{{ $alertStock ?? 0 }}</p>
                    </div>

                    <div class="bg-slate-900/50 border-2 border-emerald-500/50 p-6 rounded-3xl shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                        <span class="text-xs uppercase font-black text-emerald-400">Valeur Stock</span>
                        <p class="text-4xl font-black mt-2 text-emerald-500">
                           <small class="text-xs">XAF</small> 
                           {{-- Sécurité pour éviter le crash si la table est vide --}}
                           {{ number_format(isset($totalValue) ? $totalValue : 0, 0, ',', ' ') }}
                        </p>
                    </div>
                </div>

                <div class="bg-slate-900/40 border border-white/10 p-8 rounded-[2.5rem] mb-8 shadow-2xl">
                    <h3 class="text-xl font-black mb-6 uppercase tracking-tighter text-indigo-300">Répartition du Stock</h3>
                    <div style="height: 300px;" class="flex justify-center">
                        {{-- On n'affiche le canvas que s'il y a des produits --}}
                        @if(($totalProducts ?? 0) > 0)
                            <canvas id="stockChart"></canvas>
                        @else
                            <p class="text-slate-500 flex items-center">Aucune donnée à afficher</p>
                        @endif
                    </div>
                </div>
                
                <div class="bg-white/5 p-8 rounded-[2rem] border border-white/10 shadow-2xl backdrop-blur-md">
                    <h3 class="text-xl font-black mb-6 uppercase tracking-tighter">Dernières Activités</h3>
                    @yield('content') 
                </div>
            @else
                @yield('content')
            @endif
        </main>
    </div>

    @if(Route::is('dashboard') && ($totalProducts ?? 0) > 0)
    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(\App\Models\Product::pluck('name')->take(5)) !!},
                datasets: [{
                    data: {!! json_encode(\App\Models\Product::pluck('current_stock')->take(5)) !!},
                    backgroundColor: ['#6366f1', '#f43f5e', '#10b981', '#f59e0b', '#8b5cf6'],
                    borderColor: '#0f172a',
                    borderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { color: 'white' } }
                },
                cutout: '70%'
            }
        });
    </script>
    @endif
</body>
</html>