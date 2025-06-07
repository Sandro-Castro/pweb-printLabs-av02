<?php
  
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintLabs - Loja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="assets/css/store.css">
    <link rel="stylesheet" href="assets/css/global.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-printlabs fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/img/logo.png" alt="PrintLabs" class="logo-nav">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="store.html">Loja</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link " href="contact.html">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="container mt-5">
        <h1 class="page-title display-4  text-center mb-1">Produtos disponíveis</h1>
    </header>

    <section class="container mb-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Promoção Relâmpago! ⚡</h4>
        <p class="mb-0">Frete grátis para todos os pedidos acima de R$ 200,00</p>
    </div>
    </section>

    <main class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/ChaveiroPochita/chaveiro.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/R.E.P.O/RepoCharacter.jpg" 
                     class="card-img-top" 
                    >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Action figure R.E.P.O</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/ChaveiroPochita/chaveiro.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/R.E.P.O/RepoCharacter.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/ChaveiroPochita/chaveiro.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/R.E.P.O/RepoCharacter.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/ChaveiroPochita/chaveiro.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 product-card">
                <img src="assets/img/products/R.E.P.O/RepoCharacter.jpg" 
                     class="card-img-top" 
                     >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-5 fw-bold">Chaveiro Pochita</h5>
                    <p class="card-text h4 text-success">R$ 99,90</p>
                    <div class="mt-auto">
                        <button class="btn btn-detalhes w-100 mb-2">
                            <i class="fas fa-info-circle me-2"></i>Detalhes
                        </button>
                        <button class="btn btn-comprar w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Adicionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</main>

    <footer class="bg-printlabs text-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2025 PrintLabs. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>
