<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function getUsers()
    {
        $userQuery = User::query();

        $users = $userQuery->latest();
        return datatables()->of($users)
            ->addIndexColumn()
            ->editColumn('name', fn($user)=>str()->title($user->name))
            ->addColumn('action', function ($user) {
                $buttons = '<button onclick="updateData(\''.$user->id.'\')" class="btn btn-warning btn-sm">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    
                    <button onclick="deleteData(\''.$user->id.'\')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                    ';

                return $buttons;
            })
            ->editColumn('role', fn($user)=>str()->title($user->role))
            ->editColumn('avatar', function($user){
                $avatar = $user->avatar;

                $path = asset('/uploads/images/' . $avatar);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $img = '<img data-path="'.$path.'" src="'.$base64.'" class="img-thumbnail img-avatar" width="50px">';
                return $img;
            })
            ->rawColumns(['action', 'role', 'avatar'])
            ->make(true);
    }
}
