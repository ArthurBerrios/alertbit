<?php

namespace App\Jobs;

use App\Http\Services\CriptoService;
use App\Mail\AlertBitcoinMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobDispatchEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct() 
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $criptoService = app(CriptoService::class);
        $users = User::all();
        $bitcoins = $criptoService->getResponseApiBitcoin();

        foreach($bitcoins as $bitcoin){
            foreach($users as $user){
                if($bitcoin['last'] > $user->max_value)
                {
                    $notification = Notification::create([
                        'user_id' => $user->id,
                        'max' => true,
                        'min' => false,
                        'value' => round($bitcoin['formatted_price'], 2),
                        'broker' => $bitcoin['name']
                    ]);
                    $text = "O valor do bitcoin na corretora $notification->broker está $notification->value. Está acima do valor máximo configurado!";
                    $subject = "Valor do Bitcoin está acima do seu esperado!";

                    Mail::to($notification->user->email)->send(new AlertBitcoinMail($subject,$text));
                }
                if($bitcoin['last'] < $user->min_value)
                {
                    $notification = Notification::create([
                        'user_id' => $this->user->id,
                        'max' => false,
                        'min' => true,
                        'value' => round($bitcoin['formatted_price'], 2),
                        'broker' => $bitcoin['name']
                    ]);
                    $text = "O valor do bitcoin na corretora $notification->broker está $notification->value. Está abaixo do valor mínimo configurado!";
                    $subject = "Valor do Bitcoin está abaixo do seu esperado!";

                    Mail::to($notification->user->email)->send(new AlertBitcoinMail($subject,$text));
                }
            }
        }
    }
}
