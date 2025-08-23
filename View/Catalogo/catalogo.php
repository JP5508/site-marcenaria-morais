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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- NAVBAR -->
    <nav class="nav-cat">
        <a href="../Home/home.html">
            <img class="logo_navbar" src="./img/logo_branca.png">
        </a>
    </nav>

    <!-- SITE -->
    <div class="container-fluid">

        <div class="container-fluid pb-5" id="sobre">
            <!--CONTEÚDO-->
            <div class="container-fluid">
                <div class="row justify-content-left">

                    <div class="col-xl-12 col-sm-10 rounded p-4">
                        <!--CAMPO DE PESQUISA-->
                        <div class="col-xl-2 col-sm-5 form-group">
                            <!-- <input type="text" class="form-control" id="search" name="search" placeholder="Pesquisar"> -->
                            <!--CAMPO DE PESQUISA-->
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Pesquisar" id="search">
                                <button class="btn btn-light" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-xl-12 col-sm-5">
                            <!--FILTROS-->
                            <div class="mb-3">
                                <h6>Tamanhos</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="filtroGrande" checked>
                                    <label class="form-check-label" for="filtroGrande">
                                        Grande
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="filtroMedio">
                                    <label class="form-check-label" for="filtroMedio">
                                        Médio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="filtroPequeno">
                                    <label class="form-check-label" for="filtroPequeno">
                                        Pequeno
                                    </label>
                                </div>
                            </div>

                            <!--CATEGORIAS-->
                            <div>
                                <h6>Categorias</h6>
                                <span class="badge bg-secondary">Cadeira</span>
                                <span class="badge bg-secondary">Mesa</span>
                                <span class="badge bg-secondary">Cozinha</span>
                                <span class="badge bg-secondary">Quarto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        //<!--CATÁLOGO-->
        echo "<div class='container-fluid' id='catalogo'>";

        require '../../Model/Conexao.php';

        $sql = "SELECT Cat_id, Cat_img1, Cat_nome, Cat_cate, Cat_desc FROM Catalogo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='catalog-container'>";
            while ($row = $result->fetch_assoc()) {
                $nome = $row['Cat_nome'];
                $desc = $row['Cat_desc'];
                $cate = $row['Cat_cate'];
                $img1 = !empty($row['Cat_img1']) ? $row['Cat_img1'] : '';
                $img2 = !empty($row['Cat_img2']) ? $row['Cat_img2'] : '';
                $img3 = !empty($row['Cat_img3']) ? $row['Cat_img3'] : '';
                $id = $row['Cat_id'];

                echo "
<div class='catalog-card' style='background-image: url(img/{$img1});'
    onclick=\"abrirPopup('{$nome}', '{$desc}', '{$cate}', '{$id}', '{$img1}', '{$img2}', '{$img3}')\">
                    <div class='overlay'>'
                    <h3>{$row['Cat_nome']}</h3>
                    <p>{$row['Cat_desc']}</p>
                    </div>

                    </div>";
            }
            echo "</div>";
        }



        echo "</div>";
        $conn->close();
        ?>


        <!--POPUP-->

        <!--FUNDO BEGE-->
        <div id="popup-overlay" style="visibility: hidden; opacity: 0;" onclick="fecharPopup()"></div>

        <!-- Popup -->
        <div class="col-xl-6 col-sm-11 bg-secundaria-alt rounded p-4" id="popup">
            <div class="row fper-height">
                <!-- Coluna esquerda -->
                <div class="col-xl-6 col-sm-12">
                    <div id="popup-img" class="text-white p-3 rounded half-height bg-secundaria">
                        <div id="popup-carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carousel-inner">
                                <!-- imagens por JavaScript -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#popup-carousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#popup-carousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Coluna direita -->
                <div class="col-xl-6 col-sm-12 half-height">
                    <div class="position-absolute top-0 end-0 p-3">
                        <button type="button" class="btn-close" aria-label="Fechar" onclick="fecharPopup()"></button>
                    </div>
                    <div class="text-dark p-3">
                        <h2 id="popup-nome"></h2>
                        <p id="popup-desc"></p>
                        <p id="popup-cate"></p>
                        <p id="popup-id" style="font-weight:bold"></p>
                    </div>
                </div>
            </div>
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

<script src="../../Controller/Script.js" type="text/javascript"></script>

</html>





<!-- <div class='catalog-card'
    style='background-image: url(img/{$foto});'
    onclick=\"abrirPopup('{$row['Cat_nome']}', '{$row['Cat_desc']}', '{$row['Cat_cate']}', '{$id}')\"> -->