<!doctype html>
<html lang="en">

<head>
    <title>Catálogo</title>
    <link rel="icon" type="image/x-icon" href="../img/nova-logo_quadrado.png">
    <!-- META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- BOOTSTRAP CSS -->
    <link href="../Boostrap/bootstrap.css" rel="stylesheet" />
    <link href="./Catalogo.css" rel="stylesheet" />
</head>

<body>
    <!-- NAVBAR -->
    <nav class="nav-cat">
        <img class="logo_navbar" src="./img/logo_branca.png">
    </nav>

    <!-- SITE -->
    <div class="container-fluid">

        <div class="container-fluid pb-5" id="sobre">
            <!--CONTEÚDO-->
            <div class="container-fluid">
                <div class="row justify-content-left">

                    <div class="col-xl-2 col-sm-10 rounded p-4">
                        <!--CAMPO DE PESQUISA-->
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Pesquisar">
                        </div>
                        <div class="col-xl-4 col-sm-5">
                            <!--FILTROS-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--CATÁLOGO-->
        <div class="container-fluid" id="catalogo">
            <?php
            require '../../Model/Conexao.php';

            $sql = "SELECT Cat_id, Cat_img1, Cat_nome, Cat_cate, Cat_desc FROM Catalogo";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='catalog-container'>";
                while ($row = $result->fetch_assoc()) {
                    // supondo que a imagem está no caminho correto
                    $foto = $row['Cat_img1'];

                    echo "<div class='catalog-card'>
                        <img src='img/{$foto}' alt='Imagem do produto {$row['Cat_nome']}'>
                        <p><strong>ID:</strong> {$row['Cat_id']}</p>
                        <p><strong>Nome:</strong> {$row['Cat_nome']}</p>
                        <p><strong>Categoria:</strong> {$row['Cat_cate']}</p>
                        <p><strong>Descrição:</strong> {$row['Cat_desc']}</p>
                    </div>";
                }
                echo "</div>";
            }

            $conn->close();
            ?>

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container-fluid center bg-primaria cor-secundaria-alt mt-5">
            <div class="row juntify-content-center">
                <div class="col-xl-12 col-sm-12 center">
                    <p>Copyright ©2025 <a class="termo" href="src/html/termos.html">Termos de Serviço</a></p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>