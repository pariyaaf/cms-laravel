<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\View\View;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //:View
    {
        $payments = Payment::with(['course','user'])->wherePayment(1)->latest()->paginate(20);
        return View('Admin.payments.index', compact('payments'));
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
        $payment = Payment::find($id);
        $payment->update(['payment'=>1]);
        // event()
        alert()->success('عملیات مورد نظر با موفقیت انجام شد','تایید شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        $payment->delete();
        alert()->success('عملیات مورد نظر با موفقیت انجام شد','حذف شد');
        return back();
    }

    public function unsuccessful() : View
    {
       $payments = Payment::with('user')->where('payment',0)->latest()->paginate(20);
       return view('Admin.payments.unsuccessful', compact('payments'));
   }
}
