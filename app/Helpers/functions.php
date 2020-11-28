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

    function subforeman() {
      return auth()->guard('subforeman')->user();
    }

    function jobtype($jobtypeid) {
      switch ($jobtypeid) {
        case 1:
            return 'Spraying'; break;
        case 2: 
            return 'Fertilizer'; break;
        case 3:
            return 'Manual circle'; break;
        case 4:
            return 'Manual pruning'; break;
        case 5:
            return 'Manual gawangan'; break;
        case 6: 
            return 'Pest control'; break;
      }
    }

    function block($blockid) {
      $block = App\Models\Block::find($blockid);
      return $block->code;
    }