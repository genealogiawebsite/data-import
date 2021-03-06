<?php

namespace LaravelEnso\DataImport\Http\Controllers\Import;

use Illuminate\Routing\Controller;
use LaravelEnso\DataImport\Models\DataImport;

class Cancel extends Controller
{
    public function __invoke(DataImport $import)
    {
        $import->cancel();

        return ['message' => __('The import was cancelled successfully')];
    }
}
