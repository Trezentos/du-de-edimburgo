jQuery(document).ready(function($) {
    const glassContainer = document.querySelector('.glass-container');
    const glassText = glassContainer.querySelector('p');
    const backgroundImage = document.querySelector('.background-image');

    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    const doTheOndulatingEffect = () => {
        const scrollInicial = __Scroll.getOffsetTop('.glass-container');
        const scrollPos = __Scroll.scrollPosition;
        const percent = ((scrollPos * 100) / scrollInicial).toFixed(2);
        const percentValue = parseFloat(percent);

        console.log(percentValue);

        if (percentValue >= 90 && typeof window !== 'undefined') {
            window.targetActive = 1.0;
        } else if (typeof window !== 'undefined') {
            window.targetActive = 0.0;
        }
    };

    __Scroll.scrollContainer.addEventListener('wheel', doTheOndulatingEffect);

    // === THREE.JS WAVE EFFECT SETUP ===
    const container = backgroundImage.parentElement;
    container.classList.add('image-container-astro-js');

    const vertexShader = `
      varying vec2 vUv;
      void main(){
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
      }
    `;

    const fragmentShader = `
      precision mediump float;
      uniform float u_time;
      uniform sampler2D u_texture;
      uniform float u_active;
      uniform vec2 u_center;
      varying vec2 vUv;

      void main() {
        float amp = 0.1;
        float speed = 0.30;
        float frequency = 10.0;

        float dist = distance(vUv, u_center);
        float wave = sin((dist - u_time * speed) * frequency);
        float attenuation = 0.3 / (1.0 + dist * 10.0);
        float offset = wave * attenuation * u_active;

        vec2 distortedUv = vUv + (vUv - u_center) * offset;

        gl_FragColor = texture2D(u_texture, clamp(distortedUv, 0.0, 1.0));
      }
    `;

    let scene, camera, renderer, material, mesh;
    let startTime = Date.now();

    const center = new THREE.Vector2(0.5, 0.1); // centro da imagem
    window.targetActive = 0.0;
    const bgUrl = backgroundImage.src;

    function init() {
        scene = new THREE.Scene();

        const width = container.clientWidth;
        const height = container.clientHeight;

        camera = new THREE.OrthographicCamera(
            width / -2, width / 2,
            height / 2, height / -2,
            1, 1000
        );
        camera.position.z = 100;

        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(width, height);
        container.appendChild(renderer.domElement);

        const textureLoader = new THREE.TextureLoader();
        const texture = textureLoader.load(bgUrl, () => {
            // cover equivalente (imagem 1920x1839)
            const imageAspect = 1920 / 1839;
            const containerAspect = width / height;

            if (imageAspect > containerAspect) {
                const scaleX = containerAspect / imageAspect;
                texture.repeat.set(scaleX, 1);
                texture.offset.set((1 - scaleX) / 2, 0);
            } else {
                const scaleY = imageAspect / containerAspect;
                texture.repeat.set(1, scaleY);
                texture.offset.set(0, (1 - scaleY) / 2);
            }

            texture.wrapS = THREE.ClampToEdgeWrapping;
            texture.wrapT = THREE.ClampToEdgeWrapping;
        });

        const geometry = new THREE.PlaneGeometry(width, height, 32, 32);

        material = new THREE.ShaderMaterial({
            uniforms: {
                u_time: { value: 0.0 },
                u_texture: { value: texture },
                u_active: { value: 0.0 },
                u_center: { value: center }
            },
            vertexShader: vertexShader,
            fragmentShader: fragmentShader,
            transparent: true
        });

        mesh = new THREE.Mesh(geometry, material);
        scene.add(mesh);

        window.addEventListener('resize', onWindowResize, false);
    }

    function onWindowResize() {
        const width = container.clientWidth;
        const height = container.clientHeight;
        renderer.setSize(width, height);
        camera.left = width / -2;
        camera.right = width / 2;
        camera.top = height / 2;
        camera.bottom = height / -2;
        camera.updateProjectionMatrix();
    }

    function animate() {
        requestAnimationFrame(animate);
        const elapsedTime = (Date.now() - startTime) * 0.001;
        material.uniforms.u_time.value = elapsedTime;
        material.uniforms.u_active.value += (window.targetActive - material.uniforms.u_active.value) * 0.05;
        renderer.render(scene, camera);
    }

    init();
    animate();
});