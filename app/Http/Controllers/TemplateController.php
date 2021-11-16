<?php

namespace App\Http\Controllers;

use App\Http\Utils;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TemplateAddRequest;
use App\Http\Requests\TemplateEditRequest;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){

            return datatables()->of(Template::where('user_id', Auth::user()->id)->get())
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

            return view('data.template');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TemplateAddRequest $request
     */
    public function store(TemplateAddRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        $template = new Template([
            "subject"    => $request['form_add_subject'],
            "message"     => $request['form_add_message']
        ]);

        $template->save();

        Utils::OutputResponse(200, "Template was added successfully");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param TemplateEditRequest $request
     * @return void
     */
    public function update(TemplateEditRequest $request)
    {
        if($request->messages())
        {
            Utils::OutputResponse(405, $request->messages());
        }

        Template::whereId($request['form_edit_id'])->update([
            "subject"    => $request['form_edit_subject'],
            "message"     => $request['form_edit_message']
        ]);


        Utils::OutputResponse(200, "Template was edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $request
     * @return void
     */
    public function destroy($request)
    {
        Template::whereId(intval($request['form_delete_id']))->delete();

        Utils::OutputResponse(200, 'Template was successfully deleted.');
    }
}
