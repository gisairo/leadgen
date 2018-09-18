<?php

namespace App\Exports;

use App\Message;
use Maatwebsite\Excel\Concerns\FromCollection;

class MessagesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Message::all();
    }
}
