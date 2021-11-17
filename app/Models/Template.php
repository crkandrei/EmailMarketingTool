<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;
    public $parsedSubject, $parsedMessage;

    protected $fillable = array('name','subject', 'message', 'user_id');
    protected $allowedPlaceHolders = array('first_name','last_name','email');

    public function parseTemplate(string $first_name, string $last_name, string $email){

        $this->parsedSubject = $this->subject;
        $this->parsedMessage = $this->message;

        foreach( $this->allowedPlaceHolders as $placeHolder ){

            $this->parsedSubject = str_replace('#!#'.$placeHolder.'#!#', $$placeHolder, $this->parsedSubject);
            $this->parsedMessage = str_replace('#!#'.$placeHolder.'#!#', $$placeHolder, $this->parsedMessage);

        }
    }
}
