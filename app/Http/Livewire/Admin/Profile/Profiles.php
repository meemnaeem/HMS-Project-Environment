<?php

namespace App\Http\Livewire\Admin\Profile;


use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class Profiles extends Component
{
    use WithFileUploads;

    public $userarr = [];
    public $user;
    public $newImage;
    public $oldImage;

    // multistep wizarform
    public $currentStep = 1;
    protected $listeners = ['page-refresh' => '$refresh'];


    public function mount()
    {
        $this->user = Auth::user();
    }

    public function edit($id)
    {
        $this->userarr = User::findOrFail($id)->toArray();
        $this->oldImage = $this->userarr['image'];
        $this->dispatchBrowserEvent('show-user-modal', [
            'id' => $id,
        ]);
    }

    // multistep wizarform
    public function firstStepSubmit()
    {
        Validator::make($this->userarr, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user)
            ],
            'description' => 'required',
        ])->validate();

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        Validator::make($this->userarr, [
            'phone' => 'required',
            'file' => 'sometimes|required|image|mimes:png,jpg,gif|max:2048',
            'age' => 'required',
            'address_1' => 'required',
        ])->validate();

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     */
    public function submitForm()
    {
        $image = $this->userarr['image'];
        if ($this->newImage) {

            $extension = $this->newImage->getClientOriginalExtension();
            $filename = $this->userarr['id'] . '-' . date('Y-m-d-Hms', time()) . '.' . $extension;
            $image = $this->newImage->storeAs('users', $filename);
            if ($this->oldImage) {
                Storage::delete($this->oldImage);
            }
        }
        $user = User::findOrFail($this->userarr['id'])->update([
            'first_name' => $this->userarr['first_name'],
            'last_name' => $this->userarr['last_name'],
            'email' => $this->userarr['email'],
            'description' => $this->userarr['description'],
            'phone' => $this->userarr['phone'],
            'age' => $this->userarr['age'],
            'address_1' => $this->userarr['address_1'],
            'image' => $image,
        ]);
        $this->emit('hide-modal-swal', [
            'title' => 'User updated successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetForm();
        $this->currentStep = 1;
        $this->emit('page-refresh');
    }

    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function resetForm()
    {
        $this->userarr = [];
    }

    // End of multistep wizardform

    public function changePassword(UpdatesUserPasswords $updater)
    {
        $updater->update(
            auth()->user(),
            $attributes = Arr::only($this->userarr, ['current_password', 'password', 'password_confirmation'])
        );

        collect($attributes)->map(fn ($value, $key) => $this->userarr[$key] = '');
        $this->emit('updated', [
            'title' => 'Password updated successfully!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user-profile.user-profile')
            ->extends('layouts.admin.app')
            ->section('content');
    }
}
