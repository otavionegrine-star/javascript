<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pro</title>
    <style>
        /* Variáveis CSS para temas */
        :root {
            /* Variáveis para Tema Claro */
            --bg-body: #f4efff;
            --bg-card: #faf5ff;
            --text-main: #3f2b55;
            --primary: #8a4fff;
            --border: #d6c2ff;
        }

        /* Sobrescreve variáveis se o tema for Dark */
        [data-theme="dark"] {
            --bg-body: #1f1832;
            --bg-card: #2b2146;
            --text-main: #e6d9ff;
            --primary: #a15cff;
            --border: #4c3d6f;
        }

        /* Estilos do corpo da página */
        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: all 0.3s ease;
        }

        .page-title {
            text-align: center;
            margin: 0 0 1.25rem;
            font-size: 2rem;
            color: var(--text-main);
        }

        .page-layout {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
            padding: 1.5rem 1rem;
            box-sizing: border-box;
        }

        /* Container principal */
        .container {
            background: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            width: 100%;
            max-width: 400px;
            border: 1px solid var(--border);
        }

        /* Cabeçalho da página */
        header {
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Badge do usuário */
        .user-badge {
            background: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Grupos de formulário */
        .form-group { margin-bottom: 1.5rem; }

        /* Labels */
        label { display: block; margin-bottom: 0.5rem; font-weight: 600; }

        /* Inputs e selects */
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--bg-body);
            color: var(--text-main);
            box-sizing: border-box;
        }

        /* Botões */
        button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        button:hover { opacity: 0.9; }

        /* Rodapé */
        footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.75rem;
            color: #888;
        }
    </style>
</head>
<body data-theme="<?php echo $tema_atual ?? 'light'; ?>">
    <main class="page-layout">
        <?php echo $page_title ?? ''; ?>
        <div class="container">
            <header>
                <span class="user-badge">Sessão Ativa</span>
                <h2>Olá, <?php echo $nome_display ?? 'Visitante'; ?>!</h2>
        </header>