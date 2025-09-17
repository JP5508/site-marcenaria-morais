<?php
// catalogo.php
// Versão completa e comentada.
// - Mostra 24 itens por página (4 col x 6 linhas).
// - Filtros: pesquisa (search) e categorias (categoria[]).
// - Puxa categorias dinamicamente do DB.
// - Cards com overlay/hint; ao clicar abre modal com carrossel manual.
// Ajuste apenas o caminho do require se necessário.

// ---------- CONFIG ----------
require '../../Model/Conexao.php'; // ajuste se o caminho for diferente

$perPage = 24;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$search_raw = isset($_GET['search']) ? trim($_GET['search']) : '';
$categorias_raw = isset($_GET['categoria']) ? (array)$_GET['categoria'] : [];

// escape para HTML
function h($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

// escape array para SQL
function escArray($arr, $conn) {
    $out = [];
    foreach ((array)$arr as $v) {
        $v = trim($v);
        if ($v === '') continue;
        $out[] = "'" . $conn->real_escape_string($v) . "'";
    }
    return $out;
}

// ---------- WHERE DYNAMIC ----------
$whereParts = [];
if ($search_raw !== '') {
    $s = $conn->real_escape_string($search_raw);
    $whereParts[] = "(Cat_nome LIKE '%$s%' OR Cat_desc LIKE '%$s%')";
}
$escC = escArray($categorias_raw, $conn);
if (count($escC) > 0) {
    $whereParts[] = "Cat_cate IN (" . implode(',', $escC) . ")";
}
$whereSql = count($whereParts) ? ('WHERE ' . implode(' AND ', $whereParts)) : '';

// ---------- TOTAL PARA PAGINAÇÃO ----------
$sqlCount = "SELECT COUNT(*) AS total FROM catalogo $whereSql";
$resCnt = $conn->query($sqlCount);
$total = ($resCnt && $resCnt->num_rows) ? intval($resCnt->fetch_assoc()['total']) : 0;
$totalPages = max(1, ceil($total / $perPage));
if ($page > $totalPages) $page = $totalPages;
$offset = ($page - 1) * $perPage;

// ---------- BUSCA CATEGORIAS DINÂMICAS (DISTINCT) ----------
$cats = [];
$resCats = $conn->query("SELECT DISTINCT Cat_cate FROM catalogo");
if ($resCats && $resCats->num_rows) {
    while ($r = $resCats->fetch_assoc()) $cats[] = $r['Cat_cate'];
}

// ---------- CONSULTA PRINCIPAL ----------
$sql = "SELECT Cat_id, Cat_nome, Cat_desc, Cat_cate, Cat_img1, Cat_img2, Cat_img3, Cat_img4
        FROM catalogo
        $whereSql
        ORDER BY Cat_id DESC
        LIMIT $offset, $perPage";
$result = $conn->query($sql);

// ---------- HTML ----------
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Catálogo - Marcenaria Morais</title>
  <link rel="icon" href="../img/nova-logo_quadrado.png">

  <!-- Bootstrap CSS (local conforme seu projeto) -->
  <link href="../Boostrap/bootstrap.css" rel="stylesheet" />
  <!-- CSS custom -->
  <link href="./Catalogo.css" rel="stylesheet" />
</head>
<body>

  <!-- NAVBAR (LOCALIZAÇÃO) -->
  <nav class="nav-cat">
    <a href="../Home/home.html"><img class="logo_navbar" src="./img/logo_branca.png" alt="logo"></a>
  </nav>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="container conteudo my-4">
    <!-- FILTROS: pesquisa + categorias -->
    <form id="filtrosForm" method="get" class="row g-3 align-items-center mb-4">
      <div class="col-auto" style="min-width:260px;">
        <div class="input-group">
          <input type="search" name="search" id="search" class="form-control" placeholder="Pesquisar"
                 value="<?php echo h($search_raw); ?>">
          <button class="btn btn-outline-light" type="submit" title="Pesquisar">🔍</button>
        </div>
      </div>

      <div class="col-12 col-md-8">
        <div class="form-text mb-1">Categorias</div>
        <?php foreach ($cats as $c): 
            $active = in_array($c, $categorias_raw) ? 'active' : '';
        ?>
          <button type="button" class="btn btn-sm badge-btn <?php echo $active;?>" data-cat="<?php echo h($c); ?>">
            <?php echo h($c); ?>
          </button>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-sm btn-primary ms-2">Filtrar</button>
        <a href="catalogo.php" class="btn btn-sm btn-light ms-1">Limpar</a>
      </div>
    </form>

    <!-- GRID DE PRODUTOS (LOCALIZAÇÃO) -->
    <section id="gridProdutos" class="row g-4">
      <?php
      if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
              $id = intval($row['Cat_id']);
              $nome = $row['Cat_nome'];
              $desc = $row['Cat_desc'];
              $cate = $row['Cat_cate'];
              $img1 = !empty($row['Cat_img1']) ? "img/{$row['Cat_img1']}" : '';
              $img2 = !empty($row['Cat_img2']) ? "img/{$row['Cat_img2']}" : '';
              $img3 = !empty($row['Cat_img3']) ? "img/{$row['Cat_img3']}" : '';
              $img4 = !empty($row['Cat_img4']) ? "img/{$row['Cat_img4']}" : '';
              $thumb = $img1 ?: './img/placeholder.png';
      ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <!-- Card do produto (LOCALIZAÇÃO): contém overlay e hint para hover -->
        <div class="produto card border-0"
             role="button"
             data-bs-toggle="modal"
             data-bs-target="#produtoModal"
             data-id="<?php echo h($id); ?>"
             data-nome="<?php echo h($nome); ?>"
             data-desc="<?php echo h($desc); ?>"
             data-cate="<?php echo h($cate); ?>"
             data-img1="<?php echo h($img1); ?>"
             data-img2="<?php echo h($img2); ?>"
             data-img3="<?php echo h($img3); ?>"
             data-img4="<?php echo h($img4); ?>">
          <img src="<?php echo h($thumb); ?>" class="card-img-top" alt="<?php echo h($nome); ?>">
          <!-- Hover overlay (presente no mock) -->
          <div class="hover-overlay">
            <div class="hover-title"><?php echo h($nome); ?></div>
            <div class="hover-sub"><?php echo h(mb_strimwidth($desc, 0, 80, '...')); ?></div>
          </div>
          <!-- hint "Clique para mais informações" -->
          <div class="hint">Clique para mais informações</div>

          <div class="produto-nome"><?php echo h($nome); ?></div>
        </div>
      </div>
      <?php
          endwhile;
      else:
          echo '<div class="col-12 text-muted">Nenhum produto encontrado.</div>';
      endif;
      ?>
    </section>

    <!-- PAGINAÇÃO (LOCALIZAÇÃO) -->
    <nav aria-label="Paginação catálogo" class="mt-4">
      <ul class="pagination justify-content-center">
        <?php
        // Helper para manter query string
        function buildQuery($overrides = []) {
            $q = $_GET;
            foreach ($overrides as $k => $v) $q[$k] = $v;
            $parts = [];
            foreach ($q as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $vv) $parts[] = urlencode($k).'[]='.urlencode($vv);
                } else {
                    $parts[] = urlencode($k).'='.urlencode($v);
                }
            }
            return implode('&', $parts);
        }

        $visible = 5;
        $start = max(1, $page - intval($visible/2));
        $end = min($totalPages, $start + $visible - 1);
        if ($end - $start + 1 < $visible) $start = max(1, $end - $visible + 1);

        $prevClass = $page <= 1 ? 'disabled' : '';
        $prevPage = max(1, $page-1);
        echo "<li class='page-item $prevClass'><a class='page-link' href='?".buildQuery(['page'=>$prevPage])."'>‹ Anterior</a></li>";

        if ($start > 1) {
            echo "<li class='page-item'><a class='page-link' href='?".buildQuery(['page'=>1])."'>1</a></li>";
            if ($start > 2) echo "<li class='page-item disabled'><span class='page-link'>…</span></li>";
        }

        for ($i=$start; $i<=$end; $i++) {
            $active = $i == $page ? 'active' : '';
            echo "<li class='page-item $active'><a class='page-link' href='?".buildQuery(['page'=>$i])."'>$i</a></li>";
        }

        if ($end < $totalPages) {
            if ($end < $totalPages-1) echo "<li class='page-item disabled'><span class='page-link'>…</span></li>";
            echo "<li class='page-item'><a class='page-link' href='?".buildQuery(['page'=>$totalPages])."'>$totalPages</a></li>";
        }

        $nextClass = $page >= $totalPages ? 'disabled' : '';
        $nextPage = min($totalPages, $page+1);
        echo "<li class='page-item $nextClass'><a class='page-link' href='?".buildQuery(['page'=>$nextPage])."'>Próximo ›</a></li>";
        ?>
      </ul>
    </nav>

  </main>

  <!-- POPUP / MODAL (LOCALIZAÇÃO) -->
  <div class="modal fade" id="produtoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="row g-0">
            <!-- CARROSSEL (esquerda) -->
            <div class="col-md-7 p-4 d-flex align-items-center justify-content-center">
              <div id="carouselProduto" class="carousel slide w-100" data-bs-ride="false">
                <div class="carousel-inner" id="carouselInner"></div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduto" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselProduto" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
              </div>
            </div>

            <!-- INFORMAÇÕES (direita) -->
            <div class="col-md-5 p-4">
              <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>
              <h2 id="popupNome"></h2>
              <p id="popupDesc" class="text-muted"></p>
              <p><strong>Categoria:</strong> <span id="popupCate"></span></p>
              <p><strong>ID:</strong> <span id="popupId"></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="container-fluid center bg-primaria cor-secundaria-alt mt-5">
      <div class="row justify-content-center">
        <div class="col-xl-12 col-sm-12 center">
          <p>Copyright ©2025 <a class="termo" href="src/html/termos.html">Termos de Serviço</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./Script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
