<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->





<style>
    /* ---- particles.js container ---- */
    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #e62e2d;
        background-image: url("");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
        z-index: -1;

    }

    .count-particles {
        background: #000022;
        position: absolute;
        top: 48px;
        left: 0;
        width: 80px;
        color: #13E8E9;
        font-size: .8em;
        text-align: left;
        text-indent: 4px;
        line-height: 14px;
        padding-bottom: 2px;
    }

    .js-count-particles {
        font-size: 1.1em;
    }

    #Stats,
    .count-particles {
        -webkit-user-select: none;
        margin-top: 5px;
        margin-left: 5px;
    }

    #Stats {
        border-radius: 3px 3px 0 0;
        overflow: hidden;
    }

    .count-particles {
        border-radius: 0 0 3px 3px;
    }

    #particles-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;

    }
</style>

<nav class="navbar navbar-dark bg-dark fixed-top">
    <div id="particles-container"></div>
    <a class="navbar-brand">
        <h6 style="color:aliceblue;margin-left: 10px;">CONTROL & <br> GESTIÓN <br> DE INVENTARIOS</h6>
    </a>
    <a href="">
        <img class="logo" style="margin-right: 100px;" src="../../../assets/image/faviconplanta.png">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="">
                <a href=""><img id="inicioavatar" class="logo" src="../../../assets/image/perfil.png"></a>
            </div>
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                <h6 style="color:aliceblue">CONTROL Y GESTIÓN DE INVENTARIOS</h6>
                <p class="user"> Usuario <br><?php echo utf8_encode($_SESSION['usuario']); ?></p>
                <p class="user"> Nombre <br><?php echo utf8_encode($_SESSION['NOMBRE']); ?></p>
            </h5>
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./inicio.php">Inicio </a>
                </li>
                <a class="btn btn-danger btnCloseSesion" href="../../../closeSesion.php" role="button">Cerrar Sesión</a>
            </ul>
        </div>
    </div>
</nav>


<!-- script de particulas -->
<script>
    particlesJS("particles-container", {
        "particles": {
            "number": {
                "value": 300,
                "density": {
                    "enable": true,
                    "value_area": 930
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 2,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
    // var count_particles, Stats, update;
    // Stats = new Stats;
    // Stats.setMode(0);
    // Stats.domElement.style.position = 'absolute';
    // Stats.domElement.style.left = '0px';
    // Stats.domElement.style.top = '0px';
    // document.body.appendChild(Stats.domElement);
    // count_particles = document.querySelector('.js-count-particles');
    // update = function() {
    //     Stats.begin();
    //     Stats.end();
    //     if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
    //         count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    //     }
    //     requestAnimationFrame(update);
    // };
    // requestAnimationFrame(update);;
</script>


