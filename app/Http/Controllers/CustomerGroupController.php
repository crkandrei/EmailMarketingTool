<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerGroupAddRequest;
use App\Http\Utils;
use App\Models\CustomerGroup;
use App\Models\Group;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    /**
     * Display the view of the customer.
     *
     * @return Response
     */
    public function index()
    {
        return datatables()->of(CustomerGroup::where('group_id', request()->group_id)->with('customer')->get())
            ->addIndexColumn()
            ->addColumn('customer_name', function($data){
                return $data->customer->first_name.' '.$data->customer->last_name;
            })
            ->addColumn('action', function($data){

                return '<button type="button" name="delete" id="'.$data->id.'" class="delete-customers-to-group btn btn-danger btn-sm">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerGroupAddRequest $request
     */
    public function store(CustomerGroupAddRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        $customer_to_group = new CustomerGroup([
            "customer_id"    => $request['form_add_customer_id'],
            "group_id"        => $request['form_add_group_id']
        ]);

        $customer_to_group->save();

        Utils::OutputResponse(200, "Customer added to group successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        CustomerGroup::whereId(intval($request['form_customer_delete_id']))->delete();

        Utils::OutputResponse(200, 'Customer removed from the group.');
    }
}
