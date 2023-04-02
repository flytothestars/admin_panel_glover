@section('title', __('Finance Settings'))
<div>

    <x-baseview title="{{ __('Finance Settings') }}">

        <x-form action="saveAppSettings">

            <div class="">
                <p class="pt-4 text-2xl">{{ __("Refer") }}</p>
                <div class='grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3'>

                    {{-- refer --}}
                    <div class="block mt-4 text-sm">
                        <p>{{ __('Refer System') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="enableReferSystem" :defer="true" />
                    </div>
                    <div x-data="{ open: @entangle('enableReferSystem') }">
                        <x-input title="{{ __('Refer Amount') }}" name="referRewardAmount" />
                    </div>


                </div>




                {{-- Driver releated settings --}}
                <p class="pt-4 mt-10 text-2xl border-t">{{ __('Earning') }}</p>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 '>

                    <div class="block p-2 mt-4 text-sm border rounded">
                        <p>{{ __('Vendor Earning') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="vendorEarningEnabled" :defer="true" />

                        <p class="py-2 text-xs font-light"><span class="pr-2 text-sm font-medium text-red-600">Note:</span>{{ __('Vendor Earning Enable(irrespective of the payment method used)') }}</p>
                    </div>


                    <div class="block p-2 mt-4 text-sm border rounded">
                        <p>{{ __('Driver Wallet Balance Require') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="driverWalletRequired" :defer="true" />
                        <p class="py-2 text-xs font-light"><span class="pr-2 text-sm font-medium text-red-600">Note:</span>{{ __('Driver must have enough in wallet balance irrespective of the payment method') }}</p>
                    </div>

                    <div class="block mt-4 text-sm">
                        <p>{{ __('Driver Wallet System') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="enableDriverWallet" :defer="true" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <p>{{ __('Enforce Cash Delivery Payment') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="collectDeliveryCash" :defer="true" />
                        <p class="py-2 text-xs font-light"><span class="pr-2 text-sm font-medium text-red-600">Note:</span>{{ __('Irrespective of the order payment method, order delivery fee will have to be paid in cash to delivery personal') }}</p>
                    </div>


                </div>
                {{-- Finance --}}
                <p class="pt-4 mt-10 text-2xl border-t">{{ __("Finance") }}</p>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 lg:grid-cols-3'>
                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('General Drivers Commission') }}(%)" name="driversCommission" />
                    </div>

                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('General Vendors Commission') }}(%)" name="vendorsCommission" />
                    </div>

                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('Minimum Wallet Topup Ammount') }}" name="minimumTopupAmount" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <p>{{ __('Vendor can set delivery fee') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" name="vendorSetDeliveryFee" :defer="true" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <x-select title="{{ __('Prevent Order Cancellation') }}" name="preventOrderCancellation" :multiple="true" :options="$orderStatues ?? []" />
                    </div>
                </div>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 lg:grid-cols-3'>
                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('General Vendors Tax') }}(%)" name="generalTax" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('General Vendors Min Order Amount') }}" name="minOrderAmount" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('General Vendors Max Order Amount') }}" name="maxOrderAmount" />
                    </div>
                </div>

                <p class="pt-4 mt-10 text-2xl border-t">{{ __("Delivery") }}</p>
                <p class="text-xs italic">{{ __("Delivery info below will be use for vendor withut delivery info") }}</p>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 lg:grid-cols-3'>
                    <x-checkbox title="{{ __('Charge per KM') }}" name="charge_per_km" description="{{ __('Delivery fee will be per KM') }}" />
                    <x-input title="{{ __('Base Delivery Fee') }}" name="base_delivery_fee" />
                    <x-input title="{{ __('Delivery Fee') }}" name="delivery_fee" />

                    <x-input title="{{ __('Delivery Range(KM)') }}" name="delivery_range" />

                </div>


                {{-- Wallet --}}
                <p class="pt-4 mt-10 text-2xl border-t">{{ __("Wallet") }}</p>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 lg:grid-cols-3'>
                    <div class="block mt-4 text-sm">
                        <p>{{ __('Wallet') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" description="{{ __('Allow wallet') }}" name="allowWallet" :defer="true" />
                    </div>

                    <div class="block mt-4 text-sm">
                        <p>{{ __('Wallet Transfer') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" description="{{ __('Allow wallet transfer between users') }}" name="allowWalletTransfer" :defer="true" />
                    </div>

                    <div class="block mt-4 text-sm">
                        <p>{{ __('Require Full Customer Info') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" description="{{ __('Customer must enter full email or phone number of the user they want to transfer to') }}" name="fullInfoRequired" :defer="true" />
                    </div>
                    <div class="block mt-4 text-sm">
                        <x-input title="{{ __('Wallet Topup Percentage') }} (%)" name="walletTopupPercentage" />
                        <p class="text-xs font-light text-gray-600">
                            {{ __('You can set the percenatge of the wallet topup amount that should be credited to user during wallet topup') }}
                        </p>
                        <p class="text-xs italic font-light text-red-500">
                            {{ __('For eaxmple: You set 90%, if user try to topup wallet with U$100, after payment their wallet will be credited U$90') }}
                        </p>
                    </div>

                </div>

                {{-- Refund --}}
                <p class="pt-4 mt-10 text-2xl border-t">{{ __("Refunds") }}</p>
                <div class='grid grid-cols-1 gap-4 mb-10 md:grid-cols-2 lg:grid-cols-3'>
                    <div class="block mt-4 text-sm">
                        <p>{{ __('Auto Payment Refund') }}</p>
                        <x-checkbox title="{{ __('Enable') }}" description="{{ __('Order amount will automatically be refund to user wallet if payment was successful but order failed') }}" name="autoRefund" :defer="true" />
                    </div>

                </div>


                <x-buttons.primary title="{{ __('Save Changes') }}" />
                <div>
        </x-form>

    </x-baseview>

</div>
