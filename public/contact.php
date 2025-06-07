<?php
  
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintLabs - Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/js/contact.js">


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

    
    <main class="container mt-5 pt-5">
        <div class="row g-4">

            <div class="col-lg-6">
                <div class=" h-100 contact-card p-4 shadow">
                    <h2 class="mb-4"><i class="fas fa-envelope me-2"></i>Entre em Contato</h2>
                    <br>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option>Santa Catarina</option>
                                <option>Paraná</option>
                                <option>Rio Grande do Sul</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensagem</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-printlabs w-100">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="map-container shadow h-100">
                    <div id="map" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-printlabs text-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2025 PrintLabs. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script 
        src="assets/js/contact.js"
    ></script>
</body>

</html>
