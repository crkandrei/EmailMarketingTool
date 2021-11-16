<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerAddRequest;
use App\Http\Requests\CustomerEditRequest;
use App\Models\Customer;
use App\Http\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display the view of the customer.
     *
     * @return Response
     */
    public function index()
    {
        if(request()->ajax()){

            return datatables()->of(Customer::where('user_id', Auth::user()->id)->get())
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit text-black btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }else{

            return view('data.customer');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerAddRequest $request
     */
    public function store(CustomerAddRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }
        $customer = new Customer([
            "first_name"    => $request['form_add_first_name'],
            "last_name"     => $request['form_add_last_name'],
            "email"         => $request['form_add_email'],
            "gender"        => $request['form_add_gender'] ?? null,
            "user_id"        => Auth::user()->id,
            "birthday"        => $request['form_add_birthday'] ?? null,
        ]);

        $customer->save();

        Utils::OutputResponse(200, "Customer was added successfully");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CustomerEditRequest $request
     * @return void
     */
    public function update(CustomerEditRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        Customer::whereId($request['form_edit_id'])->update([
            "first_name"    => $request['form_edit_first_name'],
            "last_name"     => $request['form_edit_last_name'],
            "email"         => $request['form_edit_email'],
            "gender"        => $request['form_edit_gender'] ?? null,
            "birthday"        => $request['form_edit_birthday'] ?? null,
        ]);


        Utils::OutputResponse(200, "Customer was edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        Customer::whereId(intval($request['form_delete_id']))->delete();

        Utils::OutputResponse(200, 'Customer was successfully deleted.');
    }
}
