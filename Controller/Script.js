// Script.js - simples e comentado em português
// 1) Preenche modal com os data-* do card clicado
// 2) Popula carrossel manual (sem autoplay)
// 3) Badges de categoria clicáveis (adicionam hidden inputs e submetem o form)

const $ = (s, ctx=document) => ctx.querySelector(s);
const $$ = (s, ctx=document) => Array.from(ctx.querySelectorAll(s));

document.addEventListener('DOMContentLoaded', () => {
  const form = $('#filtrosForm');
  const badges = $$('.badge-btn');
  const modal = $('#produtoModal');
  const carouselInner = $('#carouselInner');
  const carouselWrapper = $('#carouselProduto');
  const popupNome = $('#popupNome');
  const popupDesc = $('#popupDesc');
  const popupCate = $('#popupCate');
  const popupId = $('#popupId');

  // badges clicáveis: toggle visual + hidden input no form + submit
  badges.forEach(b => b.addEventListener('click', () => {
    const cat = b.dataset.cat;
    if(!cat) return;
    b.classList.toggle('active');
    if(b.classList.contains('active')) {
      // cria hidden input se não existir
      if(form && !form.querySelector(`input[name="categoria[]"][value="${cat}"]`)) {
        const i = document.createElement('input');
        i.type='hidden'; i.name='categoria[]'; i.value=cat; form.appendChild(i);
      }
    } else {
      // remove hidden input
      if(form) {
        const exist = form.querySelectorAll(`input[name="categoria[]"][value="${cat}"]`);
        exist.forEach(x => x.remove());
      }
    }
    if(form) form.requestSubmit(); // submete o form para aplicar filtro
  }));

  // sincroniza badges com URL (quando voltar de paginação)
  (function syncFromURL(){
    const p = new URLSearchParams(window.location.search);
    const cats = p.getAll('categoria[]').concat(p.getAll('categoria'));
    if(cats.length) badges.forEach(b => { if(cats.includes(b.dataset.cat)) b.classList.add('active'); });
  })();

  // quando o modal abre, preenche dados com o element que disparou (relatedTarget)
  if(modal){
    modal.addEventListener('show.bs.modal', e => {
      const trigger = e.relatedTarget;
      if(!trigger) return;
      const nome = trigger.dataset.nome || '';
      const desc = trigger.dataset.desc || '';
      const cate = trigger.dataset.cate || '';
      const id = trigger.dataset.id || '';
      const imgs = [trigger.dataset.img1, trigger.dataset.img2, trigger.dataset.img3, trigger.dataset.img4].filter(Boolean);

      if(popupNome) popupNome.textContent = nome;
      if(popupDesc) popupDesc.textContent = desc;
      if(popupCate) popupCate.textContent = cate;
      if(popupId) popupId.textContent = id;

      // popula carrossel
      if(carouselInner) {
        carouselInner.innerHTML = '';
        if(imgs.length === 0) {
          carouselInner.innerHTML = `<div class="carousel-item active"><img src="./img/placeholder.png" class="d-block w-100"></div>`;
        } else {
          imgs.forEach((src, i) => {
            carouselInner.insertAdjacentHTML('beforeend',
              `<div class="carousel-item ${i===0?'active':''}"><img src="${src}" class="d-block w-100"></div>`);
          });
        }
        // garante que o carrossel fique no slide 0
        try {
          const c = bootstrap.Carousel.getOrCreateInstance(carouselWrapper, { interval:false, ride:false });
          c.to(0);
        } catch(err){ console.warn('carousel init',err); }
      }
    });

    // ao fechar limpa inner para não acumular imagens
    modal.addEventListener('hidden.bs.modal', ()=>{ if(carouselInner) carouselInner.innerHTML=''; });
  }
});
