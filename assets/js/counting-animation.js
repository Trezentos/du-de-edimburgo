document.addEventListener('DOMContentLoaded', function () {

    // Função para iniciar a contagem animada
    function startCounting(element) {
        const number = Number(element.textContent); // Obtém o número do texto do elemento
        const isInteiro = Number.isInteger(number); // Verifica se é um número inteiro

        // Inicializa a contagem animada
        $(element).prop('Counter', 0).animate({
            Counter: number
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                if (isInteiro) {
                    // Formata o número como inteiro
                    $(element).text(Math.ceil(now).toLocaleString('pt-BR'));
                } else {
                    // Formata o número com uma casa decimal
                    $(element).text((Math.round(now * 10) / 10).toLocaleString('pt-BR'));
                }
            }
        });
    }

// Selecionar todos os elementos com a classe 'contador'
    const elements = document.querySelectorAll('.contador');

// Configurar o observador para cada elemento
    elements.forEach((element) => {
        const observer = new MutationObserver((mutationsList) => {
            mutationsList.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    // Verificar se a classe 'waypoint' foi adicionada
                    if (element.classList.contains('waypoint')) {
                        element.classList.add('animated')
                        // Inicia a contagem animada para o elemento
                        startCounting(element);

                        // Para de observar o elemento
                        observer.disconnect();
                    }
                }
            });
        });

        // Configurar as opções de observação
        observer.observe(element, {attributes: true}); // Observa mudanças nos atributos do elemento
    });


});

// CSS
// .contador.animated { opacity: 1 }


// HTML
// <div className="number-item">
//     <strong className="waypoint contador">44</strong>
//     <p>por andar</p>
// </div>