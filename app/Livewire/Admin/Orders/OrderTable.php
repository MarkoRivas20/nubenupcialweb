<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public $openModalOrder = false;
    public $order = [];
    public $coupon = [];
    public $client = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nº orden", "id")
                ->sortable(),
            Column::make("F. orden", "created_at")
                ->format(function($value){
                    return $value->format('d/m/Y');
                })
                ->sortable(),
            Column::make("total", "total")
                ->format(function($value){
                    return "S/ ".number_format($value,2);
                })
                ->sortable(),
            Column::make("Método de pago", "payment_method")
                ->format(function($value){
                    switch ($value) {
                        case 1:
                            return 'Yape o Plin';
                            break;
                        case 2:
                            return 'Crédito o Débito';
                            break;
                        default:
                            # code...
                            break;
                    };
                })
                ->sortable(),
            Column::make("Cantidad", "content")
                ->format(function($value){
                    return count($value);
                })
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function($value){
                    return $value->name;
                })
                ->sortable(),

            Column::make("Acciones")
                ->label(function($row){
                    return view('admin.orders.actions',['order' => $row]);
                }),
        ];
    }

    public function filters(): array{
        return [
            SelectFilter::make('status')->options([
                '' => 'Todos',
                1 => 'Pendiente',
                2 => 'Proceso',
                3 => 'Completado',
                4 => 'Cancelado',
                5 => 'Devuelto',

            ])->filter(function($query, $value){
                $query->where('status',$value);
            })
        ];
    }

    public function markAsPending(Order $order){

        $order->status = OrderStatus::Pending;
        $order->save();
    }

    public function markAsProcessing(Order $order){

        $order->status = OrderStatus::Processing;
        $order->save();
    }

    public function markAsCompleted(Order $order){

        $order->status = OrderStatus::Completed;
        $order->save();
    }

    public function cancelOrder(Order $order){
        $order->status = OrderStatus::Cancelled;
        $order->save();
    }

    public function markAsRefunded(Order $order){

        $order->status = OrderStatus::Refunded;
        $order->save();
    }

    public function showOrder(Order $order){
        
        $this->order = [];
        $this->client = [
            "name" => $order->user->name . " " . $order->user->last_name,
            "email" => $order->user->email,
            "phone" => $order->user->phone,
            "document" => $order->user->document_type->name . " - " . $order->user->document,
        ];

        $this->coupon = [
            'promo_code' => $order->promo_code,
            'discount' => $order->discount,
        ];

        foreach ($order->content as $key => $item) {
            $this->order[] = [
                'name' =>$item['name'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'options' => $item['options']
            ];
        }
        
        $this->openModalOrder = true;
    }

    public function customView():string {
        return 'admin.orders.modal';
    }
}
