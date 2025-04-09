jQuery(document).ready(function($)
{
    function onSlideChange(event) {
        // SEM ESTA FUNÇÃO, APARECE UM BOTÃO VAZIO QUANDO ESTE TA SEM TEXTO,
        // FAZENDO QUE UM UNICO TITULO DO SLIDE TENHA UMA BARRA SEPARANDO DE OUTRO

        const owlDotsButtons = event.target.querySelectorAll('.owl-dots .owl-dot');

        owlDotsButtons.forEach(dot => {
            dot.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation(); // Bloqueia a propagação do clique
            });

            const buttonText = dot.firstElementChild.textContent;

            if (!buttonText) dot.remove();
        });
    }


    $('.carousel-galeria').owlCarousel({
        loop: true,
        responsive: false,
        dots: true,
        nav: true,
        smartSpeed: 1300,
        items: 2,
        responsive: {
            0: {
                items: 1,
                margin: 0,
            },
            768: {
                items: 1,
                margin: 0,
            }
        },

    }).on('initialized.owl.carousel', function(event) {
        // Pega todos os itens do carousel
        var items = $('.carousel-galeria .item');

        // Percorre cada dot e adiciona o título correspondente
        $('.carousel-galeria .owl-dots .owl-dot').each(function(index) {
            var itemTitle = $(items[index]).find('.item-title').text();

            $(this).html('<span>' + itemTitle + '</span>');
        });



    }).on('changed.owl.carousel', onSlideChange);

    $('.owl-next span').html('<img src="'+HTTP+'/assets/img/icons/chevron-right.svg" alt="">');
    $('.owl-prev span').html('<img src="'+HTTP+'/assets/img/icons/chevron-left.svg" alt="">');



    $('.carousel-buttons').owlCarousel({
        loop: false,
        responsive: false,
        dots: false,
        nav: true,
        smartSpeed: 1300,
        items: 3,
        responsive: {
            0: {
                items: 2,
                margin: 0,
            },
            768: {
                items: 4,
                margin: 0,
            }
        },

    })

    $('.owl-next span').html('<img src="'+HTTP+'/assets/img/icons/chevron-right.svg" alt="">');
    $('.owl-prev span').html('<img src="'+HTTP+'/assets/img/icons/chevron-left.svg" alt="">');






    $('.carousel-terrains').owlCarousel({
        loop: false,
        dots: false,
        nav: true,
        smartSpeed: 1300,

        responsive: {
            0: {
                items: 1,
                margin: 14,
            },
            768: {
                items: 1,
                margin: 0,
            }
        },

    })

    $('.owl-next span').html('<img src="'+HTTP+'/assets/img/icons/chevron-right.svg" alt="">');
    $('.owl-prev span').html('<img src="'+HTTP+'/assets/img/icons/chevron-left.svg" alt="">');


}).on('initialized.owl.carousel', function(event) {

    const carouselItems = event.target.querySelectorAll('.owl-item:not(.cloned)');

    let titlesData = []
    carouselItems.forEach(item=>{
        const textContent = item.querySelector('.carousel-title');

        titlesData.push(textContent);

    })


    const owlDotsSpan = event.target.querySelectorAll('.owl-dots .owl-dot span');

    owlDotsSpan.forEach((owlDot, index)=>{
        if (titlesData[index])
            return owlDotsSpan[index].textContent = titlesData[index].textContent;

        owlDot.style.display = 'none';
    })

    const owlDotsButtons = event.target.querySelectorAll('.owl-dots .owl-dot');


    owlDotsButtons.forEach(dot => {
        dot.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation(); // Bloqueia a propagação do clique
        });

        const buttonText = dot.firstElementChild.textContent;

        if (!buttonText) dot.remove();
    });

    addPaddingBottomToSection();


})



function formatToNumber(str){
    return Number(str.replaceAll('px', ''));
}


const allGaleries = document.querySelectorAll('.carousel-galeria');
allGaleries[0].classList.add('active');

const allGaleriesButtons = document.querySelectorAll('.gallery-section button');
allGaleriesButtons[0].classList.add('active');

// function formatNumber(value=> )

function addPaddingBottomToSection(){
    let mostHeight = 0;
    const sectionDiv = document.querySelector('#galeria');


    allGaleries.forEach(gallery => {
        const owlDots = gallery.querySelector('.owl-dots');
        const owlNav = gallery.querySelector('.owl-nav');

        if (!owlDots) return

        const { marginTop, marginBottom, height } = getComputedStyle(owlDots);

        const totalHeight = formatToNumber(marginTop) + formatToNumber(marginBottom) + formatToNumber(height);

        if (mostHeight < totalHeight) {
            mostHeight = totalHeight;
        }
    })

    sectionDiv.style.paddingBottom =  mostHeight + 'px';
}

addPaddingBottomToSection();

function setCarrouselActive(button){
    desactiveAllbuttons();

    allGaleries.forEach(function(galery){
        galery.classList.remove('active');

        if (galery.id === button.id){
            button.classList.add('active');
            galery.classList.add('active');
        }


    })
}

function desactiveAllbuttons(){
    const allGaleriesButtons = document.querySelectorAll('.gallery-section button');
    allGaleriesButtons.forEach(button=> button.classList.remove('active'));
}


