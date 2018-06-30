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


function setUsername($first_name, $last_name)
{
    return strtolower(substr($first_name, 0, 1)).strtolower($last_name);
}

function getFullName($first_name, $last_name)
{
    return $first_name .' ' .$last_name;
}