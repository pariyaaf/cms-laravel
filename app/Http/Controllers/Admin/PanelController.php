<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian; // Make sure to include the appropriate library for Jalali date conversion

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
        $month = 12;
        $paymentsSuccess = Payment::spannignPayment($month, 1);
        $paymentsFaill = Payment::spannignPayment($month, 0);

        // dd($paymentsSuccess);
        $values['success'] = $this->checkCount($paymentsSuccess->pluck('published'), $month);
        $values['unsuccess'] = $this->checkCount($paymentsFaill->pluck('published'), $month);

        $labels = $this->getLastMonth($month);
        return view('Admin.panel', compact('labels', 'values'));
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

    private function getLastMonth($month) {
        for($i=0; $i < $month ; $i++) {
            $labels[] = jdate(Carbon::now()->subMonths($i))->format('%B');
        }
        return array_reverse($labels);
    }
    
    private function checkCount($count, $month) {
        for($i=0; $i < $month ; $i++) {
            $new[$i] = empty($count[$i]) ? 0 : $count[$i];
        }
        return array_reverse($new);
    }
}
