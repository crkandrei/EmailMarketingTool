<?php

namespace App;

class Utils
{
    // From POST to output JSON
    public static function OutputResponse($status=9998, $message = '', $object = null): void
    {
        // Output
        $response['Value'] = $status;
        $response['Message'] = $message;
        $response['Object'] = $object;

        echo json_encode($response);
    }


}
