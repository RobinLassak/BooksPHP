<?php
include 'map_knihy.php';
$repo = new RepozitarKnih();
$knihy = [];
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : '';
    $jmeno = isset($_POST['jmeno']) ? trim($_POST['jmeno']) : '';
    $prijmeni = isset($_POST['prijmeni']) ? trim($_POST['prijmeni']) : '';
    $nazev = isset($_POST['nazev']) ? trim($_POST['nazev']) : '';

    
    if (empty($isbn) && empty($jmeno) && empty($prijmeni) && empty($nazev)) {
        $errorMessage = 'Musíte zadat alespoň jednu hodnotu pro vyhledávání.';
    } else {
        
        $knihy = $repo->najdiKnihu($isbn, $jmeno, $prijmeni, $nazev);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Vyhledat Knihu</title>
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
        .search-form {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
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
                    <a class="nav-link" href="index.php">Seznam Knih</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pridatKnihu.php">Přidat Knihu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="vyhledatKnihu.php">Vyhledat Knihu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-5">
    <h1 class="display-5 mb-4">Vyhledávání knih</h1>
    
    <div class="search-form">
        <form action="vyhledatKnihu.php" method="post">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                    <label class="form-label" for="prijmeni">Příjmení autora:</label>
                    <input class="form-control" type="text" name="prijmeni" id="prijmeni" value="<?php echo isset($_POST['prijmeni']) ? htmlspecialchars($_POST['prijmeni']) : ''; ?>" placeholder="Zadejte příjmení autora">
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <label class="form-label" for="jmeno">Jméno autora:</label>
                    <input class="form-control" type="text" name="jmeno" id="jmeno" value="<?php echo isset($_POST['jmeno']) ? htmlspecialchars($_POST['jmeno']) : ''; ?>" placeholder="Zadejte jméno autora">
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <label class="form-label" for="nazev">Název knihy:</label>
                    <input class="form-control" type="text" name="nazev" id="nazev" value="<?php echo isset($_POST['nazev']) ? htmlspecialchars($_POST['nazev']) : ''; ?>" placeholder="Zadejte název knihy">
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <label class="form-label" for="isbn">ISBN:</label>
                    <input class="form-control" type="text" name="isbn" id="isbn" value="<?php echo isset($_POST['isbn']) ? htmlspecialchars($_POST['isbn']) : ''; ?>" placeholder="Zadejte ISBN">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Vyhledat</button>
            </div>
        </form>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($knihy)): ?>
        <h2 class="display-6 mb-4">Výsledky vyhledávání (<?php echo count($knihy); ?> knih)</h2>
        
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($knihy as $kniha): ?>
                            <tr>
                                <td class="align-middle"><?php echo htmlspecialchars($kniha->isbn); ?></td>
                                <td class="align-middle"><?php echo htmlspecialchars($kniha->jmeno); ?></td>
                                <td class="align-middle"><?php echo htmlspecialchars($kniha->prijmeni); ?></td>
                                <td class="align-middle"><?php echo htmlspecialchars($kniha->nazev); ?></td>
                                <td class="align-middle"><?php echo htmlspecialchars($kniha->popis); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile/Tablet card view (small and medium screens) -->
        <div class="mobile-cards">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($knihy as $kniha): ?>
                <div class="col">
                    <div class="card h-100 book-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($kniha->nazev); ?></h5>
                            <p class="card-text">
                                <strong>Autor:</strong> <?php echo htmlspecialchars($kniha->jmeno . ' ' . $kniha->prijmeni); ?><br>
                                <strong>ISBN:</strong> <?php echo htmlspecialchars($kniha->isbn); ?>
                            </p>
                            <p class="card-text">
                                <strong>Popis:</strong><br>
                                <?php echo htmlspecialchars($kniha->popis); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errorMessage)): ?>
        <div class="alert alert-info text-center">
            <h4>Žádné výsledky</h4>
            <p>Nebyly nalezeny žádné knihy odpovídající zadaným kritériím.</p>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
