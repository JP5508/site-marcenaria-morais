<?php
// ---------- CONFIG ----------
require '../../Model/Conexao.php';

// Consulta ao banco
$sql = "SELECT Cat_id, Cat_nome, Cat_desc, Cat_cate, Cat_img1, Cat_img2, Cat_img3, Cat_img4 FROM catalogo";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Marcenaria Morais</title>
    <link rel="icon" type="image/x-icon" href="./img/nova-logo_quadrado.png">
    <!-- META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS STYLE -->
    <link href="./Catalog.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
</head>

<body>
    <!-- NAVBAR -->
    <nav>
        <!--LOGO-->
        <a href="../Home/home.html"><img src="./img/logo_white.png"></a>
        <!--NAVIGATION LINKS-->
        <!-- <a href="#home">HOME</a>
        <a href="#quality">QUALIDADE</a>
        <a href="#about">SOBRE</a>
        <a href="#catalog">CATÁLOGO</a>
        <a href="#adress">LOCALIZAÇÃO</a>
        <a href="#netws">REDES</a> -->
    </nav>

    <!-- SITE -->
    <main>

        <!-- FILTERS -->
        <section id="filters">
            <form action="">

                <!-- SEARCH -->
                <div class="search">
                    <input type="search" id="name" name="name" placeholder="pesquisar">
                    <!-- <span class="material-symbols-outlined">search</span> -->
                    <img src="./img/icon_white_search.png">
                </div>

                <!-- SIZE -->
                <p>Tamanhos:</p>

                <div class="size">
                    <input type="checkbox" name="grande" value="grande">
                    <label for="grande">Grande</label>

                    <input type="checkbox" name="medio" value="medio">
                    <label for="medio">Médio</label>

                    <input type="checkbox" name="pequeno" value="pequeno">
                    <label for="pequeno">Pequeno</label>
                </div>

                <!-- CATEGORY -->
                <p>Categorias:</p>

                <div class="category">
                    <label>
                        <input type="checkbox" id="check_1" name="check_1" value="Cadeira">
                        <span>Cadeira</span>
                    </label>
                    <label>
                        <input type="checkbox" id="check_2" name="check_2" value="Mesa">
                        <span>Mesa</span>
                    </label>
                    <label>
                        <input type="checkbox" id="check_3" name="check_3" value="Cozinha">
                        <span>Cozinha</span>
                    </label>
                    <label>
                        <input type="checkbox" id="check_4" name="check_4" value="Quarto">
                        <span>Quarto</span>
                    </label>
                </div>
            </form>
        </section>

        <!-- CATALOG -->
        <section id="catalog">
            <div class="catalog">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                <!-- CARD -->
                <div class="card" onclick="showPopup('<?php echo $row['Cat_id']; ?>')">
                    <img class="card-img" src="./img/<?php echo $row['Cat_img1']; ?>">
                    <div class="card-txt">
                        <h5><?php echo $row['Cat_nome']; ?></h5>
                        <p><?php echo substr($row['Cat_desc'], 0, 80) . '...'; ?></p>
                        <a>Clique para mais informações</a>
                    </div>
                </div>

                <!-- POPUP -->
                <!-- <section id="popup-<?php echo $row['Cat_id']; ?>" style="visibility:hidden;">
                            <div class="popup">
                            <button onclick="hidePopup('<?php echo $row['Cat_id']; ?>')"><img src="./img/icon_dark_close.png"></button>
                                <div class="popup-columns">
                                    <div class="popup-left">
                                        <img src="./img/<?php echo $row['Cat_img1']; ?>">
                                        <img src="./img/<?php echo $row['Cat_img2']; ?>">
                                        <img src="./img/<?php echo $row['Cat_img3']; ?>">
                                        <img src="./img/<?php echo $row['Cat_img4']; ?>">
                                    </div>
                                    <div class="popup-right">
                                        <h5><?php echo $row['Cat_nome']; ?></h5>
                                        <p><?php echo $row['Cat_desc']; ?></p>
                                        <br>
                                        <p>Tamanho</p>
                                        <span>Médio</span>
                                        <p>Categorias</p>
                                        <span><?php echo $row['Cat_cate']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </section> -->
                <?php
                    }
                } else {
                    echo "<p>Nenhum item encontrado.</p>";
                }
                ?>

            </div>
        </section>

        <!-- PAGES -->
        <section id="pages">
            <div class="pages">
                <!-- <button class="btn-before">Anterior</button>
                <button class="btn-number">1</button>
                <button class="btn-number">2</button>
                <button class="btn-number">3</button>
                <button class="btn-number">4</button>
                <button class="btn-number">5</button>
                <button class="btn-after">Próximo</button> -->
            </div>
        </section>
        <!-- WEBSITE END -->
    </main>

    <!-- FOOTER -->
    <footer>
        <p>Copyright ©2025 <a href="../Terms/terms.html">Termos de Serviço</a></p>
    </footer>
    <script src="../../Controller/Script.js"></script>
</body>

</html>