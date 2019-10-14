<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\CsvExport;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;
use App\items;
class CsvFile extends Controller
{
    public function index()
    {
    	return view('pages.CsvFile');
    }
    public function exportCsv($value='')
    {
    	return Excel::download(new CsvExport, 'sample.csv');
    }
    public function importCsv(Request $request)
    {
    	Excel::import(new CsvImport, $request->file('file'));
    	return back();
    }
}
