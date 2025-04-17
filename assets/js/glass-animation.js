jQuery(document).ready(function($) {
    const glassContainer = document.querySelector('.glass-container');
    const glassText = glassContainer.querySelector('p');

    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    const updateGlassEffect = () => {
        const scrollInicial = __Scroll.getOffsetTop('.glass-container');
        const scrollPos = __Scroll.scrollPosition;
        const percent = ((scrollPos * 100) / scrollInicial).toFixed(2);
        const percentValue = parseFloat(percent);

        // Opacidade da glass-container entre 60% e 80%
        const containerProgress = clamp((percentValue - 60) / 20, 0, 1);
        const containerOpacity = containerProgress.toFixed(2);
        glassContainer.style.opacity = containerOpacity;

        // Opacidade do texto entre 74% e 90%
        const textProgress = clamp((percentValue - 74) / 16, 0, 1);
        const translateY = (30 * (1 - textProgress)).toFixed(1);

        Object.assign(glassText.style, {
            opacity: textProgress.toFixed(2),
            top: `${translateY}px`,
            position: 'relative'
        });

        // Blur e borda entre 79% e 100%
        if (percentValue >= 79 && percentValue <= 100) {
            const progress = (percentValue - 79) / 21;
            const blurValue = (progress * 20).toFixed(1);
            const borderOpacity = (progress * 0.3).toFixed(2);

            Object.assign(glassContainer.style, {
                backdropFilter: `blur(${blurValue}px)`,
                webkitBackdropFilter: `blur(${blurValue}px)`,
                border: `3.5px solid rgba(255, 255, 255, ${borderOpacity})`
            });
        } else if (percentValue < 79) {
            Object.assign(glassContainer.style, {
                backdropFilter: 'blur(0px)',
                webkitBackdropFilter: 'blur(0px)',
                border: '3.5px solid rgba(255, 255, 255, 0)'
            });
        } else {
            Object.assign(glassContainer.style, {
                backdropFilter: 'blur(20px)',
                webkitBackdropFilter: 'blur(20px)',
                border: '3.5px solid rgba(255, 255, 255, 0.3)'
            });
        }
    };

    __Scroll.scrollContainer.addEventListener('wheel', updateGlassEffect);
});
