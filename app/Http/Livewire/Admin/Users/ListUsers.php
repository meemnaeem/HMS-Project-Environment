<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $user;
    public $userIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $usersQuery = '';


    public function mount()
    {
        // $this->currentUrl = Route::current()->getName();
        // dd($this->currentUrl);
    }

    public function getUsersQueryProperty()
    {
        return User::search($this->search);
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function createUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        // session()->flash('message', 'User added successfully!');
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'User added successfully!']);
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        // dd($user->toArray());
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);
        // session()->flash('message', 'User added successfully!');
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);
    }

    public function changeStatus($userId, $status)
    {
        // dd($status);
        $updateStatus = $status == 0 ? 1 : 0;
        User::find($userId)->update(['status' => $updateStatus]);
    }

    public function getUsersProperty()
    {
        $usersQuery = User::search($this->search);
        // return $this->usersQuery->paginate();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = User::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == User::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = User::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmUsersRemoval($userId)
    {
        if (!empty($this->deleteId)) {
            $this->userIdBeingRemoved = $userId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            User::find($this->deleteId)->delete();
        } else {
            User::whereIn('id', $this->checked)->delete();
        }
        // $this->dispatchBrowserEvent('hideModal');
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected users deleted successfully!']);
    }


    public function render()
    {
        // $users = User::search($this->search)->latest()->paginate();
        return view('livewire.admin.users.list-users', [
            'users' => User::all(),
        ])
        ->extends('layouts.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.users.index');
    // }
}
