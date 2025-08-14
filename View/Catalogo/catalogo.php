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
                    $foto = $row['Cat_img1'];
                    $id = $row['Cat_id'];

                    echo "
                    <a href='../Home/home.html'>
                    <div class='catalog-card' style='background-image: url(img/{$foto});'>
                            <div class='overlay'>
                                <h3>{$row['Cat_nome']}</h3>
                                <p>{$row['Cat_desc']}</p>
                            </div>
                        </div>
                        </a>";

                }
                echo "</div>";
            }

            

        echo"</div>";

        //<!--POPUP-->
        //<!--FUNDO BEGE-->
        echo"<div class='col-xl-6 col-sm-11 bg-secundaria-alt rounded p-4' id='popup'>
            <!--COLUNAS INTERNAS-->
            <div class='row fper-height'>
                <!--COLUNA ESQUERDA-->
                <div class='col-xl-6 col-sm-12'>
                    <div class='text-white p-3 rounded half-height bg-secundaria bg-teste'>
                        <!--CARROSEL-->
                    </div>
                </div>
                <!--COLUNA DIREITA-->
                <div class='col-xl-6 col-sm-12 half-height'>
                    <div class='position-absolute top-0 end-0 p-3'>
                        <button type='button' class='btn-close' aria-label='Fechar' onclick='fecharPopup()'></button>
                    </div>
                    <div class='text-dark p-3'>
                        <!--PHP: NOME-->
                        <h2>nome</h2>
                        <!--PHP: DESCRIÇÃO-->
                        <p>{$id}</p>
                        <!--PHP: CATEGORIA-->
                        <p>categ</p>
                    </div>
                </div>
            </div>
        </div>";

        $conn->close();
            ?>
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