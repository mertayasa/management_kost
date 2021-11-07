<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index(Request $request){
        // dd($this->getKamarIncome());
        $dashboard_data = $this->getDashboardData();
        return view('dashboard.index', compact('dashboard_data'));
    }

    public function getKamarIncome(Request $request)
    {
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $raw_kost = Kost::with(['pemasukan', 'pengeluaran'])->get();
        $kost_income = [];
        $kost_expense = [];

        foreach($raw_kost as $kost){
            array_push($kost_income, $kost->pemasukan()->whereYear('tgl_pemasukan', $year)->where('status_validasi', 1)->sum('jumlah'));
        }

        foreach($raw_kost as $kost){
            array_push($kost_expense, $kost->pengeluaran()->whereYear('tgl_pengeluaran', $year)->sum('jumlah'));
        }

        return response(['code' => 1, 'pemasukan' => $kost_income, 'pengeluaran' => $kost_expense, 'label' => Kost::pluck('nama')->toArray()]);
    }

    public function getKamarChart()
    {
        $kost = Kost::get();
        $kamar_kosong = [];
        $kamar_isi = [];
        foreach($kost as $kos){
            $kos->kamar_kosong = getKamarKosong($kos);
            $kos->kamar_isi = $kos->jumlah_kamar - $kos->kamar_kosong;
            array_push($kamar_kosong, $kos->kamar_kosong);
            array_push($kamar_isi, $kos->kamar_isi);
        }

        return response(['code' => 1, 'kosong' => $kamar_kosong, 'isi' => $kamar_isi, 'label' => $kost->pluck('nama')->toArray()]);
    }

    private function getDashboardData(){
        $pemasukan = Pemasukan::where('status_validasi', 1);
        $pengeluaran = Pengeluaran::query();
        
        if(userRole() == 'owner'){
            $total_pemasukan = $pemasukan->sum('jumlah');
            $total_pengeluaran = $pengeluaran->sum('jumlah');
        }else if(userRole() == 'manager'){
            $total_pemasukan = $pemasukan->whereMonth('tgl_pemasukan', Carbon::now()->format('m'))->sum('jumlah');
            $total_pengeluaran = $pengeluaran->whereMonth('tgl_pengeluaran', Carbon::now()->format('m'))->sum('jumlah');
        }else{
            $total_pemasukan = $pemasukan->whereDate('tgl_pemasukan', Carbon::today())->sum('jumlah');
            $total_pengeluaran = $pengeluaran->whereDate('tgl_pengeluaran', Carbon::today())->sum('jumlah');
        }

        $total_profit = $total_pemasukan - $total_pengeluaran;
        $tahun_pemasukan = Pemasukan::selectRaw('DISTINCT year(tgl_pemasukan) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $kost = Kost::get();
        $kamar_kosong = 0;

        foreach($kost as $kos){
            $kamar_kosong = $kamar_kosong + getKamarKosong($kos);
        }

        $kamar_isi = $kost->sum('jumlah_kamar') - $kamar_kosong;
 
        return [
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_profit' => $total_profit,
            'tahun_pemasukan' => $tahun_pemasukan,
            'kamar_kosong' => $kamar_kosong,
            'kamar_isi' => $kamar_isi,
        ];
    }

    public function getInOutChart(Request $request, $req_profit = null){
        // $year = 2021;
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = [ 'January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $pemasukan = Pemasukan::selectRaw('year(tgl_pemasukan) year, monthname(tgl_pemasukan) month, sum(jumlah) data')
                ->whereYear('tgl_pemasukan', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $pengeluaran = Pengeluaran::selectRaw('year(tgl_pengeluaran) year, monthname(tgl_pengeluaran) month, sum(jumlah) data')
                ->whereYear('tgl_pengeluaran', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $data_pengeluaran = [];
        $data_pemasukan = [];

        foreach($months as $key => $month){
            $key = array_search($month, array_column($pemasukan, 'month'));
            $data = $key === false ? 0 : $pemasukan[$key]['data'];
            array_push($data_pemasukan, $data);
        }

        foreach($months as $key => $month){
            $key = array_search($month, array_column($pengeluaran, 'month'));
            $data = $key === false ? 0 : $pengeluaran[$key]['data'];
            array_push($data_pengeluaran, $data);
        }

        $profit = [];

        if($req_profit != null){
            foreach ($data_pemasukan as $key => $value) {
                if(array_key_exists($key, $data_pengeluaran) && array_key_exists($key, $data_pemasukan))
                    $profit[$key] = $data_pemasukan[$key] - $data_pengeluaran[$key];
            }
        }

        // dd($profit);

        return response(['code' => 1, 'pemasukan' => $data_pemasukan, 'pengeluaran' => $data_pengeluaran, 'profit' => $profit]);
    }

    public function getChartYearly(Request $request){
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;

        $total_pemasukan = Pemasukan::whereYear('tgl_pemasukan', $year)->where('status_validasi', 1)->sum('jumlah');
        $total_pengeluaran = Pengeluaran::whereYear('tgl_pengeluaran', $year)->sum('jumlah');

        return response(['code' => 1, 'pemasukan' => $total_pemasukan, 'pengeluaran' => $total_pengeluaran]);
    }
}
