<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock - Session Tricia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">

    <div class="w-64 h-screen bg-slate-800 text-white flex flex-col shadow-xl">
        <div class="p-6 text-2xl font-bold border-b border-slate-700">StockIntel</div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block p-3 bg-pink-600 rounded-lg flex items-center gap-3"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="#" class="block p-3 hover:bg-slate-700 rounded-lg flex items-center gap-3"><i class="fa-solid fa-box"></i> Stock</a>
            <a href="#" class="block p-3 hover:bg-slate-700 rounded-lg flex items-center gap-3"><i class="fa-solid fa-users"></i> Clients</a>
            <a href="#" class="block p-3 hover:bg-slate-700 rounded-lg flex items-center gap-3"><i class="fa-solid fa-truck"></i> Fournisseurs</a>
        </nav>
    </div>

    <div class="flex-1 overflow-y-auto">
        <header class="bg-white p-4 shadow-sm flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Mon Panel</h2>
            <div class="flex items-center gap-4">
                <span class="text-gray-500">Tricia (Admin)</span>
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
            </div>
        </header>

        <main class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-8 border-black flex items-center justify-between">
                    <div><p class="text-gray-400 text-sm">Total Produits</p><p class="text-2xl font-bold">150</p></div>
                    <i class="fa-solid fa-cube text-2xl text-gray-800"></i>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-8 border-pink-500 flex items-center justify-between">
                    <div><p class="text-gray-400 text-sm">Fournisseurs</p><p class="text-2xl font-bold">12</p></div>
                    <i class="fa-solid fa-handshake text-2xl text-pink-500"></i>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-8 border-green-500 flex items-center justify-between">
                    <div><p class="text-gray-400 text-sm">Clients</p><p class="text-2xl font-bold">45</p></div>
                    <i class="fa-solid fa-user-group text-2xl text-green-500"></i>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-8 border-blue-500 flex items-center justify-between">
                    <div><p class="text-gray-400 text-sm">Commandes</p><p class="text-2xl font-bold">89</p></div>
                    <i class="fa-solid fa-file-invoice text-2xl text-blue-500"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm h-64 flex items-center justify-center text-gray-400 border border-dashed border-gray-300">
                    [ Graphique en secteurs ici ]
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm h-64 flex items-center justify-center text-gray-400 border border-dashed border-gray-300">
                    [ Graphique en barres ici ]
                </div>
            </div>
        </main>
    </div>

</body>
</html>