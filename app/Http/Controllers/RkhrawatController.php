<?php

namespace App\Http\Controllers;

use App\Models\Rawatmanual;
use Illuminate\Http\Request;
use App\Models\Rkh;
use App\Models\Rkhrawatpupuk;
use App\Models\Rawatpupuk;
use App\Models\Rawatspraying;
use App\Models\Rkhrawatmanual;
use App\Models\Rkhrawatspraying;
use Database\Seeders\RkhRawatManualTableSeeder;

class RkhrawatController extends Controller
{
    public function index() {
        
    }

    public function test() {
        $rkhId = 1;
        $rkh = Rkh::find($rkhId);
        $rkhCoverage = $rkh->luas;

        // Pupuk
        $pupukTeralokasi = Rkhrawatpupuk::where('rkh_id', $rkhId)->first()->jml_pupuk;
            $pupukTerpakai = Rawatpupuk::where('rkh_id', $rkhId)->sum('jml_terpakai');
            $ketuntasanPekerjaanPupuk = (int) $pupukTerpakai / $pupukTeralokasi * 100;
            $coveragePupuk = Rawatpupuk::where('rkh_id', $rkhId)->sum('luas') / $rkhCoverage * 100;
        // dd($ketuntasanPekerjaanPupuk, $coveragePupuk);

        // Spraying
        $sprayingTeralokasi = Rkhrawatspraying::where('rkh_id', $rkhId)->first()->jml_spray;
            $sprayingTerpakai  = Rawatspraying::where('rkh_id', $rkhId)->sum('jml_terpakai');
            $ketuntasanPekerjaanSpraying = (int) $sprayingTerpakai / $sprayingTeralokasi * 100;
            $coverageSpraying = Rawatspraying::where('rkh_id', $rkhId)->sum('luas') / $rkhCoverage * 100;
        // dd($ketuntasanPekerjaanSpraying, $coverageSpraying);

        // Manual circle
        $circleDilokasi = Rkhrawatmanual::where('rkh_id', $rkhId)->first()->circle;
            $circleDikerjakan = Rawatmanual::where('rkh_id', $rkhId)->sum('circle');
            $ketuntasanPekerjaanCircle = (int) $circleDikerjakan / $circleDilokasi * 100;
            $circleCoverage = Rawatmanual::where('rkh_id', $rkhId)->sum('luas_circle') / $rkhCoverage * 100;
        // dd($ketuntasanPekerjaanCircle, $circleCoverage);

        // Manual Pruning
        $pruningDilokasi = Rkhrawatmanual::where('rkh_id', $rkhId)->first()->pruning;
            $pruningDikerjakan = Rawatmanual::where('rkh_id', $rkhId)->sum('pruning');
            $ketuntasanPekerjaanPruning = (int) $pruningDikerjakan / $pruningDilokasi * 100;
            $pruningCoverage = Rawatmanual::where('rkh_id', $rkhId)->sum('luas_pruning') / $rkhCoverage * 100;
        // dd($ketuntasanPekerjaanPruning, $pruningCoverage);

        // Manual Gawangan
        $gawanganDilokasi = Rkhrawatmanual::where('rkh_id', $rkhId)->first()->gawangan;
            $gawanganDikerjakan = Rawatmanual::where('rkh_id', $rkhId)->sum('gawangan');
            $ketuntasanPekerjaanGawangan = $gawanganDikerjakan / $gawanganDilokasi * 100;
        // dd($ketuntasanPekerjaanGawangan);

        $rkhs = [1, 2];
        $rkhsLength = count($rkhs);

        $totalTuntasPupuk = 0;
        $totalCoveragePupuk = 0;
        $totalTuntasSpraying = 0;
        $totalCoverageSpraying = 0;
        $totalTuntasCircle = 0;
        $totalCoverageCircle = 0;
        $totalTuntasPruning = 0;
        $totalCoveragePruning = 0;
        $totalTuntasGawangan = 0;

        foreach ($rkhs as $rkh) {
            $rkhCoverage = Rkh::find($rkh)->luas;

            $pupukTeralokasi = Rkhrawatpupuk::where('rkh_id', $rkh)->first()->jml_pupuk;
            $pupukTerpakai = Rawatpupuk::where('rkh_id', $rkh)->sum('jml_terpakai');
            $ketuntasanPekerjaanPupuk = (int) $pupukTerpakai / $pupukTeralokasi * 100;
            $coveragePupuk = Rawatpupuk::where('rkh_id', $rkh)->sum('luas') / $rkhCoverage * 100; //66 + 44
            $totalTuntasPupuk += $ketuntasanPekerjaanPupuk;
            $totalCoveragePupuk += $coveragePupuk;

            $sprayingTeralokasi = Rkhrawatspraying::where('rkh_id', $rkh)->first()->jml_spray;
            $sprayingTerpakai  = Rawatspraying::where('rkh_id', $rkh)->sum('jml_terpakai');
            $ketuntasanPekerjaanSpraying = (int) $sprayingTerpakai / $sprayingTeralokasi * 100;
            $coverageSpraying = Rawatspraying::where('rkh_id', $rkh)->sum('luas') / $rkhCoverage * 100;
            $totalTuntasSpraying += $ketuntasanPekerjaanSpraying;
            $totalCoverageSpraying += $coverageSpraying;

            $circleDilokasi = Rkhrawatmanual::where('rkh_id', $rkh)->first()->circle;
            $circleDikerjakan = Rawatmanual::where('rkh_id', $rkh)->sum('circle');
            $ketuntasanPekerjaanCircle = (int) $circleDikerjakan / $circleDilokasi * 100;
            $circleCoverage = Rawatmanual::where('rkh_id', $rkh)->sum('luas_circle') / $rkhCoverage * 100;
            $totalTuntasCircle += $ketuntasanPekerjaanCircle;
            $totalCoverageCircle += $circleCoverage;

            $pruningDilokasi = Rkhrawatmanual::where('rkh_id', $rkh)->first()->pruning;
            $pruningDikerjakan = Rawatmanual::where('rkh_id', $rkh)->sum('pruning');
            $ketuntasanPekerjaanPruning = (int) $pruningDikerjakan / $pruningDilokasi * 100;
            $pruningCoverage = Rawatmanual::where('rkh_id', $rkh)->sum('luas_pruning') / $rkhCoverage * 100;
            $totalTuntasPruning += $ketuntasanPekerjaanPruning;
            $totalCoveragePruning += $pruningCoverage;

            $gawanganDilokasi = Rkhrawatmanual::where('rkh_id', $rkh)->first()->gawangan;
            $gawanganDikerjakan = Rawatmanual::where('rkh_id', $rkh)->sum('gawangan');
            $ketuntasanPekerjaanGawangan = $gawanganDikerjakan / $gawanganDilokasi * 100;
            $totalTuntasGawangan += $ketuntasanPekerjaanGawangan;

        }

        // Pupuk
        $totalTuntasPupuk = $totalTuntasPupuk / $rkhsLength;
        $totalCoveragePupuk = $totalCoveragePupuk / $rkhsLength;

        // Spray
        $totalTuntasSpraying = $totalTuntasSpraying / $rkhsLength;
        $totalCoverageSpraying = $totalCoveragePupuk / $rkhsLength;

        // Circle
        $totalTuntasCircle = $totalTuntasCircle / $rkhsLength;
        $totalCoverageCircle = $totalCoverageCircle / $rkhsLength;

        // Pruning
        $totalTuntasPruning = $totalTuntasPruning / $rkhsLength;
        $totalCoveragePruning = $totalCoveragePruning / $rkhsLength;

        // Gawangan
        $totalTuntasGawangan = $totalTuntasGawangan / $rkhsLength;


        dd(
            $totalTuntasPupuk, 
            $totalCoveragePupuk, 
            $totalTuntasSpraying, 
            $totalCoverageSpraying,
            $totalTuntasCircle,
            $totalCoverageCircle,
            $totalTuntasPruning,
            $totalCoveragePruning,
            $totalTuntasGawangan
        );

        

        

    }
}
