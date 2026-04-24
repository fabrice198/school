// Lightweight slice-style 3D background using Three.js
(function(){
    const container = document.getElementById('bg3d');
    if (!container) return;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 20;

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setPixelRatio(Math.min(1.5, window.devicePixelRatio || 1));
    renderer.setSize(window.innerWidth, window.innerHeight);
    container.appendChild(renderer.domElement);

    const group = new THREE.Group();
    scene.add(group);

    const slices = 20;
    const spacing = 1.2;

    for (let i = 0; i < slices; i++) {
        const geom = new THREE.PlaneGeometry(30, 18, 1, 1);
        const h = (i / slices) * 0.65 + 0.05; // hue spread
        const col = new THREE.Color().setHSL(h, 0.6, 0.5);
        const mat = new THREE.MeshBasicMaterial({ color: col, transparent: true, opacity: 0.8, side: THREE.DoubleSide });
        const mesh = new THREE.Mesh(geom, mat);
        mesh.position.z = -i * spacing;
        mesh.position.y = (i - slices / 2) * 0.25;
        mesh.rotation.z = (i % 2 ? 0.02 : -0.02) * (1 + (i % 3));
        group.add(mesh);
    }

    const clock = new THREE.Clock();

    function animate() {
        const t = clock.getElapsedTime();
        group.children.forEach((m, i) => {
            m.position.z = -i * spacing + Math.sin(t * 0.7 + i * 0.6) * 0.6;
            m.rotation.y = Math.sin(t * 0.4 + i * 0.5) * 0.12;
            m.material.opacity = 0.6 + Math.sin(t * 0.5 + i * 0.3) * 0.12;
        });
        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    }

    function onResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    // Pause rendering when tab is hidden to save CPU
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            renderer.setAnimationLoop(null);
        } else {
            clock.start();
            renderer.setAnimationLoop(animate);
        }
    });

    window.addEventListener('resize', onResize);

    // Start animation
    animate();
})();
