<!DOCTYPE html>
<html lang="pt-BR" data-theme="{{ request()->cookie('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Gestão') | Laravel MVC</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --accent: #6366f1;
            --accent-hover: #4f46e5;
            --accent-light: #e0e7ff;
            --success: #10b981;
            --success-bg: #d1fae5;
            --error: #ef4444;
            --error-bg: #fee2e2;
            --warning: #f59e0b;
            --border: #e2e8f0;
            --shadow: rgba(15, 23, 42, 0.08);
            --gradient-start: #6366f1;
            --gradient-end: #8b5cf6;
        }

        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #64748b;
            --accent: #818cf8;
            --accent-hover: #6366f1;
            --accent-light: #312e81;
            --success: #34d399;
            --success-bg: #064e3b;
            --error: #f87171;
            --error-bg: #7f1d1d;
            --border: #334155;
            --shadow: rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Header/Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            padding: 1rem 0;
        }

        .navbar-brand svg {
            width: 32px;
            height: 32px;
        }

        .navbar-menu {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .navbar-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .navbar-menu a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .navbar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .theme-toggle {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .theme-toggle svg {
            width: 20px;
            height: 20px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .page-subtitle {
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .alert-error {
            background: var(--error-bg);
            color: var(--error);
            border: 1px solid var(--error);
        }

        .alert svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Cards */
        .card {
            background: var(--bg-secondary);
            border-radius: 16px;
            box-shadow: 0 4px 20px var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px var(--shadow);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            background: var(--bg-tertiary);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .form-label .required {
            color: var(--error);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        select.form-control {
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        /* File Upload */
        .file-upload {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--bg-tertiary);
        }

        .file-upload:hover {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            color: var(--text-muted);
        }

        .file-upload-text {
            color: var(--text-secondary);
        }

        .file-upload-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
        }

        .btn svg {
            width: 18px;
            height: 18px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: var(--bg-tertiary);
            color: var(--text-primary);
            border: 2px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            filter: brightness(1.1);
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            filter: brightness(1.1);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem 1.25rem;
            text-align: left;
        }

        th {
            background: var(--bg-tertiary);
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border);
        }

        td {
            border-bottom: 1px solid var(--border);
            color: var(--text-secondary);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--bg-tertiary);
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        .product-image-placeholder {
            width: 60px;
            height: 60px;
            background: var(--bg-tertiary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary {
            background: var(--accent-light);
            color: var(--accent);
        }

        .badge-success {
            background: var(--success-bg);
            color: var(--success);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        /* Cookie Banner */
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--bg-secondary);
            padding: 1rem 2rem;
            box-shadow: 0 -4px 20px var(--shadow);
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            border-top: 1px solid var(--border);
            z-index: 1000;
        }

        .cookie-banner.show {
            display: flex;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mb-2 { margin-bottom: 1rem; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-1 { gap: 0.5rem; }
        .gap-2 { gap: 1rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zm-2-2H7v-1h10v1zm0-3H7v-1h10v1zm0-3H7V9h10v2z"/>
            </svg>
            Sistema MVC
        </a>

        <div class="navbar-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                🏠 Home
            </a>
            <a href="{{ route('produtos.index') }}" class="{{ request()->routeIs('produtos.*') ? 'active' : '' }}">
                📦 Produtos
            </a>
            <a href="{{ route('categorias.index') }}" class="{{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                🏷️ Categorias
            </a>
        </div>

        <div class="navbar-actions">
            @if(session('user_nome'))
                <span class="user-info">👋 {{ session('user_nome') }}</span>
            @endif
            
            <button class="theme-toggle" onclick="toggleTheme()" title="Alternar tema">
                <svg id="theme-icon-light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="{{ request()->cookie('theme', 'light') === 'dark' ? 'display:none' : '' }}">
                    <path d="M12 3a1 1 0 011 1v1a1 1 0 11-2 0V4a1 1 0 011-1zm0 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm9-6a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5 12a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zm12.95 4.95a1 1 0 010 1.41l-.7.71a1 1 0 11-1.42-1.42l.71-.7a1 1 0 011.41 0zM7.05 7.05a1 1 0 010 1.41l-.7.71A1 1 0 114.93 7.76l.71-.71a1 1 0 011.41 0zm10.61 1.41a1 1 0 01-1.41 0l-.71-.7a1 1 0 111.42-1.42l.7.71a1 1 0 010 1.41zM7.05 16.95a1 1 0 01-1.41 0l-.71-.7a1 1 0 111.42-1.42l.7.71a1 1 0 010 1.41zM12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg id="theme-icon-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="{{ request()->cookie('theme', 'light') === 'light' ? 'display:none' : '' }}">
                    <path d="M12.1 22c-5.5 0-10-4.5-10-10 0-4.8 3.4-8.8 8.1-9.8.5-.1.9.4.7.9-.8 2-1.1 4.4-.3 6.8 1.1 3.3 4.1 5.7 7.6 6 .5 0 .8.5.6.9-1.7 3.2-5 5.2-8.7 5.2h2z"/>
                </svg>
            </button>

            @if(session('user_id'))
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Sair</button>
                </form>
            @endif
        </div>
    </nav>

    <main class="main-container">
        @if(session('success'))
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Cookie Notice (mostra última categoria visitada) -->
    @if(request()->cookie('ultima_categoria_visitada'))
        <div class="cookie-banner show" id="cookieBanner">
            <span>🍪 Última categoria visitada: <strong>{{ request()->cookie('ultima_categoria_visitada') }}</strong></span>
            <button class="btn btn-sm btn-secondary" onclick="document.getElementById('cookieBanner').style.display='none'">Fechar</button>
        </div>
    @endif

    <script>
        // Toggle Theme (usando Cookie)
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            
            // Salva no cookie via AJAX
            fetch('{{ route("toggle.theme") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => response.json()).then(data => {
                // Atualiza ícones
                document.getElementById('theme-icon-light').style.display = data.theme === 'dark' ? 'none' : 'block';
                document.getElementById('theme-icon-dark').style.display = data.theme === 'light' ? 'none' : 'block';
            });
        }

        // File Upload Preview
        function handleFileUpload(input) {
            const preview = document.getElementById('imagePreview');
            const uploadText = input.closest('.file-upload').querySelector('.file-upload-text');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    if (uploadText) {
                        uploadText.textContent = input.files[0].name;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
