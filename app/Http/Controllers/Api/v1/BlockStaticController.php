<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\BlockStaticReference;
use Illuminate\Http\Request;

class BlockStaticController extends Controller
{
  public function list($afdelling_id) {
      $block_static = BlockStaticReference::where('afdelling_id', $afdelling_id)->get();
      if ($block_static) {
        $data = [] ;
        foreach ($block_static as $key => $value) {
            $data [] = [
                'block_id' => $value['block_id'],
                'block_code' => block($value['block_id']),
                'planting_year' => $value['planting_year'],
                'total_coverage' => (float) $value['total_coverage'],
                'population_coverage' => (float) $value['population_coverage'],
                'population_perblock' => (int) $value['population_perblock'],
            ];
        }
        return res(true, 200, 'Daftar aktivitas area', $data);
      } else {
        return res(false, 404, 'Aktivitas area tidak tersedia');
      }

  }
}
