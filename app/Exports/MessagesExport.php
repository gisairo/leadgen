<?php

namespace App\Exports;

use App\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MessagesExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct($user, $headings){
    	$this->user = $user;
    	$this->headings = $headings;
    }

    public function query(){
    	return Message::query()->where('user_id',$this->user, $this->headings);
    }

    public function headings() : array
    {
    	return $this->headings;
    }
}
