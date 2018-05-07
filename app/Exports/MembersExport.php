<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection; // Use a Laravel Collection to populate the export.
use Maatwebsite\Excel\Concerns\Exportable; // Add download/store abilities right on the export class itself.
use Maatwebsite\Excel\Concerns\FromQuery; // Use an Eloquent query to populate the export.
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Facades\Log;

use App\Member;

class MembersExport implements FromQuery, WithHeadings, WithMapping  {
    use Exportable;

    private $fieldName = '';
    private $fieldCode = '';
    private $searchString = '';

    public function setSearchParams($fieldName, $fieldCode, $searchString) {
        $this->fieldName = $fieldName;
        $this->fieldCode = $fieldCode;
        $this->searchString = $searchString;
        return $this;
    }


    public function headings(): array
    {
        return [
            // Add head here.
            __('messages.memberlist.id'),
            __('messages.memberlist.first_name'),
            __('messages.memberlist.middle_name'),
            __('messages.memberlist.last_name'),
            __('messages.memberlist.kor_name'),
            __('messages.memberlist.dob'),
            __('messages.memberlist.gender'),
            __('messages.memberlist.email'),
            __('messages.memberlist.tel_home'),
            __('messages.memberlist.tel_office'),
            __('messages.memberlist.tel_cell'),
            __('messages.memberlist.household'),
            __('messages.memberlist.address'),
            __('messages.memberlist.postal_code'),
            __('messages.memberlist.city'),
            __('messages.memberlist.province'),
            __('messages.memberlist.country'),
            __('messages.memberlist.status'),
            __('messages.memberlist.level'),
            __('messages.memberlist.duty'),
            __('messages.memberlist.register_date'),
            __('messages.memberlist.baptism_date')

        ];
    }

    // Define the field to export
    // TODO: make it dynamic?
    public function map($member): array {
        return [
            $member->id,
            $member->first_name,
            $member->middle_name,
            $member->last_name,
            $member->kor_name,
            $member->dob,
            $member->gender,
            $member->email,
            $member->tel_home,
            $member->tel_office,
            $member->tel_cell,
            $member->primary,
            $member->address,
            $member->postal_code,
            $member->codeByCityId->txt,
            $member->codeByProvinceId->txt,
            $member->codeByCountryId->txt,
            $member->codeByStatusId->txt,
            $member->codeByLevelId->txt,
            $member->codeByDutyId->txt,
            $member->register_at,
            $member->baptism_at
            // need to add department and position
        ];
    }

    public function query() {
        if ($this->fieldName == '' && $this->searchString == '') {
            return Member::query();
        } else if ($this->searchString != '') {
            return Member::query()->where(DB::raw("CONCAT(first_name, ' ', last_name, ' ', kor_name)"), 
                    'like', '%' . $this->searchString . '%');
        } else {
            return Member::query()->where($this->fieldName, $this->fieldCode);
        }
    }
}