<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Repositories\HomeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use QRCode;
use Auth; 
use Response;

class HomeController extends AppBaseController
{
    /** @var  HomeRepository */
    private $homeRepository;

    public function __construct(HomeRepository $homeRepo)
    {
        $this->homeRepository = $homeRepo;
    }

    /**
     * Display a listing of the Home.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $homes = $this->homeRepository->all();

        return view('homes.index')
            ->with('homes', $homes);
    }

    /**
     * Show the form for creating a new Home.
     *
     * @return Response
     */
    public function create()
    {
        return view('homes.create');
    }

    /**
     * Store a newly created Home in storage.
     *
     * @param CreateHomeRequest $request
     *
     * @return Response
     */
    public function store(CreateHomeRequest $request)
    {
        $input = $request->all();

 /*       $home = $this->homeRepository->create($input);*/

        //generate QRcode
        //save QR code image in our folder in this site
        $file = 'qrcodes/'.$home->id.'.png';

    

       $newQrcode = QRCode::text("message")
        ->setSize(4)
        ->setMargin(2)
        ->setOutfile($file)
        ->png();

        if($newQrcode) {

        $input['qrcode_path'] =  $file;

        //save data to the database

       $home = $this->homeRepository->create($input);
       Flash::success('QRcode saved successfully.');

        }else{
             Flash::error('QRcode was not saved.');

        }

       

        return redirect(route('homes.index'));
    }

    /**
     * Display the specified Home.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $home = $this->homeRepository->find($id);

        if (empty($home)) {
            Flash::error('Home not found');

            return redirect(route('homes.index'));
        }

        return view('homes.show')->with('home', $home);
    }

    /**
     * Show the form for editing the specified Home.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $home = $this->homeRepository->find($id);

        if (empty($home)) {
            Flash::error('Home not found');

            return redirect(route('homes.index'));
        }

        return view('homes.edit')->with('home', $home);
    }

    /**
     * Update the specified Home in storage.
     *
     * @param int $id
     * @param UpdateHomeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHomeRequest $request)
    {
        $home = $this->homeRepository->find($id);

        if (empty($home)) {
            Flash::error('Home not found');

            return redirect(route('homes.index'));
        }

        $home = $this->homeRepository->update($request->all(), $id);

        Flash::success('Home updated successfully.');

        return redirect(route('homes.index'));
    }

    /**
     * Remove the specified Home from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $home = $this->homeRepository->find($id);

        if (empty($home)) {
            Flash::error('Home not found');

            return redirect(route('homes.index'));
        }

        $this->homeRepository->delete($id);

        Flash::success('Home deleted successfully.');

        return redirect(route('homes.index'));
    }
}
