<?php 
    include "map_knihy.php";

    $repo = new RepozitarKnih();
    $knihy = $repo->getVsechnyKnihy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam Knih</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
        .book-card {
            transition: transform 0.2s;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .book-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 991.98px) {
            .desktop-table {
                display: none;
            }
        }
        @media (min-width: 992px) {
            .mobile-cards {
                display: none;
            }
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Seznam Knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pridatKnihu.php">Přidat Knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vyhledatKnihu.php">Vyhledat Knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container py-5">
    <h1 class="display-5 mb-4">Seznam knih</h1>
    
    <!-- Desktop table view (large screens) -->
    <div class="desktop-table">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ISBN</th>
                        <th>Jméno autora</th>
                        <th>Příjmení autora</th>
                        <th>Název knihy</th>
                        <th>Popis</th>
                        <th>Obrázek obalu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($knihy as $kniha) : ?>
                    <tr>
                        <td class="align-middle"><?php echo htmlspecialchars($kniha->isbn); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($kniha->jmeno); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($kniha->prijmeni); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($kniha->nazev); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($kniha->popis); ?></td>
                        <td class="align-middle">
                            <img src="<?php echo htmlspecialchars($kniha->obrazek); ?>" 
                                 alt="Obal knihy <?php echo htmlspecialchars($kniha->nazev); ?>" 
                                 class="img-fluid" 
                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile/Tablet card view (small and medium screens) -->
    <div class="mobile-cards">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($knihy as $kniha) : ?>
            <div class="col">
                <div class="card h-100 book-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?php echo htmlspecialchars($kniha->obrazek); ?>" 
                                     alt="Obal knihy <?php echo htmlspecialchars($kniha->nazev); ?>" 
                                     class="img-fluid book-image rounded">
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><?php echo htmlspecialchars($kniha->nazev); ?></h5>
                                <p class="card-text">
                                    <strong>Autor:</strong> <?php echo htmlspecialchars($kniha->jmeno . ' ' . $kniha->prijmeni); ?><br>
                                    <strong>ISBN:</strong> <?php echo htmlspecialchars($kniha->isbn); ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="card-text">
                                <strong>Popis:</strong><br>
                                <?php echo htmlspecialchars($kniha->popis); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>