<?php

namespace App\Http\Controllers;

use App\Http\Traits\MailSenderTrait;
use App\Http\Utils;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Task;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    use MailSenderTrait;
    /**
     * Send Mail to users.
     *
     * @return void
     */
    public function sendMassMail(Request $request)
    {
        $this->consumeTaskMessage($request['group_id'], $request['template_id']);

        Utils::OutputResponse(200, 'Mass Email sent.');
    }

    /**
     * Send Mail to users.
     *
     * @return void
     */
    public function scheduleMail(Request $request)
    {
        $task = New Task([
                "group_id"       => $request['group_id'],
                "template_id"    => $request['template_id'],
                "user_id"        => Auth::user()->id,
                "date"           => $request['date'],
            ]
        );

        $task->save();

        Utils::OutputResponse(200, 'Task was scheduled sucessfully.');

    }

}
