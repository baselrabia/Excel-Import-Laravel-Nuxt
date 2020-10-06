<?php

namespace App\Imports;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UsersImport implements
    ToCollection,
    WithValidation,
    WithHeadingRow,
    SkipsOnFailure,
    SkipsOnError
{
    use Importable, SkipsFailures,SkipsErrors;

    public $countError ;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // if ($row['uid'] == null) continue;
            try {
                $user = User::create([
                    'first_name' => $row['first_name'],
                    'second_name' => $row['second_name'],
                    'family_name' => $row['family_name'],
                    'uid' => $row['uid'],
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                $this->countError++ ;
            }
        }

    }

    public function rules(): array
    {
        return [
            '*.uid' => ['unique:users,uid']
        ];
    }



}
