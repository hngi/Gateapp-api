<?php


namespace App\Http\Controllers\EstateBills\Residents;


use App\ResidentBill;

class PendingBills
{
    public function __invoke()
    {
        $user = auth()->user();

        $bills = ResidentBill::where('users_id', $user->id)->where('status', false)->with('billInfo')->get();

        return response([
            'count' => $bills->count(),
            'data' => $bills,
        ]);
    }
}
