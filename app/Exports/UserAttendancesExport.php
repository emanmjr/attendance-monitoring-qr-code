<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\EmployeeAttendance;
use Carbon\Carbon;

class UserAttendancesExport implements FromCollection, WithHeadings
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $newCollections = collect([]);
        $attendances = EmployeeAttendance::select('created_at', 'time_in', 'time_out')->where('user_id', $this->userId)->get();
        foreach($attendances as $key => $value){
            $value->created_at = Carbon::parse($value->created_at)->format('Y-d-m');
            $value->time_in = Carbon::parse($value->time_in)->format('g:i A');
            $value->time_out = Carbon::parse($value->time_out)->format('g:i A');
            $newCollections->push($value);
        }

        return $newCollections;
    }

    public function headings() : array
    {
        return ["Date", "Time In", "Time Out"];
    }   
}
