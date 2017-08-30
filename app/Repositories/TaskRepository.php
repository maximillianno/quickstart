<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 29.08.2017
 * Time: 12:02
 */
namespace App\Repositories;


use App\User;

class TaskRepository
{
    /**
     * Получить все задачи заданного пользователя.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }

}