<?php

namespace App\Http\Livewire;

use Exception;
use LVR\Colour\Hex;

class FinanceSettingsLivewire extends BaseLivewireComponent
{

    // App settings
    public $enableReferSystem;
    public $referRewardAmount;
    public $enableDriverWallet;
    public $driverWalletRequired;
    public $vendorEarningEnabled;
    public $driversCommission;
    public $vendorsCommission;
    public $minimumTopupAmount;
    public $walletTopupPercentage;
    public $vendorSetDeliveryFee;
    public $allowWallet;
    public $allowWalletTransfer;
    public $fullInfoRequired;
    public $preventOrderCancellation = [];
    public $autoRefund;
    public $collectDeliveryCash;

    //
    public $generalTax;
    public $minOrderAmount;
    public $maxOrderAmount;

    public $charge_per_km;
    public $base_delivery_fee;
    public $delivery_fee;
    public $delivery_range;


    public $orderStatues = [];


    public function mount()
    {
        //

        $this->enableDriverWallet = (bool) setting('enableDriverWallet');
        $this->driverWalletRequired = (bool) setting('driverWalletRequired');
        $this->vendorEarningEnabled = (bool) setting('vendorEarningEnabled');
        $this->enableReferSystem = (bool) setting('enableReferSystem');
        $this->vendorSetDeliveryFee = (bool) setting('vendorSetDeliveryFee');
        $this->referRewardAmount = (float) setting('referRewardAmount');
        $this->driversCommission = setting('driversCommission', "0");
        $this->vendorsCommission = setting('vendorsCommission', "0");
        $this->minimumTopupAmount = setting('minimumTopupAmount', 100);
        $this->walletTopupPercentage = setting('walletTopupPercentage', 100);
        $this->allowWallet = (bool) setting('finance.allowWallet', true);
        $this->allowWalletTransfer = (bool) setting('finance.allowWalletTransfer', true);
        $this->fullInfoRequired = (bool) setting('finance.fullInfoRequired', false);
        $this->preventOrderCancellation = setting('finance.preventOrderCancellation', "");
        if (!is_array($this->preventOrderCancellation)) {
            $this->preventOrderCancellation = json_decode(setting('finance.preventOrderCancellation', ""), true) ?? [];
        }
        $this->orderStatues = config("backend.order.statuses") ?? [];
        $this->autoRefund = (bool) setting('finance.autoRefund', true);
        // 
        $this->generalTax = setting('finance.generalTax', 0);
        $this->minOrderAmount = setting('finance.minOrderAmount', 0);
        $this->maxOrderAmount = setting('finance.maxOrderAmount', 1000000);

        $this->charge_per_km = (bool) setting('finance.delivery.charge_per_km', 0);
        $this->base_delivery_fee = setting('finance.delivery.base_delivery_fee');
        $this->delivery_fee = setting('finance.delivery.delivery_fee');
        $this->delivery_range = setting('finance.delivery.delivery_range');
        $this->collectDeliveryCash = (bool) setting('finance.delivery.collectDeliveryCash', 0);
    }

    public function render()
    {

        $this->mount();
        return view('livewire.settings.finance-settings');
    }


    public function saveAppSettings()
    {


        try {

            $this->isDemo();
            $appSettings = [
                'enableDriverWallet' =>  $this->enableDriverWallet,
                'driverWalletRequired' =>  $this->driverWalletRequired,
                'vendorEarningEnabled' =>  $this->vendorEarningEnabled,
                'driversCommission' =>  $this->driversCommission,
                'vendorsCommission' =>  $this->vendorsCommission,
                'minimumTopupAmount' =>  $this->minimumTopupAmount,
                'walletTopupPercentage' =>  $this->walletTopupPercentage,
                'enableReferSystem' =>  $this->enableReferSystem,
                'referRewardAmount' =>  $this->referRewardAmount,
                'vendorSetDeliveryFee' =>  $this->vendorSetDeliveryFee,
                'finance' => [
                    'allowWallet' =>  $this->allowWallet,
                    'allowWalletTransfer' =>  $this->allowWalletTransfer,
                    'fullInfoRequired' =>  $this->fullInfoRequired,
                    'preventOrderCancellation' => json_encode($this->preventOrderCancellation),
                    'autoRefund' =>  $this->autoRefund,
                    'generalTax' =>  $this->generalTax,
                    'minOrderAmount' =>  $this->minOrderAmount,
                    'maxOrderAmount' =>  $this->maxOrderAmount,
                    'delivery' =>  [
                        'charge_per_km' =>  $this->charge_per_km,
                        'base_delivery_fee' =>  $this->base_delivery_fee,
                        'delivery_fee' =>  $this->delivery_fee,
                        'delivery_range' =>  $this->delivery_range,
                        'collectDeliveryCash' =>  $this->collectDeliveryCash,
                    ],
                ],
            ];

            // update the site name
            setting($appSettings)->save();



            $this->showSuccessAlert(__("Finance Settings saved successfully!"));
            $this->reset();
        } catch (Exception $error) {
            logger("error", [$error]);
            $this->showErrorAlert($error->getMessage() ?? __("Finance Settings save failed!"));
        }
    }
}
