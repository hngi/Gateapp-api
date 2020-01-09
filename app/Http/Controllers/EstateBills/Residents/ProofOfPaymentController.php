<?php

namespace App\Http\Controllers\EstateBills\Residents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Home;
use App\ProofOfPayment;
use App\ResidentBill;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Resources\Resident;

class ProofOfPaymentController extends Controller
{
    //Submit proof of payment 
    public function submit(Request $request, $id, ImageController $image){
        $user = Auth::user();
        $user_id = $user->id;  
        $estate_id = Home::where('user_id', $user_id)->value('estate_id');
        $this->validateRequest($request);

       

        DB::beginTransaction();
        $proofOfPayement = new ProofOfPayment;
        $name = $request->input('name');
        $teller_no = $request->input('teller_no');

        //Confirm Bill belongs to user 
        $bill_id = ResidentBill::where('users_id',  $user_id)
                            ->where('estate_bills_id', $id )->value('id');
       

        try{
            $proofOfPayement->name = $name;
            $proofOfPayement->teller_no = $teller_no;
            $proofOfPayement->user_id = $user_id;
            $proofOfPayement->resident_bills_id = $bill_id;
            $proofOfPayement->estate_id = $estate_id;
            $proofOfPayement->status = 0;

            if (!$bill_id){
                $msg['status']  = false;
                $msg['status_code'] = 404;
                $msg['message'] = 'Invalid Bill selected, please try again!';
            }else{
                if($request->hasFile('image')) {
                    $data = $this->upload($request, $image);
                    if($data['status_code'] !=  200) {
                        return response()->json($data, $data['status_code']);
                    }
                    $proofOfPayement->image = $data['image'];
                }else {
                    $data = null;
                    $proofOfPayement->image = 'gateguard-logo.png';
                }
                
    
                $proofOfPayement->save();
                $msg['status']  = true;
                $msg['status_code'] = 201;
                $msg['message'] = 'Proof of payment submitted succesfully!';
                $msg['proof_of_payment'] = $proofOfPayement;
                $msg['image_info'] = $data;
    
                DB::commit();

            }
            

            return response()->json($msg, $msg['status_code']);


        }catch(\Exception $e){
            DB::rollBack();

            $msg['status']  = false;
            $msg['message'] = "Error: Proof of payment not submitted, please try again!";
            $msg['hint'] = $e->getMessage();
            $msg['status_code'] = 501;
            return response()->json($msg, $msg['status_code']);

        }

    }
    public function validateRequest(Request $request){
        $rules = [
           
            'image' => 'required|image',
            'name' => 'required|string',
        ];

        $this->validate($request, $rules);

    }

    public function upload($request, $image, $table=null) {
        $user = Auth::user();

        $this->validate($request, [
         'image' => "image|max:4000",
        ]);
        //Image Engine
        $res = $image->imageUpload($request, $table);
        return $res;
    }


}
