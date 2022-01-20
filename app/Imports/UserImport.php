<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use DB;
use Hash;

class UserImport implements OnEachRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $data)
    {
        $rowIndex = $data->getIndex();
        $row      = $data->toArray();

        if ($rowIndex == 1) {
            return null;
        }

        $latest = User::find(DB::table('users')->max('id'));

        $user = User::firstOrNew(['email' =>  $row[4]]);

        $user->id = $latest->id+1;
        $user->name = $row[1];
        $user->last_name = $row[2];
        $user->password = Hash::make('MC123!');
        $user->dui = $row[3];
        $user->email = $row[4];
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }
}
