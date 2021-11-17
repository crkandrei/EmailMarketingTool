<?php

namespace App\Http\Traits;

use App\Models\Customer;
use App\Models\Group;
use App\Models\Template;

trait MailSenderTrait
{
    /**
        @throws EmailSendingException
     */
    function sendEmail(string $subject, string $body, string $email): void
    {
        error_log('Email sent subject: '.$subject);
        error_log('Email sent message: '.$body);
        error_log('Email sent to: '.$email);
    }

    public function consumeTaskMessage(int $group_id, int $template_id){

        $customerIds = Group::find($group_id)->customer_ids;
        $template = Template::find($template_id);

        $customers = Customer::wherein('id',$customerIds)->get();

        foreach ($customers as $customer){

            $customer->initiateSendMail($template);
        }

    }

}
