<?php

namespace App\Http\Livewire\Admin\Patient;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Patients extends Component
{
    public $patientarr = [];
    public $userarr = [];
    public $showEditModal = false;
    public $user;
    public $uid;
    public $patient;
    public $validatedData;
    public $patientIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $patientsQuery = '';

    // multistep wizarform
    public $currentStep = 1;


    public function mount()
    {
    }

    public function addNew()
    {
        $this->patientarr = [];
        $this->userarr = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-patient-modal');
    }

    public function edit($id)
    {
        $this->showEditModal = true;

        $this->patientarr = Patient::find($id)->toArray();
        $this->userarr = User::find($this->patientarr['user_id'])->toArray();

        $this->dispatchBrowserEvent('show-patient-modal', [
            'id' => $id,
        ]);
    }

    // multistep wizarform
    public function firstStepSubmit()
    {
        if ($this->showEditModal) {
            $this->uid = $this->patientarr['user_id'];
        }
        Validator::make($this->userarr, [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->uid)
            ],
            'password' => 'sometimes|required',
        ])->validate();
        // } else {
        //     Validator::make($this->userarr, [
        //         'name' => 'required',
        //         'email' => 'required|email|unique:users',
        //         'password' => 'required|confirmed',
        //         'phone' => 'required',
        //         'image' => 'required',
        //     ])->validate();
        // }
        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        Validator::make($this->patientarr, [
            'name' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'age' => 'required',
            // 'symptoms' => 'required',
            'address_1' => 'required',
        ])->validate();

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     */
    public function submitForm()
    {
        if ($this->showEditModal) {
            $user = User::find($this->patientarr['user_id'])->update(
                [
                    'email' => $this->userarr['email'],
                ]
            );
            Patient::find($this->patientarr['id'])->update(
                [
                    'name' => $this->patientarr['name'],
                    'phone' => $this->patientarr['phone'],
                    'image' => $this->patientarr['image'],
                    'age' => $this->patientarr['age'],
                    // 'symptoms' => $this->patientarr['symptoms'],
                    'address_1' => $this->patientarr['address_1'],
                ]
            );
        } else {
            $user = User::create([
                'email' => $this->userarr['email'],
                'password' => Hash::make($this->userarr['password']),
            ]);
            Patient::create(
                [
                    'name' => $this->patientarr['name'],
                    'phone' => $this->patientarr['phone'],
                    'image' => $this->patientarr['image'],
                    'age' => $this->patientarr['age'],
                    // 'symptoms' => $this->patientarr['symptoms'],
                    'address_1' => $this->patientarr['address_1'],
                    'user_id' => $user->id,
                ]
            );
        }

        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Patient added successfully!']);
        $this->resetForm();
        $this->currentStep = 1;
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
        $this->patientarr = [];
        $this->userarr = [];
        $this->showEditModal = false;
    }

    // End of multistep wizardform


    public function getPatientsQueryProperty()
    {
        return Patient::search($this->search);
    }

    public function confirmPatientRemoval($patientId)
    {
        $this->patientIdBeingRemoved = $patientId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deletePatient()
    {
        $patient = Patient::findOrFail($this->patientIdBeingRemoved);
        $patient->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Patient deleted successfully!']);
    }

    public function changeStatus($patientId, $status)
    {
        $updateStatus = $status == 0 ? 1 : 0;
        Patient::find($patientId)->update(['status' => $updateStatus]);
    }

    public function getPatientsProperty()
    {
        $patientsQuery = Patient::search($this->search);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Patient::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Patient::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Patient::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmPatientsRemoval($patientId)
    {
        if (!empty($this->deleteId)) {
            $this->patientIdBeingRemoved = $patientId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Patient::find($this->deleteId)->delete();
        } else {
            Patient::whereIn('id', $this->checked)->delete();
        }
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected patients deleted successfully!']);
    }

    public function render()
    {
        // $patients = User::Role('patient')->paginate();
        $patients = Patient::all();
        return view('livewire.admin.patient.patients', [
            'patients' => $patients,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
