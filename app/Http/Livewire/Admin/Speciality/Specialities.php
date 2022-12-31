<?php

namespace App\Http\Livewire\Admin\Speciality;

use App\Models\Speciality;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Specialities extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $speciality;
    public $specialityIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $specialitiesQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
        // dd($this->currentUrl);
    }

    public function getSpecialitiesQueryProperty()
    {
        return Speciality::search($this->search);
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function createSpeciality()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'code' => 'required',
        ])->validate();

        Speciality::create($validatedData);
        // session()->flash('message', 'Speciality added successfully!');
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Speciality added successfully!']);
    }

    public function edit(Speciality $speciality)
    {
        $this->showEditModal = true;
        // dd($speciality->toArray());
        $this->speciality = $speciality;
        $this->state = $speciality->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateSpeciality()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'code' => 'required',
        ])->validate();

        $this->speciality->update($validatedData);
        // session()->flash('message', 'Speciality added successfully!');
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Speciality updated successfully!']);
    }

    public function confirmSpecialityRemoval($specialityId)
    {
        $this->specialityIdBeingRemoved = $specialityId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteSpeciality()
    {
        $speciality = Speciality::findOrFail($this->specialityIdBeingRemoved);
        $speciality->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Speciality deleted successfully!']);
    }

    public function changeStatus($specialityId, $status)
    {
        // dd($status);
        $updateStatus = $status == 0 ? 1 : 0;
        Speciality::find($specialityId)->update(['status' => $updateStatus]);
    }

    public function getSpecialitiesProperty()
    {
        $specialitiesQuery = Speciality::search($this->search);
        // return $this->specialitiesQuery->paginate();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Speciality::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Speciality::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Speciality::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmSpecialitiesRemoval($specialityId)
    {
        if (!empty($this->deleteId)) {
            $this->specialityIdBeingRemoved = $specialityId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Speciality::find($this->deleteId)->delete();
        } else {
            Speciality::whereIn('id', $this->checked)->delete();
        }
        // $this->dispatchBrowserEvent('hideModal');
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected specialities deleted successfully!']);
    }


    public function render()
    {
        $specialities = Speciality::all();
        return view('livewire.admin.speciality.specialities', [
            'specialities' => $specialities,
        ])
            ->extends('layouts.admin.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.speciality.index');
    // }
}
