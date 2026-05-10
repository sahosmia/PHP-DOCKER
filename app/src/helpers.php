<?php

function show_error($field)
{
    if (isset($_SESSION['errors'][$field])) {
        $message = $_SESSION['errors'][$field];
        return "<p class='text-red-500 text-xs mt-1'>{$message}</p>";
    }
    return '';
}


function error_class($field)
{
    return isset($_SESSION['errors'][$field]) ? 'border-red-500' : 'border-gray-300';
}

function redirect($path, $params = [])
{
    $url = $path;

    if (!empty($params)) {
        $queryString = http_build_query($params);

        $separator = (strpos($path, '?') === false) ? '?' : '&';
        $url .= $separator . $queryString;
    }

    header("Location: " . $url);
    exit();
}


function show_status_message()
{
    $msg = '';
    $class = 'bg-blue-100 text-blue-700'; 

    if (isset($_GET['msg'])) {
        $msg = htmlspecialchars($_GET['msg']);
    } 
    elseif (isset($_GET['status'])) {
        $status = $_GET['status'];
        $messages = [
            'success' => ['msg' => 'Data saved successfully!', 'class' => 'bg-green-100 text-green-700'],
            'deleted' => ['msg' => 'Item has been removed!', 'class' => 'bg-red-100 text-red-700'],
            'updated' => ['msg' => 'Information updated!', 'class' => 'bg-blue-100 text-blue-700'],
            'error'   => ['msg' => 'Something went wrong!', 'class' => 'bg-yellow-100 text-yellow-700'],
        ];

        if (array_key_exists($status, $messages)) {
            $msg = $messages[$status]['msg'];
            $class = $messages[$status]['class'];
        }
    }

    return $msg ? "<div class='mb-4 p-3 rounded-md {$class}'>{$msg}</div>" : '';
}
