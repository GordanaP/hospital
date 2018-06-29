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

/**
 * Create the full name.
 *
 * @param string $first_name
 * @param string $last_name
 * @return  string
 */
function getFullName($first_name, $last_name)
{
    return $first_name .' ' .$last_name;
}
