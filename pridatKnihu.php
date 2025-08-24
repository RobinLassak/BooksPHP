<?php 
    include 'map_knihy.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $isbn = $_POST["isbn"] ?? "";
        $jmeno = $_POST["jmeno"] ?? "";
        $prijmeni = $_POST["prijmeni"] ?? "";
        $nazev = $_POST["nazev"] ?? "";
        $popis = $_POST["popis"] ?? "";
        $obrazek = $_POST["obrazek"] ?? "";
    
        $repo = new RepozitarKnih();
        $kniha = new Kniha($isbn, $jmeno, $prijmeni, $nazev, $popis, $obrazek);
        $repo->vytvorKnihu($kniha);
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Přidat Knihu</title>
    <style>
        .form-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-submit {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
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
                        <a class="nav-link" aria-current="page" href="index.php">Seznam Knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pridatKnihu.php">Přidat Knihu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vyhledatKnihu.php">Vyhledat Knihu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-5 text-center mb-4">Přidat novou knihu</h1>
                <div class="form-container">
                    <form action="pridatKnihu.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="isbn">ISBN:</label>
                                <input class="form-control" type="text" name="isbn" id="isbn" value="" required>
                                <div class="form-text">Zadejte ISBN knihy (např. 978-80-251-1234-5)</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="nazev">Název knihy:</label>
                                <input class="form-control" type="text" name="nazev" id="nazev" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="jmeno">Jméno autora:</label>
                                <input class="form-control" type="text" name="jmeno" id="jmeno" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="prijmeni">Příjmení autora:</label>
                                <input class="form-control" type="text" name="prijmeni" id="prijmeni" value="" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="popis">Popis knihy:</label>
                            <textarea class="form-control" name="popis" id="popis" rows="4" required></textarea>
                            <div class="form-text">Stručně popište obsah nebo téma knihy</div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="obrazek">URL obrázku obalu:</label>
                            <input class="form-control" type="url" name="obrazek" id="obrazek" value="" required>
                            <div class="form-text">Zadejte odkaz na obrázek obalu knihy</div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-submit">
                                <i class="bi bi-plus-circle me-2"></i>Přidat knihu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>