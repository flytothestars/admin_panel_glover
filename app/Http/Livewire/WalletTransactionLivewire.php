<?php

namespace App\Http\Livewire;

use App\Models\WalletTransaction;

class WalletTransactionLivewire extends BaseLivewireComponent
{

    //
    public $model = WalletTransaction::class;

    public function mount(){
        request()->session()->put('current_url', route('wallet.transactions'));
    }

    public function render()
    {
        return view('livewire.wallet-transactions');
    }


}
