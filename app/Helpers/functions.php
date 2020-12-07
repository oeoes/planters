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

    function fme() {
      $fm = auth()->guard('foreman')->user();
      return $fm;
    }

    function sfme() {
      $sfme = auth()->guard('subforeman')->user();
      return $sfme;
    }

    function subforeman($id) {
      $sfm = Subforeman::find($id);
      return $sfm;
    }

    function jobtype($jobtypeid) {
      switch ($jobtypeid) {
        case 1: return 'Spraying'; break;
        case 2: return 'Fertilizer'; break;
        case 3: return 'Manual circle'; break;
        case 4: return 'Manual pruning'; break;
        case 5: return 'Manual gawangan'; break;
        case 6: return 'Pest control'; break;
        case 7: return 'Harvesting'; break;
      }
    }

    function block($blockid) {
      $block = Block::find($blockid);
      return $block->code;
    }

    function model($jobtypeid) {
      switch ($jobtypeid) {
        case 1: return 'App\Models\Maintain\SprayingType'; break;
        case 2: return 'App\Models\Maintain\FertilizerType'; break;
        case 3: return 'App\Models\Maintain\CircleType'; break;
        case 4: return 'App\Models\Maintain\PruningType'; break;
        case 5: return 'App\Models\Maintain\GawanganType'; break;
        case 6: return 'App\Models\Maintain\PestControl'; break;
        case 7: return 'App\Models\Harvesting\HarvestingType'; break;
      }
    }

    function fill($jobtypeid) {
      switch ($jobtypeid) {
        case 1: return 'App\Models\Maintain\FillSpraying'; break;
        case 2: return 'App\Models\Maintain\FillFertilizer'; break;
        case 3: return 'App\Models\Maintain\FillCircle'; break;
        case 4: return 'App\Models\Maintain\FillPruning'; break;
        case 5: return 'App\Models\Maintain\FillGawangan'; break;
        case 6: return 'App\Models\Maintain\FillPcontrols'; break;
        case 7: return 'App\Models\Harvesting\FillHarvesting'; break;
      }
    }

    function fill_id($jobtypeid) {
      switch ($jobtypeid) {
        case 1: return 'spraying_id'; break;
        case 2: return 'fertilizer_id'; break;
        case 3: return 'circle_id'; break;
        case 4: return 'pruning_id'; break;
        case 5: return 'gawangan_id'; break;
        case 6: return 'pcontrol_id'; break;
        case 7: return 'harvest_id'; break;
      }
    }