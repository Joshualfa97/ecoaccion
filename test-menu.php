<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Menu</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui; }
        
        .header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 70px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .header__container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .header__logo { color: #2d6a4f; font-weight: 700; font-size: 1.25rem; }
        
        /* HAMBURGER */
        .header__hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 28px; height: 20px;
            background: none; border: none; cursor: pointer;
        }
        .header__hamburger-line {
            display: block; width: 100%; height: 3px;
            background: #2d6a4f; border-radius: 999px;
            transition: transform 0.3s, opacity 0.3s;
        }
        
        /* NAV BASE */
        .header__nav { display: flex; }
        .header__nav-list { display: flex; gap: 0.5rem; }
        .header__nav-link {
            padding: 0.5rem 1rem; color: #495057;
            font-weight: 500; border-radius: 0.5rem;
        }
        
        /* MOBILE */
        @media (max-width: 700px) {
            .header__hamburger { display: flex; }
            .header__nav {
                position: absolute; top: 100%; left: 0; right: 0;
                background: white; box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                padding: 1rem; display: none; flex-direction: column;
            }
            .header__nav--open { display: flex; }
            .header__nav-list { flex-direction: column; width: 100%; }
            .header__nav-link { padding: 1rem; text-align: center; }
        }
        
        /* DESKTOP */
        @media (min-width: 701px) {
            .header__hamburger { display: none !important; }
            .header__nav { position: static; display: flex !important; }
            .header__nav-list { flex-direction: row !important; }
        }
        
        main { padding-top: 70px; padding: 2rem 1rem; max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <header class="header">
        <div class="header__container">
            <a href="#" class="header__logo">ECOACCIÓN</a>
            <nav class="header__nav" id="mainNav">
                <ul class="header__nav-list">
                    <li><a href="#" class="header__nav-link">Inicio</a></li>
                    <li><a href="#" class="header__nav-link">Nosotros</a></li>
                    <li><a href="#" class="header__nav-link">Cómo ayudar</a></li>
                    <li><a href="#" class="header__nav-link">Contacto</a></li>
                </ul>
            </nav>
            <button class="header__hamburger" id="hamburgerBtn" aria-label="Abrir menú" aria-expanded="false">
                <span class="header__hamburger-line" style="display:block;width:100%;height:3px;background:#2d6a4f;border-radius:999px;margin:3px 0;"></span>
                <span class="header__hamburger-line" style="display:block;width:100%;height:3px;background:#2d6a4f;border-radius:999px;margin:3px 0;"></span>
                <span class="header__hamburger-line" style="display:block;width:100%;height:3px;background:#2d6a4f;border-radius:999px;margin:3px 0;"></span>
            </button>
        </div>
    </header>
    <main>
        <h1>Test Menu Responsive</h1>
        <p>Ancho ventana: <span id="w"></span>px</p>
        <p>Resize la ventana para probar</p>
    </main>
    <script>
        (function() {
            const btn = document.getElementById('hamburgerBtn');
            const nav = document.getElementById('mainNav');
            if (!btn || !nav) return;
            
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const open = nav.classList.toggle('header__nav--open');
                btn.setAttribute('aria-expanded', open);
            });
            nav.querySelectorAll('a').forEach(function(a) {
                a.addEventListener('click', function() {
                    if (innerWidth <= 700) {
                        nav.classList.remove('header__nav--open');
                    }
                });
            });
            window.addEventListener('resize', function() {
                if (innerWidth > 700) {
                    nav.classList.remove('header__nav--open');
                }
            });
            setInterval(function(){ document.getElementById('w').textContent = innerWidth; }, 100);
            console.log('Test menu loaded');
        })();
    </script>
</body>
</html>