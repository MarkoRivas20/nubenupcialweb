<?php

namespace App\Exports;

use App\Models\Confirmation;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ConfirmationsExport implements FromView
{

    public function view(): View
    {
        return view('exports.confirmations', [
            'confirmations' => Confirmation::select("person_name", "person_phone", "person_confirmation","person_message","created_at")
            ->where('invitation_id', 1)
            ->get()
        ]);
    }
}