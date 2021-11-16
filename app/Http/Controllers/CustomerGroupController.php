<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupAddRequest;
use App\Http\Requests\GroupEditRequest;
use App\Http\Utils;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupUserController extends Controller
{
    /**
     * Display the view of the customer.
     *
     * @return Response
     */
    public function index()
    {
        if(request()->ajax()){

            return datatables()->of(Group::where('user_id', Auth::user()->id)->get())
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="add_users" id="'.$data->id.'" class="edit text-black btn btn-success btn-sm">Add users to group</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit text-black btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }else{

            return view('data.group');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupAddRequest $request
     */
    public function store(GroupAddRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        $group = new Group([
            "name"    => $request['form_add_name'],
            "user_id"        => Auth::user()->id
        ]);

        $group->save();

        Utils::OutputResponse(200, "Group was added successfully");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param GroupEditRequest $request
     * @return void
     */
    public function update(GroupEditRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        Group::whereId($request['form_edit_id'])->update([
            "name"    => $request['form_edit_name']
        ]);


        Utils::OutputResponse(200, "Group was edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        Group::whereId(intval($request['form_delete_id']))->delete();

        Utils::OutputResponse(200, 'Group was successfully deleted.');
    }
}
