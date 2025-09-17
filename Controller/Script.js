/**
 * Script.js
 * - Preenche modal (nome/desc/categoria/id) ao abrir.
 * - Popula carrossel manual (sem autoplay).
 * - Limpa carrossel ao fechar.
 * - Badges de categoria são clicáveis: alternam visual, adicionam/removem inputs hidden
 *   name="categoria[]" no form #filtrosForm e submetem o form.
 */

/* Helpers */
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

document.addEventListener('DOMContentLoaded', () => {
  const form = $('#filtrosForm');
  const badgeBtns = $$('.badge-btn');
  const produtoModal = $('#produtoModal');
  const carouselInner = $('#carouselInner');
  const carouselWrapper = $('#carouselProduto');
  const popupNome = $('#popupNome');
  const popupDesc = $('#popupDesc');
  const popupCate = $('#popupCate');
  const popupId = $('#popupId');

  if (!carouselInner || !carouselWrapper) {
    console.warn('Script.js: elementos do carrossel/modal não encontrados.');
  }

  function addHiddenCategoryInput(catValue) {
    if (!form) return null;
    const existing = form.querySelectorAll('input[name="categoria[]"]');
    for (const i of existing) if (i.value === catValue) return i;
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'categoria[]';
    input.value = catValue;
    form.appendChild(input);
    return input;
  }

  function removeHiddenCategoryInput(catValue) {
    if (!form) return;
    const inputs = Array.from(form.querySelectorAll('input[name="categoria[]"]'));
    for (const i of inputs) { if (i.value === catValue) i.remove(); }
  }

  // badgeb click
  badgeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;
      if (!cat) return;
      btn.classList.toggle('active');
      if (btn.classList.contains('active')) addHiddenCategoryInput(cat);
      else removeHiddenCategoryInput(cat);
      if (form) form.requestSubmit();
    });
  });

  // sync badges from URL
  (function syncFromQuery() {
    const params = new URLSearchParams(window.location.search);
    const categories = params.getAll('categoria[]').concat(params.getAll('categoria'));
    if (categories.length) {
      badgeBtns.forEach(btn => {
        if (categories.includes(btn.dataset.cat)) {
          btn.classList.add('active');
          addHiddenCategoryInput(btn.dataset.cat);
        }
      });
    }
  })();

  // modal show
  if (produtoModal) {
    produtoModal.addEventListener('show.bs.modal', event => {
      const trigger = event.relatedTarget;
      if (!trigger) return;

      const nome = trigger.dataset.nome || '';
      const desc = trigger.dataset.desc || '';
      const cate = trigger.dataset.cate || '';
      const id = trigger.dataset.id || '';
      const imgs = [
        trigger.dataset.img1 || '',
        trigger.dataset.img2 || '',
        trigger.dataset.img3 || '',
        trigger.dataset.img4 || ''
      ].filter(s => s && s.trim() !== '');

      if (popupNome) popupNome.textContent = nome;
      if (popupDesc) popupDesc.textContent = desc;
      if (popupCate) popupCate.textContent = cate;
      if (popupId) popupId.textContent = id;

      populateCarousel(imgs);
    });

    produtoModal.addEventListener('hidden.bs.modal', () => {
      if (carouselInner) carouselInner.innerHTML = '';
    });
  }

  function populateCarousel(imgs) {
    if (!carouselInner) return;
    carouselInner.innerHTML = '';

    if (!imgs || imgs.length === 0) {
      const fallback = './img/placeholder.png';
      carouselInner.insertAdjacentHTML('beforeend',
        `<div class="carousel-item active"><img src="${fallback}" class="d-block w-100" alt="Sem imagem"></div>`);
    } else {
      imgs.forEach((src, i) => {
        const active = i === 0 ? 'active' : '';
        carouselInner.insertAdjacentHTML('beforeend',
          `<div class="carousel-item ${active}"><img src="${src}" class="d-block w-100" alt="Imagem ${i+1}"></div>`);
      });
    }

    try {
      const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carouselWrapper, { interval: false, ride: false });
      carouselInstance.to(0);
    } catch (err) {
      console.warn('Script.js: erro ao instanciar carousel', err);
    }
  }

});
