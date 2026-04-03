<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlertaBit | Monitor de Bitcoin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
        .glass-card { 
            background: rgba(30, 41, 59, 0.7); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .crypto-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <div class="max-w-7xl mx-auto">
        <header class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    <span class="crypto-gradient p-2 rounded-lg text-white">
                        <i class="fa-brands fa-bitcoin"></i>
                    </span>
                    AlertaBit
                </h1>
                <p class="text-slate-400 mt-1">Monitoramento do bitcoin em tempo real em diversas corretoras</p>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                    Live Updates
                </span>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-xl font-semibold mb-4">Principais corretoras</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    @foreach ($bits as $bit )
                        <div class="glass-card p-6 rounded-2xl hover:border-amber-500/50 transition-all cursor-pointer group">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-slate-400 font-medium">{{$bit['name']}}</span>
                                <span class="text-sm font-bold {{ $bit['variation'] < 0 ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $bit['variation']}}
                                </span>
                            </div>
                            <div class="text-2xl font-bold tracking-tight">
                               R$ {{number_format($bit['formatted_price'], 2, ',', '.')}}
                            </div>
                            <div class="mt-4 h-1 w-full bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 w-2/3 group-hover:w-full transition-all duration-700"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="glass-card p-8 rounded-3xl sticky top-8 border-amber-500/20">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-bell text-amber-500"></i> Alertas
                    </h2>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Valor Máximo (R$)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-slate-500 font-semibold">R$</span>
                                <input type="number" step="0.01" name="max_value" value="{{ Auth::user()->config->max_value ?? 0 }}"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-amber-500 focus:outline-none transition-all">
                            </div>
                            <p class="text-[10px] text-slate-500 mt-2">Notificar quando o preço subir acima deste valor.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Valor Mínimo (R$)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-slate-500 font-semibold">R$</span>
                                <input type="number" step="0.01" name="min_value" value="{{ Auth::user()->config->min_value ?? 0 }}" 
                                    class="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-red-500 focus:outline-none transition-all">
                            </div>
                            <p class="text-[10px] text-slate-500 mt-2">Notificar quando o preço cair abaixo deste valor.</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-4 rounded-xl transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-amber-500/20">
                                Salvar Configurações
                            </button>
                        </div>
                    </form>

                    <hr class="my-8 border-slate-700">

                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Histórico de Alertas</h3>
                        @if(!empty($notificiations))
                            <div class="flex items-center gap-3 text-sm text-slate-500 italic">
                                <i class="fa-solid fa-circle-info"></i>
                                Nenhum alerta disparado recentemente.
                            </div>
                        @else
                        <div class="space-y-3">
                            @foreach($notifications as $notification)
                                <div class="flex items-center justify-between p-4 rounded-xl bg-slate-800/50 border border-slate-700/50 hover:border-slate-600 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $notification->max ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500' }}">
                                            <i class="fa-solid {{ $notification->max ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-slate-200">{{ $notification->broker }}</h4>
                                            <p class="text-xs text-slate-500">
                                                {{ $notification->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <span class="block text-sm font-bold text-slate-100">
                                            R$ {{ number_format($notification->value, 2, ',', '.') }}
                                        </span>
                                        <span class="text-[10px] uppercase tracking-widest font-semibold {{ $notification->max ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $notification->max ? 'Atingiu Máximo' : 'Atingiu Mínimo' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>