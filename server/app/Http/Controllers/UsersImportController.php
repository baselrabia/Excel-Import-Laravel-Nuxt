<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;

class UsersImportController extends Controller
{
    public function show()
    {
        return view('users.import');
    }

    public function store(Request $request)
    {
        $file = $request->file('file')->store('import');

        $import = new UsersImport();
        $import->import($file);


        $countError = $import->countError;

        // $import = new UsersImport;
        // $import->import();

        if ($import->failures()->isNotEmpty()) {

            return back()->withFailures($import->failures());
        }


        return back()->withStatus('import finished.and count of missed records = '. $countError);
    }
}
