<?php

namespace App\Http\Services;

use App\Models\User;
use App\DataTable\UserDataTable;

class userService {
    private $UserDataTable;

    public function __construct(UserDataTable $UserDataTable) {
        $this->UserDataTable = $UserDataTable;
    }

    public function getUsers() {
        $data = User::latest()->get();
        $getUserList = $this->UserDataTable->userTable($data);
        return $getUserList;
    }
}
