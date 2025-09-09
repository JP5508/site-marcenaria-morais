<!doctype html>
<html lang="pt-br">

<head>
    <title>Catálogo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="../img/nova-logo_quadrado.png">

    <!-- BOOTSTRAP e CSS -->
    <link href="../Boostrap/bootstrap.css" rel="stylesheet" />
    <link href="./Catalogo.css" rel="stylesheet" />
</head>

<body>
    <!-- NAVBAR -->
    <nav>
        <a href="../Home/home.html">
            <img class="logo_navbar" src="./img/logo_branca.png">
        </a>
    </nav>

    <!-- CONTEÚDO -->
    <div class="container conteudo">
        <div class="row" id="catalogo">
            <?php
      require '../../Model/Conexao.php';

      // LIMITA 24 produtos por página (4 colunas x 6 linhas)
      $sql = "SELECT Cat_id, Cat_nome, Cat_desc, Cat_cate, Cat_img1, Cat_img2, Cat_img3, Cat_img4
              FROM catalogo LIMIT 24";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['Cat_id'];
          $nome = $row['Cat_nome'];
          $desc = $row['Cat_desc'];
          $cate = $row['Cat_cate'];
          $img1 = $row['Cat_img1'];
          $img2 = $row['Cat_img2'];
          $img3 = $row['Cat_img3'];
          $img4 = $row['Cat_img4'];

          echo "
          <!-- CARD DE PRODUTO -->
          <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='produto'
              data-bs-toggle='modal'
              data-bs-target='#produtoModal'
              data-nome='{$nome}'
              data-desc='{$desc}'
              data-cate='{$cate}'
              data-img1='img/{$img1}'
              data-img2='img/{$img2}'
              data-img3='img/{$img3}'
              data-img4='img/{$img4}'>
              <img src='img/{$img1}' alt='{$nome}'>
              <div class='produto-nome'>{$nome}</div>
            </div>
          </div>";
        }
      }
      $conn->close();
      ?>
        </div>
    </div>

    <!-- POPUP MODAL -->
    <div class="modal fade" id="produtoModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="row">
                    <!-- Carrossel -->
                    <div class="col-md-6">
                        <div id="carouselProduto" class="carousel slide" data-bs-ride="false">
                            <div class="carousel-inner" id="carousel-inner"></div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduto"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselProduto"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Informações -->
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <h3 id="popup-nome"></h3>
                        <p id="popup-desc"></p>
                        <p><strong>Categoria:</strong> <span id="popup-cate"></span></p>
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

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SCRIPT CUSTOM -->
    <script src="./Script.js"></script>
</body>

</html>