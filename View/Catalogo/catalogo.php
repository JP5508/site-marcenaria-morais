<?php
// catalogo.php - versão simples e funcional
// 24 itens por página (4 col x 6 linhas), filtros à esquerda, modal popup com carrossel.

// ajuste o path da conexão se for diferente
require '../../Model/Conexao.php';

// ------- configurações simples -------
$perPage = 24;
$page = isset($_GET['page']) ? max(1,intval($_GET['page'])) : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$categorias = isset($_GET['categoria']) ? (array)$_GET['categoria'] : [];

// escape para HTML
function h($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

// montando WHERE (somente search e categoria, porque a tabela não tem tamanho)
$where = [];
if ($search !== '') {
  $s = $conn->real_escape_string($search);
  $where[] = "(Cat_nome LIKE '%$s%' OR Cat_desc LIKE '%$s%')";
}
if (count($categorias)) {
  $vals = array_map(function($v) use($conn){ return "'" . $conn->real_escape_string($v) . "'"; }, $categorias);
  $where[] = "Cat_cate IN (" . implode(',', $vals) . ")";
}
$whereSql = count($where) ? ('WHERE ' . implode(' AND ', $where)) : '';

// total para paginação
$resTotal = $conn->query("SELECT COUNT(*) AS total FROM catalogo $whereSql");
$total = ($resTotal && $resTotal->num_rows) ? intval($resTotal->fetch_assoc()['total']) : 0;
$totalPages = max(1, ceil($total / $perPage));
if ($page > $totalPages) $page = $totalPages;
$offset = ($page - 1) * $perPage;

// pega as categorias existentes para mostrar os botões (dinâmico)
$cats = [];
$resCats = $conn->query("SELECT DISTINCT Cat_cate FROM catalogo");
if ($resCats) while ($r = $resCats->fetch_assoc()) $cats[] = $r['Cat_cate'];

// consulta principal (puxa 24 itens)
$sql = "SELECT Cat_id, Cat_nome, Cat_desc, Cat_cate, Cat_img1, Cat_img2, Cat_img3, Cat_img4
        FROM catalogo $whereSql ORDER BY Cat_id DESC LIMIT $offset, $perPage";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Catálogo</title>
  <link rel="icon" href="../img/nova-logo_quadrado.png">

  <!-- bootstrap local -->
  <link href="../Boostrap/bootstrap.css" rel="stylesheet" />
  <link href="./Catalogo.css" rel="stylesheet" />
</head>
<body>

<nav class="nav-cat">
  <a href="../Home/home.html"><img class="logo_navbar" src="./img/logo_branca.png" alt="logo"></a>
</nav>

<main class="container conteudo my-4">
  <div class="row">
    <!-- FILTROS (ESQUERDA) -->
    <aside class="col-lg-3 mb-4">
      <form id="filtrosForm" method="get">
        <div class="mb-3">
          <input type="search" name="search" class="form-control" placeholder="Pesquisar" value="<?php echo h($search); ?>">
        </div>

        <div class="mb-3">
          <div class="form-text mb-1">Categorias</div>
          <?php foreach ($cats as $c):
            $active = in_array($c, $categorias) ? 'active' : '';
          ?>
            <button type="button" class="btn btn-sm badge-btn <?php echo $active;?>" data-cat="<?php echo h($c); ?>">
              <?php echo h($c); ?>
            </button>
          <?php endforeach; ?>
        </div>

        <div>
          <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
          <a href="catalogo.php" class="btn btn-light btn-sm ms-2">Limpar</a>
        </div>
      </form>
    </aside>

    <!-- GRIDE DE PRODUTOS (DIREITA) -->
    <section class="col-lg-9">
      <div class="row g-4" id="catalogoGrid">
        <?php if ($result && $result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
            $id = (int)$row['Cat_id'];
            $nome = $row['Cat_nome'];
            $desc = $row['Cat_desc'];
            $cate = $row['Cat_cate'];
            $img1 = !empty($row['Cat_img1']) ? "img/{$row['Cat_img1']}" : './img/placeholder.png';
            $img2 = !empty($row['Cat_img2']) ? "img/{$row['Cat_img2']}" : '';
            $img3 = !empty($row['Cat_img3']) ? "img/{$row['Cat_img3']}" : '';
            $img4 = !empty($row['Cat_img4']) ? "img/{$row['Cat_img4']}" : '';
        ?>
        <div class="col-xl-3 col-md-4 col-sm-6">
          <!-- card com data-* para o JS preencher o modal -->
          <div class="produto card border-0"
               role="button"
               data-id="<?php echo h($id); ?>"
               data-nome="<?php echo h($nome); ?>"
               data-desc="<?php echo h($desc); ?>"
               data-cate="<?php echo h($cate); ?>"
               data-img1="<?php echo h($img1); ?>"
               data-img2="<?php echo h($img2); ?>"
               data-img3="<?php echo h($img3); ?>"
               data-img4="<?php echo h($img4); ?>"
               data-bs-toggle="modal"
               data-bs-target="#produtoModal">
            <img loading="lazy" src="<?php echo h($img1); ?>" alt="<?php echo h($nome); ?>" class="card-img-top">
            <div class="hover-overlay">
              <div class="hover-title"><?php echo h($nome); ?></div>
              <div class="hover-sub"><?php echo h(mb_strimwidth($desc,0,80,'...')); ?></div>
            </div>
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
      </div>

      <!-- PAGINAÇÃO simples -->
      <nav class="mt-4">
        <ul class="pagination justify-content-center">
          <?php
          // helper que mantém filtros na URL
          function buildQuery($overrides=[]){
            $q = $_GET;
            foreach($overrides as $k=>$v) $q[$k]=$v;
            $parts=[];
            foreach($q as $k=>$v){
              if(is_array($v)) foreach($v as $vv) $parts[] = urlencode($k).'[]='.urlencode($vv);
              else $parts[] = urlencode($k).'='.urlencode($v);
            }
            return implode('&',$parts);
          }

          $visible=5;
          $start=max(1,$page-intval($visible/2));
          $end=min($totalPages,$start+$visible-1);
          if($end-$start+1<$visible) $start=max(1,$end-$visible+1);

          $prevClass = $page<=1?'disabled':'';
          $prev= max(1,$page-1);
          echo "<li class='page-item $prevClass'><a class='page-link' href='?".buildQuery(['page'=>$prev])."'>‹ Anterior</a></li>";

          if($start>1){ echo "<li class='page-item'><a class='page-link' href='?".buildQuery(['page'=>1])."'>1</a></li>"; if($start>2) echo "<li class='page-item disabled'><span class='page-link'>…</span></li>"; }
          for($i=$start;$i<=$end;$i++){ $act = $i==$page?'active':''; echo "<li class='page-item $act'><a class='page-link' href='?".buildQuery(['page'=>$i])."'>$i</a></li>"; }
          if($end<$totalPages){ if($end<$totalPages-1) echo "<li class='page-item disabled'><span class='page-link'>…</span></li>"; echo "<li class='page-item'><a class='page-link' href='?".buildQuery(['page'=>$totalPages])."'>$totalPages</a></li>"; }
          $nextClass = $page>=$totalPages?'disabled':'';
          $next = min($totalPages,$page+1);
          echo "<li class='page-item $nextClass'><a class='page-link' href='?".buildQuery(['page'=>$next])."'>Próximo ›</a></li>";
          ?>
        </ul>
      </nav>

    </section>
  </div>
</main>

<!-- MODAL POPUP -->
<div class="modal fade" id="produtoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="row g-0">
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
          <div class="col-md-5 p-4">
            <div class="d-flex justify-content-end"><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
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

<footer>
  <div class="container-fluid center bg-primaria cor-secundaria-alt mt-5">
    <div class="row justify-content-center">
      <div class="col-12 center">
        <p>Copyright ©2025 <a class="termo" href="src/html/termos.html">Termos de Serviço</a></p>
      </div>
    </div>
  </div>
</footer>

<!-- scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./Script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
