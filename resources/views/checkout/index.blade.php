<x-app-layout>
    <div class="-mb-16 text-gray-700" x-data="{
        pago: 1}">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="text-2xl font-semibold mb-2">
                        Pago
                    </h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="1">
                                    <span class="ml-2">
                                        Deposito Bancario o Yape
                                    </span>
                                </label>

                                <div x-show="pago == 1"  class="p-4 bg-gray-100 flex justify-center border-t border-gray-400">
                                    <div>
                                        <p>1. Pago por depósito o transferencia bancaria:</p>
                                        <p>- BCP soles: 189-156546251-98</p>
                                        <p>- CCI: 002-189-156546251</p>
                                        <p>- Razón social: NubeNupcial</p>
                                        <p>- RUC: 20703211319</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al número 963 761 877 (NubeNupcial)</p>
                                        <p>
                                            Enviar el comprobante de pago a 963 761 877
                                        </p>
                                    </div>
                                </div>
                            </li>

                            @if ($configuration['paymentMethod'] == 2)
                                
                                <li>
                                    <label class="p-4 flex items-center">
                                        <input type="radio" x-model="pago" value="2">
                                        <span class="ml-2">
                                            Tarjeta de débito / crédito
                                        </span>
                                        <i class="h-6 ml-auto fa-solid fa-credit-card"></i>
                                    </label>

                                    <div x-cloak x-show="pago == 2" class="p-4 bg-gray-100 text-center border-t border-gray-400">
                                        <i class="fa-regular fa-credit-card text-9xl"></i>
                                        <p class="mt-2">
                                            Luego de hacer click en "Pagar ahora", se abrirá el checkout de Niubiz para completar tu compra de forma segura
                                        </p>
                                    </div>
                                </li>
                            @endif


                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <ul class="space-y-4 mb-4">
                        @foreach ($content as $item)
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-16 aspect-square" src="{{$item->options->image}}" alt="">
                                    <div class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                        <span class="text-white font-semibold">
                                            {{$item->qty}}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p>
                                        {{$item->name}}
                                    </p>
                                    @if ($item->options['features'])
                                        <p class="text-xs mt-2">
                                            @php
                                                $features = '';
                                                foreach ($item->options['features'] as $feature) {
                                                    $features = $features. ' | '. $feature;
                                                }
                                            @endphp
                                            {{substr($features,2)}}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex-shrink-0">
                                    <p>
                                        S/ {{number_format($item->price,2)}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between">
                        <p>
                            Subtotal
                        </p>

                        <p>
                            S/ {{number_format($subtotal,2)}}
                        </p>
                    </div>

                    @if ($couponInfo['code'])
                        
                        <div class="flex justify-between text-green-500">
                            <p>
                                Descuento
                            </p>

                            <p>
                                - S/ {{number_format($discount,2)}}
                            </p>
                        </div>
                    @endif

                    <hr class="my-3">

                    <div class="flex justify-between mb-4 text-lg font-semibold">
                        <p>
                            Total
                        </p>

                        <p>
                            S/ {{number_format($total,2)}}
                        </p>
                    </div>

                    @if ($configuration['couponStatus'] == 1)
                        
                        @if ($couponInfo['code'])
                            <div class="flex justify-between mb-4 text-lg font-semibold">
                                <p>
                                    Cupón: 
                                </p>
                        
                                <div class="flex items-center space-x-3">
                                    <p class="uppercase">
                                        {{$couponInfo['code']}}
                                    </p>
                                    <a href="/checkout">
                                        <i class="fa-solid fa-x text-red-500 hover:text-red-700"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            @livewire('coupons.coupon-check', ['showError' => $showError])
                        @endif
                    @endif



                    <div>
                        <div x-show="pago == 1">
                            <button onclick="confirmBuy()" class="btn btn-blue w-full">
                                Finalizar Compra
                            </button>
                        </div>

                        @if ($configuration['paymentMethod'] == 2)
                            <div x-cloak x-show="pago == 2">
                                <button onclick="VisanetCheckout.open()" class="btn btn-blue w-full">
                                    Finalizar Compra
                                </button>
                            </div>
                        @endif
                        
                        

                    </div>

                    @if (session('niubiz'))
                        @php
                            $response = session('niubiz')['response'];
                            $purchaseNumber = session('niubiz')['purchaseNumber'];
                        @endphp
                        @isset($response['data'])
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mt-8" role="alert">
                            <p class="mb-4">
                                {{$response['data']['ACTION_DESCRIPTION']}}
                            </p>
                            <p>
                                <b>Número de pedido:</b>
                                {{$purchaseNumber}}
                            </p>
                            <p>
                                <b>Fecha y hora del pedido</b>
                                {{
                                    now()->createFromFormat('ymdHis',$response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')
                                }}
                            </p>

                            @isset($response['data']['CARD'])
                                
                                <p>
                                    <b>Tarjeta:</b>
                                    {{$response['data']['CARD']}} ({{$response['data']['BRAND']}})
                                </p>
                            @endisset

                            </div>
                        @endisset
                    @endif
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('checkout.buy',$couponInfo['code'])}}" method="POST" id="buy-form" class="hidden">
        @csrf
    </form>

    @push('js')
        <script type="text/javascript" src="{{config('services.niubiz.url_js')}}" >
        </script>

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', function(){

                let purchasenumber = Math.floor(Math.random() * 1000000000);
                let amount = {{$total}}
                let code = "{{$couponInfo['code']}}"
                let discount = {{$discount}}

                VisanetCheckout.configure({
                sessiontoken: '{{$session_token}}',
                channel:'web',
                merchantid:"{{config('services.niubiz.merchant_id')}}",
                purchasenumber: purchasenumber,
                amount: amount,
                expirationminutes:'20',
                timeouturl:'about:blank',
                merchantlogo:'img/comercio.png',
                formbuttoncolor:'#000000',
                action:"{{route('checkout.paid')}}?amount="+amount+"&purchaseNumber="+purchasenumber+"&coupondiscount="+discount+"&couponcode="+code,
                complete: function(params) {
                alert(JSON.stringify(params));
                }
                });
            });

            function confirmBuy() {
                
                document.getElementById('buy-form').submit();
            }
            
        </script>
    @endpush
</x-app-layout>