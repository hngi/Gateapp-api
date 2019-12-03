<?php


namespace App\Http\Controllers\EstateBills\Residents;


use App\EstateBills;
use App\ResidentBill;
use Illuminate\Http\Request;

class Subscribe
{
    /**
     * Subscribe a user to a bill
     * @param EstateBills $estate_bills
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(EstateBills $estate_bills)
    {
        // Implicit route model binding is used here
        $data = ResidentBill::query()
            ->create([
                'users_id' => auth()->user()->id,
                'estate_bills_id' => $estate_bills->id,
                'usage_duration' => null,
                'amount' => $estate_bills->base_amount,
                'status' => false,
            ]);

        return response()->json([
            'message' => 'Bill subscription successful.',
            'data' => $data
        ]);
    }

    /**
     * Returns all bills a user has subscribed to
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribed()
    {
        $user = auth()->user();

        $bills = ResidentBill::where('users_id', $user->id)->with('billInfo')->get();

        return response()->json([
            'count' => $bills->count(),
            'data' => $bills,
        ]);
    }
}
