<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $params = [
            'nasabah' => Nasabah::all(),
            'transaksi' => Transaksi::paginate(10),
        ];
        return view('transaksi.index')->with($params);
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'account_id' => 'required',
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => implode('<br>', $validate->errors()->all())
            ]);
        }

        try {
            $transaksi = new Transaksi;
            $transaksi->account_id = $request->account_id;
            $transaksi->description = $request->description;
            $transaksi->status = $request->type;
            $transaksi->amount = $request->amount;
            $transaksi->transaction_date = Carbon::parse($request->date ?? Carbon::now());
            $transaksi->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        return view('transaksi.edit', ['transaksi' => $transaksi]);
    }

    public function poin()
    {
        $nasabah = Nasabah::get();
        return view('poin.index', ['nasabah' => $nasabah]);
    }

    public function laporan(Request $request)
    {
        $start =  Carbon::parse($request->dateStart ?? Carbon::now()->subYears(1))->startOfDay();
        $end = Carbon::parse($request->dateEnd ?? Carbon::now())->endOfDay();
        $filter['account_id'] =  $request->account_id == null ? null : $request->account_id;

        if ($filter['account_id']) {
            $transaksi = Transaksi::where($filter)->whereBetween('transaction_date', [$start->toDateTimeString(), $end->toDateTimeString()])->get();
        } else {
            $transaksi = Transaksi::whereBetween('transaction_date', [$start->toDateTimeString(), $end->toDateTimeString()])->get();
        }

        $params = [
            'nasabah' => Nasabah::get(),
            'transaksi' => $transaksi,
            'start' => $start->format('m/d/Y'),
            'end' => $end->format('m/d/Y'),
        ];
        return view('laporan.index', $params);
    }
}
