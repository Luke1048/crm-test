<?php

declare(strict_types=1);

namespace App\Http\Eloquent;

use App\Models\File;

class FileEloquent
{
    public function save(File $file): File
    {
        $file->save();

        return $file;
    }
}
