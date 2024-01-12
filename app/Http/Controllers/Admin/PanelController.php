<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth()->user());
        // auth()->loginUsingId(7);
        // Auth()->logout(7);

        return view('Admin.panel');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadImage() {
        $this->validate(request() , [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::new()->year;
        $imagePath = "/upload/images/{$year}/";

        
            $file = request()->file('upload');
            $fileName = $file->getClientOrginalName();

            if(file_exists(public_path($imagePath). $fileName)) {
                $fileName = Carbon::now()->timestamp.$fileName;
            }
  

            $file->move(public_path($imagePath), $fileName);
            $url = $imagePath . $filename;

            return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";


    }
}
