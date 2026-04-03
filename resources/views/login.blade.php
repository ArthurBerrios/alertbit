<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlertaBit | Entrar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #0f172a; 
            background-image: radial-gradient(circle at top right, rgba(245, 158, 11, 0.1), transparent), 
                              radial-gradient(circle at bottom left, rgba(245, 158, 11, 0.05), transparent);
            color: #f8fafc; 
        }
        .glass-card { 
            background: rgba(30, 41, 59, 0.7); 
            backdrop-filter: blur(16px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .crypto-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex crypto-gradient p-3 rounded-2xl text-white text-3xl mb-4 shadow-lg shadow-amber-500/20">
                <i class="fa-brands fa-bitcoin"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight">Bem-vindo ao <span class="text-amber-500">AlertaBit</span></h1>
            <p class="text-slate-400 mt-2">Sincronize seus alertas em tempo real</p>
            @if (session('error'))
                <p class="text-slate-400 mt-2">{{session('error')}}</p>
            @endif
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-2xl">
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-1.5 ml-1">E-mail</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-3.5 text-slate-500 group-focus-within:text-amber-500 transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl py-3 pl-11 pr-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent focus:outline-none transition-all placeholder:text-slate-600"
                            placeholder="seu@email.com">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5 ml-1">
                        <label class="block text-sm font-medium text-slate-400">Senha</label>
                        <a href="#" class="text-xs text-amber-500 hover:text-amber-400 transition-colors">Esqueceu a senha?</a>
                    </div>
                    <div class="relative group">
                        <span class="absolute left-4 top-3.5 text-slate-500 group-focus-within:text-amber-500 transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full bg-slate-900/50 border border-slate-700 rounded-xl py-3 pl-11 pr-4 focus:ring-2 focus:ring-amber-500 focus:border-transparent focus:outline-none transition-all placeholder:text-slate-600"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-3.5 rounded-xl transition-all transform hover:scale-[1.01] active:scale-95 shadow-lg shadow-amber-500/20">
                        Acessar Dashboard
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-700/50 text-center text-sm">
                <span class="text-slate-500">Não tem uma conta?</span>
                <a href="/register" class="text-amber-500 font-semibold hover:underline ml-1">Criar conta gratuita</a>
            </div>
        </div>

        <footer class="mt-8 text-center text-xs text-slate-600">
            &copy; 2026 AlertaBit. Desenvolvido por Arthur Berrios.
        </footer>
    </div>

</body>
</html>