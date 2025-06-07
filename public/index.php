<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="UTF-8" />
  <title>PrintLab 3D – Home</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <link rel="stylesheet" href="assets/css/global.css" />
</head>
<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-printlabs fixed-top">
    <div class="container">
      <a class="navbar-brand " href="index.html">
        <img src="assets/img/logo.png" alt="PrintLabs" class="logo-nav" />
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="store.html">Loja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact.html">Contato</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br /><br /><br />


  <main class="container mt-5">
    <div class="row">
      <article class="col-md-8">
        <h2 class="mb-4">Bem-vindo à PrintLabs</h2>
        <p class="lead">
          Transformamos suas ideias em realidade com tecnologia de ponta.
        </p>
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Prototipagem Ágil e Sob Medida</h5>
            <p class="card-text">
              Na PrintLabs, unimos rápida prototipagem e atenção aos detalhes para entregar peças 100% sob demanda. Todo
              projeto recebe ajustes personalizados, garantindo encaixes perfeitos e qualidade superior desde o primeiro
              teste até a produção final.
            </p>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Tecnologia e Materiais de Ponta</h5>
            <p class="card-text">
              Contamos com impressoras FDM e resina de alta definição, além de uma seleção de filamentos técnicos (PLA,
              PETG, ABS Reinforced) e resinas especiais. Seja para protótipos funcionais, peças de uso final ou detalhes
              estéticos, temos o material ideal para cada aplicação.
            </p>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Atendimento Nacional e Suporte Completo</h5>
            <p class="card-text">
              Atendemos clientes em todo o Brasil, de startups a grandes indústrias. Nosso time acompanha cada etapa —
              do
              briefing à entrega — oferecendo suporte técnico e logística integrada, para que você receba suas peças no
              prazo e sem complicações.
            </p>
          </div>
        </div>
      </article>


      <aside class="col-md-4">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/slides/img-printlab-semlimites.jpg" class="d-block w-100" alt="Impressão 3D" />
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides/chaveiroPochita.jpg" class="d-block w-100" alt="Produtos" />
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides/RepoCharacter.jpg" class="d-block w-100" alt="Projetos" />
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
        <br>


        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">OPINIÃO DE CLIENTES</h5>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionClientes1">
              <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Sandrinho Lindão
                  </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                  <div class="accordion-body">
                    "Melhor qualidade do mercado!"
                  </div>
                </div>
              </div>
            </div>


            <div class="accordion mt-4" id="accordionClientes2">
              <div class="accordion-item">
                <h3 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Rafael Rossa
                  </button>
                </h3>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                  <div class="accordion-body">
                    "Incrível demaize!"
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="card shadow mt-4">
            <div class="card-header bg-success text-white">
              <h5 class="mb-0">NA MÍDIA</h5>
            </div>
            <div class="card-body">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Revista Tech - Edição #123</a>
                <a href="#" class="list-group-item list-group-item-action">Blog de Inovação</a>
              </div>
            </div>
          </div>
      </aside>
    </div>
  </main>


  <footer class="bg-printlabs text-light py-4 mt-5">
    <div class="container text-center">
      <p>&copy; 2025 PrintLabs. Todos os direitos reservados.</p>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
