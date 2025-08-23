function abrirPopup(nome, desc, cate, id, ...imagens) {
    document.getElementById('popup-nome').innerText = nome;
    document.getElementById('popup-desc').innerText = desc;
    document.getElementById('popup-cate').innerText = cate;
    document.getElementById('popup-id').innerText = "ID: " + id;

    const carouselInner = document.getElementById('carousel-inner');
    carouselInner.innerHTML = ""; // limpa imagens anteriores

    imagens.forEach((img, index) => {
        if (!img) return; // ignora imagens vazias/null

        const item = document.createElement('div');
        item.className = 'carousel-item' + (index === 0 ? ' active' : '');

        const imgTag = document.createElement('img');
        imgTag.src = "img/" + img;
        imgTag.className = 'd-block w-100';
        imgTag.alt = `Imagem ${index + 1}`;

        item.appendChild(imgTag);
        carouselInner.appendChild(item);
    });

    // Reinicia o carrossel Bootstrap para atualizar
    const carouselElement = document.getElementById('popup-carousel');
    const carouselInstance = bootstrap.Carousel.getInstance(carouselElement);
    if (carouselInstance) {
        carouselInstance.dispose();
    }
    new bootstrap.Carousel(carouselElement, {
        interval: false,
        ride: false
    });

    // Mostra o popup
    const popup = document.getElementById('popup');
    popup.style.visibility = 'visible';
    popup.style.opacity = '1';
}