<?php

namespace App\Http\Controllers;

use App\Http\Utils;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Template;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Send Mail to users.
     *
     * @return void
     */
    public function sendMassMail(Request $request)
    {
        $customerIds = Group::find($request['group_id'])->customer_ids;
        $template = Template::find($request['template_id']);

        $customers = Customer::wherein('id',$customerIds)->get();

        foreach ($customers as $customer){

            $customer->initiateSendMail($template);
        }

        Utils::OutputResponse(200, 'Mass Email sent.');
    }
    /**
     * Send Mail to users.
     *
     * @return void
     */
    public function scheduleMail(Request $request)
    {

        $date = $request['date'];

        ////////// SCHEDULE //////////////////////////////////////////

        //$schedule->call($this->sendMassMail($request))->date();
    }


}
