<?php
namespace App\Http\Livewire\Admin\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class Profiles extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $showDetailModal = false;
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
        $this->currentUrl = Route::current()->getName();
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
        $this->showDetailModal = false;
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateUserBasic()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'address_1' => 'required',
            'description' => 'required|string|min:100|max:1000',
        ])->validate();
        $this->user->update($validatedData);
        $this->state = [];


        // To refresh the page after submitting:
        return redirect(request()->header('Referer'));

        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Profile basic information updated successfully!']);
    }

    public function editPersonal(User $user)
    {
        $this->showDetailModal = true;
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateUserPersonal()
    {
        $validatedData = Validator::make($this->state, [
            'dob' => 'required',
            'phone' => 'required',
        ])->validate();
        $this->user->update($validatedData);
        $this->state = [];

        // To refresh the page after submitting:
        return redirect(request()->header('Referer'));

        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Profile details updated successfully!']);
    }

    public function changePassword(UpdatesUserPasswords $updater)
    {
        $updater->update(
            auth()->user(),
            $attributes = Arr::only($this->state, ['current_password', 'password', 'password_confirmation'])
        );

        collect($attributes)->map(fn ($value, $key) => $this->state[$key] = '');
        $this->dispatchBrowserEvent('updated', ['message' => 'Password changed successfully!']);
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
        $users = User::search($this->search)->latest()->paginate();
        return view('livewire.admin.profile.profiles', [
            'users' => $users,
        ])
        ->extends('layouts.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.profile.index');
    // }
}
