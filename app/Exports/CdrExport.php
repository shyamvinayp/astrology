<?php

namespace App\Exports;

use App\Cdr;
use App\CallerIdGroup;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Prophecy\Call\Call;
use Maatwebsite\Excel\Concerns\FromCollection;

class CdrExport implements FromCollection, WithHeadings
{
    protected $id;

    function construct($id) {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $limit = 200;
        $data = Cdr::query()
                ->select("start_stamp", "camp_name", "agent_name", "agent_id", "callerid", "destination_number", "duration", "sip_cause_code", "sip_hangup_disposition")
                ->where('start_stamp', '>=', date('Y-m-d')." 00:00:00")
                ->where('start_stamp', '<=', date('Y-m-d')." 23:59:59")
                ->orderBy('start_stamp', 'DESC')
                //->limit($limit)
                ->get();

        return $data;
    }

    public function headings(): array
    {
        return ["Start Date", "Campaign Name", "Agent Name", "Agent ID", "Caller ID", "Scam Phone", "Duration", "SIP Cause", "Hangup Reason"];
    }

}
