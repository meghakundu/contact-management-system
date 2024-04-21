<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Contact::join('categories','contacts.category_id','categories.id')
                      ->join('users','contacts.user_id','users.id')->where("contacts.user_id", auth()->id())->get(["contacts.id","contacts.name as contact","contacts.email", "contacts.phone", "contacts.address","categories.name as category","contacts.created_at","users.name"]);
    }
    public function headings(): array
    {
        return [
            'id','name','email','phone', 'address','category','created_at','added_by'
        ];
    }
}
