<?php

namespace App\Http\Services;

use Throwable;
use App\Models\User;
use App\DataTable\UserDataTable;
use Illuminate\Support\Facades\DB;

class userService {
    private $UserDataTable;

    public function __construct(UserDataTable $UserDataTable) {
        $this->UserDataTable = $UserDataTable;
    }

    public function getUsers() {
        $allUser = User::latest()->get();
        return $allUser;
    }

    public function storeUser($request) {
        try {
            DB::beginTransaction();
            $createUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            DB::commit();
            return $createUser;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updateUser($request, $user) {
        try {
            DB::beginTransaction();
            $updateUser = $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            DB::commit();
            return $updateUser;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }
}
