// Script responsável por carregar dados no popup do catálogo

const produtoModal = document.getElementById('produtoModal');

produtoModal.addEventListener('show.bs.modal', function (event) {
  const card = event.relatedTarget;

  // Captura atributos do card clicado
  const nome = card.getAttribute('data-nome');
  const desc = card.getAttribute('data-desc');
  const cate = card.getAttribute('data-cate');
  const imgs = [
    card.getAttribute('data-img1'),
    card.getAttribute('data-img2'),
    card.getAttribute('data-img3'),
    card.getAttribute('data-img4')
  ].filter(src => src && src !== 'img/'); // remove valores vazios

  // Preenche informações
  document.getElementById('popup-nome').textContent = nome;
  document.getElementById('popup-desc').textContent = desc;
  document.getElementById('popup-cate').textContent = cate;

  // Preenche carrossel
  const carouselInner = document.getElementById('carousel-inner');
  carouselInner.innerHTML = "";
  imgs.forEach((src, i) => {
    carouselInner.innerHTML += `
      <div class="carousel-item ${i === 0 ? 'active' : ''}">
        <img src="${src}" class="d-block w-100">
      </div>`;
  });
});