<?php

namespace App\Models;

use App\Http\Traits\MailSenderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes, MailSenderTrait;

    public $timestamps = false;

    protected $fillable = array('first_name', 'last_name','email','user_id','gender','birthday');

    /**
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function initiateSendMail(Template $template): void
    {
        $template->parseTemplate($this->first_name, $this->last_name, $this->email);

        $this->sendEmail($template->subject, $template->message, $this->email);
    }

}
