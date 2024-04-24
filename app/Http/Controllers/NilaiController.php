<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://localhost/sait-uts-api/perkuliahan-api.php');
        $data = $response->json()['data'];
        return view('nilai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:255',
            'nilai' => 'required|numeric'
        ]);

        $url = "http://localhost/sait-uts-api/perkuliahan-api.php";

        $response = Http::asForm()->post($url, [
            'nim' => $validatedData['nim'],
            'kode_mk' => $validatedData['kode_mk'],
            'nilai' => $validatedData['nilai']
        ]);

        if ($response->successful()) {
            return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambah');
        } else {
            return back()->withErrors(['msg' => 'Gagal menambah nilai'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nim, string $kode_mk)
    {
        $url = "http://localhost/sait-uts-api/perkuliahan-api.php?nim={$nim}";
        $response = Http::get($url);

        if ($response->successful()) {
            $result = $response->json();
            $filteredData = collect($result['data'])->firstWhere('kode_mk', $kode_mk);

            if ($filteredData) {
                return view('nilai.edit', compact('filteredData'));
            } else {
                return back()->with('error', 'No data found for the specified Kode MK.');
            }
        } else {
            return back()->with('error', 'Failed to retrieve data from the API.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim, string $kode_mk) 
    {
        $nilai = $request->input('nilai');
        $url = "http://localhost/sait-uts-api/perkuliahan-api.php?nim={$nim}&kode_mk={$kode_mk}";

        $response = Http::asForm()->post($url, ['nilai' => $nilai]);

        if ($response->successful()) {
            return redirect()->route('nilai.index')->with('success', 'Data berhasil diupdate');
        } else {
            return back()->withErrors('Gagal mengupdate data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim, $kode_mk)
    {
        $url = "http://localhost/sait-uts-api/perkuliahan-api.php?nim={$nim}&kode_mk={$kode_mk}";
        $response = Http::delete($url);

        if ($response->successful()) {
            return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus');
        } else {
            return back()->withErrors('Gagal menghapus nilai');
        }
    }
}
