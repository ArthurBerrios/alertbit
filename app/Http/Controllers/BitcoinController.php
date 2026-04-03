<?php

namespace App\Http\Controllers;

use App\Http\Services\CriptoService;
use App\Models\ConfigNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;

class BitcoinController extends Controller
{
    public function __construct(
        private CriptoService $criptoService,
    )
    {}
    public function index()
    {
        $bits = $this->criptoService->getResponseApiBitcoin();
        $notifications = Auth::user()->notifications->sortByDesc('created_at');

        return view('bitcoin', compact('bits', 'notifications'));
    }
    public function updateConfig(Request $request)
    {
        $config = ConfigNotification::where('user_id',Auth::user()->id)->first();
        
        if($config)
        {
            $config->update([
                'max_value' => $request->max_value,
                'min_value' => $request->min_value
            ]);
        }else{ ConfigNotification::create([
                'max_value' => $request->max_value,
                'min_value' => $request->min_value,
                'user_id' => Auth::user()->id
            ]);}
        
        return redirect()->route('bitcoin.index');
    }
}
