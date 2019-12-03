<?php


namespace App\Http\Controllers\EstateBills\Residents;


use App\ResidentBill;

class PaidBills
{
    public function __invoke()
    {
        $user = auth()->user();

        $bills = ResidentBill::where('users_id', $user->id)->where('status', true)->with('billInfo')->get();

        return response([
            'count' => $bills->count(),
            'data' => $bills,
        ]);
    }
}
