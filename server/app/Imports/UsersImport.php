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
use  Illuminate\Support\Facades\Log;
use App\File;

class UsersImport implements
    ToCollection,
    WithValidation,
    WithHeadingRow,
    SkipsOnFailure,
    SkipsOnError,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsFailures,
    SkipsErrors, RegistersEventListeners;

    public $countError;
    public $uploadFile;

    public function __construct($uploadFile)
    {
          $this->uploadFile = $uploadFile;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // if ($row['uid'] == null) continue;
            try {
                $user = User::create([
                    'first_name' => $row['first_name'],
                    'second_name' => $row['second_name'],
                    'family_name' => $row['family_name'],
                    'uuid' => $row['uid'],
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                $this->countError++ ;
            }
        }
        if($this->countError != null){
            $file = file::whereId($this->uploadFile->id)->first();
            $file->update(['num_neglected' => $file->num_neglected + $this->countError ]);
            $total = user::count();
            Log::info("total " . $total ." /count " . $this->countError . " /uplode num neglected " . $file->num_neglected);
        }
    }

    public function rules(): array
    {
        return [
            '*.uuid' => ['unique:uuid,uuid']
        ];
    }

    public function chunkSize(): int
        {
            return 1000;
        }

    public static function afterImport(AfterImport $event)
    {
        Log::info('This is some useful information. ddd44445555');
        // Log::info($this->countError);

    }


}
