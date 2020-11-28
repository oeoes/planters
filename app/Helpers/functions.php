<?php

use App\Models\Block;
use App\Models\Foreman;
use App\Models\Subforeman;

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

    function foreman($id) {
      $fm = Foreman::find($id);
        return $fm;
    }

    function subforeman($id) {
      $sfm = Subforeman::find($id);
      return $sfm;
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
      $block = Block::find($blockid);
      return $block->code;
    }