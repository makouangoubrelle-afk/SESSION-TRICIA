<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>StockIntel - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: #f4f7f6;">
    <div class="d-flex">
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4>StockIntel</h4>
            <nav class="nav flex-column mt-4">
                {{-- Voici comment on crée les liens vers les routes --}}
                <a class="nav-link text-white" href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
                <a class="nav-link text-white" href="{{ route('produits.index') }}"><i class="fas fa-box me-2"></i> Produits</a>
            </nav>
        </div>

        <div class="p-4 w-100">
            <h1>Tableau de Bord</h1>
            <p>Bienvenue sur votre gestion de stock.</p>
        </div>
    </div>
</body>
</html>