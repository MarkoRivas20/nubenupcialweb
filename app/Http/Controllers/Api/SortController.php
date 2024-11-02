<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use App\Models\InvitationSection;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function covers(Request $request){

        $sorts = $request->get('sorts');

        $order = 1;
        foreach ($sorts as $sort) {
            $cover = Cover::find($sort);
            $cover->order = $order;
            $cover->save();
            $order++;
        }
    }

    public function sections(Request $request){

        $sorts = $request->get('sorts');

        $order = 1;
        foreach ($sorts as $sort) {
            $section = InvitationSection::find($sort);
            $section->order = $order;
            $section->save();
            $order++;
        }
    }
}
