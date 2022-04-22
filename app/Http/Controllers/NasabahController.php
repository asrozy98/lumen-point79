<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();

        return view('nasabah.index', ['nasabah' => $nasabah]);
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => $validate->errors()->all()
            ]);
        }

        try {
            $nasabah = new Nasabah;
            $nasabah->name = $request->name;
            $nasabah->save();

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
}
