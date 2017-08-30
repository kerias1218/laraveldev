<?php

namespace App\Repositories;
use App\User;

class TaskRepository {

    public function forUser(User $user) {

        // dd($user);
        // select * from tasks where 1=1 order by create_at asc

        return $user->tasks()
            ->orderBy('created_at','asc')
            ->get();
    }
}