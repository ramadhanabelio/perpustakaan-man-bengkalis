<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MemberExport implements FromCollection, WithHeadings
{
    protected $class;

    public function __construct($class = null)
    {
        $this->class = $class;
    }

    public function collection()
    {
        $query = Member::with('user');

        if ($this->class) {
            $query->where('class', 'LIKE', $this->class . '%');
        }

        return $query->get()->map(function ($member) {
            return [
                'nama' => $member->user->name,
                'email' => $member->user->email,
                'phone' => $member->user->phone,
                'nisn' => $member->nisn,
                'class' => $member->class,
                'gender' => $member->gender,
                'address' => $member->address,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'No HP',
            'NISN',
            'Kelas',
            'Jenis Kelamin',
            'Alamat'
        ];
    }
}
