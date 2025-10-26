function showPopup(id) {
    document.getElementById('popup-' + id).style.visibility = 'visible';
}

function hidePopup(id) {
    document.getElementById('popup-' + id).style.visibility = 'hidden';
}

// PAGINAÇÃO AUTOMÁTICA
// Espera o conteúdo da página carregar completamente
document.addEventListener("DOMContentLoaded", function () {

    // Seleciona todos os elementos com a classe "card" (os itens do catálogo)
    const cards = document.querySelectorAll(".card");

    // Seleciona a div onde os botões de página vão aparecer
    const pagesContainer = document.querySelector(".pages");

    // Quantos cards aparecem por página
    const itensPorPagina = 24;

    // Página que começa sendo exibida
    let paginaAtual = 1;

    // Calcula o total de páginas com base na quantidade de cards existentes
    const totalPaginas = Math.ceil(cards.length / itensPorPagina);

    // -----------------------------
    // FUNÇÃO: mostrarPagina()
    // Exibe apenas os cards da página selecionada
    // -----------------------------
    function mostrarPagina(pagina) {
        // Calcula o índice inicial e final da lista de cards
        const inicio = (pagina - 1) * itensPorPagina;
        const fim = inicio + itensPorPagina;

        // Percorre todos os cards
        cards.forEach((card, index) => {
            // Se o índice do card estiver dentro do intervalo da página atual → mostra
            if (index >= inicio && index < fim) {
                card.style.display = "block";
            } else {
                // Senão → esconde
                card.style.display = "none";
            }
        });

        // Atualiza os botões (para destacar o número da página atual)
        atualizarBotoes();
    }

    // -----------------------------
    // FUNÇÃO: atualizarBotoes()
    // Cria/atualiza os botões de paginação conforme o total de páginas
    // -----------------------------
    function atualizarBotoes() {
        // Limpa os botões antigos antes de recriar
        pagesContainer.innerHTML = "";

        // ---------- BOTÃO "ANTERIOR" ----------
        const btnAntes = document.createElement("button");
        btnAntes.textContent = "Anterior";
        btnAntes.classList.add("btn-before");

        // Desativa se estiver na primeira página
        btnAntes.disabled = paginaAtual === 1;

        // Define o que acontece ao clicar: vai para a página anterior
        btnAntes.onclick = () => {
            if (paginaAtual > 1) {
                paginaAtual--;
                mostrarPagina(paginaAtual);
            }
        };

        // Adiciona o botão na tela
        pagesContainer.appendChild(btnAntes);

        // ---------- BOTÕES NUMÉRICOS ----------
        for (let i = 1; i <= totalPaginas; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.classList.add("btn-number");

            // Se for a página atual, adiciona uma classe "active" pra mudar o estilo
            if (i === paginaAtual) btn.classList.add("active");

            // Quando clicar num número → muda a página
            btn.onclick = () => {
                paginaAtual = i;
                mostrarPagina(paginaAtual);
            };

            // Adiciona o botão numérico na tela
            pagesContainer.appendChild(btn);
        }

        // ---------- BOTÃO "PRÓXIMO" ----------
        const btnDepois = document.createElement("button");
        btnDepois.textContent = "Próximo";
        btnDepois.classList.add("btn-after");

        // Desativa se estiver na última página
        btnDepois.disabled = paginaAtual === totalPaginas;

        // Define ação ao clicar: avança uma página
        btnDepois.onclick = () => {
            if (paginaAtual < totalPaginas) {
                paginaAtual++;
                mostrarPagina(paginaAtual);
            }
        };

        // Adiciona o botão "Próximo" na tela
        pagesContainer.appendChild(btnDepois);
    }

    // -----------------------------
    // INICIALIZAÇÃO
    // -----------------------------
    // Mostra a primeira página ao carregar o site
    mostrarPagina(paginaAtual);
});
