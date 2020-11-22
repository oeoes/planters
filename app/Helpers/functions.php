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

  function str_farm($farm_id) {
      $farm = App\Models\Farm::find($farm_id);
      return $farm->name;
  }

  function str_afdelling($afdelling_id) {
      $afdelling = App\Models\Afdelling::find($afdelling_id);
      return $afdelling->name;
  }

  function str_block($block_id) {
      $block = App\Models\Block::find($block_id);
      return $block->name;
  }

  function str_employee($employee_id) {
      $employee = App\Models\Employee::find($employee_id);
      return $employee->name;
  }

  function str_foreman1($foreman1_id) {
      $foreman1 = App\Models\Foreman1::find($foreman1_id);
      return $foreman1->name;
  }

  function str_foreman2($foreman2_id) {
      $foreman2 = App\Models\Foreman2::find($foreman2_id);
      return $foreman2->name;
  }

  function str_fruit($fruit_id) {
      $fruit = App\Models\Harvesting\Fruitlists::find($fruit_id);
      return $fruit->name;
  }
