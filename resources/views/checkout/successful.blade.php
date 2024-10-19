<x-app-layout>
    <div class="max-w-3xl mx-auto pt-12">
        <img class="w-full" src="https://www.fanaticnationstore.com/wp-content/uploads/2022/10/gracias-por-tu-compra-copia2.-e1666978357364.png" alt="">
        @if (session('niubiz'))
            @php
                $response = session('niubiz')['response'];

            @endphp

            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 mt-8" role="alert">
                <p class="mb-4">
                    {{$response['dataMap']['ACTION_DESCRIPTION']}}
                </p>
                <p>
                    <b>Número de pedido:</b>
                    {{$response['order']['purchaseNumber']}}
                </p>
                <p>
                    <b>Fecha y hora de la compra:</b>
                    {{
                        now()->createFromFormat('ymdHis',$response['dataMap']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')
                    
                    }}
                </p>

                <p>
                    <b>Tarjeta:</b>
                    {{$response['dataMap']['CARD']}} ({{$response['dataMap']['BRAND']}})
                </p>

                <p>
                    <b>Importe:</b>
                    {{$response['order']['amount']}} {{$response['order']['currency']}}
                </p>
            </div>
        @endif
    </div>
</x-app-layout>