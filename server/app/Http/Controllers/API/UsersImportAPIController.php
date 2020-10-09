<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\File;
use App\Http\Resources\UserCollection;
use App\User;

class UsersImportAPIController extends Controller
{
    public function index()
    {

        $users = User::where('id','>', 100884)->orderby('id','desc')->paginate(10);

        return new UserCollection($users);
    }


    public function storeUser(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $uploadFile = file::create(['name' => $fileName]);

        $file = $request->file('file')->store('import');

        $import = new UsersImport($uploadFile);
        $import->import($file);


        $countError = $import->countError;


        // $import = new UsersImport;
        // $import->import();

        if ($import->failures()->isNotEmpty()) {
            $data = [
                'count_errors' => $countError,
                'errors' => $import->failures()
            ];
            return response()->json($data, $statusCode = 422, $headers =[]);
        }

        $data  = [
            'message' => 'import finished' ,
            // 'number_missed_records' =>$countError
        ];
        return response()->json($data, $statusCode = 201, $headers = []);
    }


}
