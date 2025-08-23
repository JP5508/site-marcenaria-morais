function abrirPopup(nome, desc, cate, id, ...imagens) {
    // Preenche informações do popup
    document.getElementById('popup-nome').innerText = nome;
    document.getElementById('popup-desc').innerText = desc;
    document.getElementById('popup-cate').innerText = cate;
    document.getElementById('popup-id').innerText = "ID: " + id;

    // Preenche o carousel
    const carouselInner = document.getElementById('carousel-inner');
    carouselInner.innerHTML = "";

    imagens.forEach((img, index) => {
        if (!img || img === '') return;

        const item = document.createElement('div');
        item.className = 'carousel-item' + (index === 0 ? ' active' : '');

        const imgTag = document.createElement('img');
        imgTag.src = "img/" + img;
        imgTag.className = 'd-block w-100';
        imgTag.alt = `Imagem ${index + 1}`;
        imgTag.style.objectFit = 'contain';
        imgTag.style.maxHeight = '100%';

        item.appendChild(imgTag);
        carouselInner.appendChild(item);
    });

    // Inicializa ou reinicia o carrossel
    const carouselElement = document.getElementById('popup-carousel');
    let carouselInstance = bootstrap.Carousel.getInstance(carouselElement);
    if (!carouselInstance) {
        carouselInstance = new bootstrap.Carousel(carouselElement, {
            interval: false,
            ride: false
        });
    } else {
        carouselInstance.to(0);
    }

    // Mostra popup e overlay
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('popup-overlay');
    popup.style.display = 'flex';
    overlay.style.display = 'block';
    setTimeout(() => {
        popup.style.opacity = '1';
        overlay.style.opacity = '1';
    }, 10);
}

function fecharPopup() {
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('popup-overlay');
    popup.style.opacity = '0';
    overlay.style.opacity = '0';
    setTimeout(() => {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }, 300);
}
