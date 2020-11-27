<?php

function res($status, $code, $message, $data = null) {
  return response()->json([
    'status'   => $status,
    'code'     => $code,
    'message'  => $message,
    'data'     => $data
  ], $code);
}

    /*
    ------------------------------------
        THIS CODE BELOW IS FOR SUPPORTING FUNCTION
    ------------------------------------
    */

    function foreman() {
        return auth()->guard('foreman')->user();
    }