<?php

/**
 * Create the response message.
 *
 * @param  string  $message
 * @param  string  $type
 * @return array
 */
function message($message, $type="success")
{
    $response['message'] = $message;
    $response['type'] = $type;

    return $response;
}
