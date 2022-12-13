<?php

namespace App\Http\Livewire\Admin\Patient;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Patients extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $patient;
    public $patientIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $patientsQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getPatientsQueryProperty()
    {
        return Patient::search($this->search);
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function validateData()
    {
        $validData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ])->validate();
        return $validData;
    }

    public function createPatient()
    {
        $validatedData = $this->validateData();
        Patient::create($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Patient added successfully!']);
    }

    public function show(Patient $patient)
    {
        return view('admin.patient.show', compact('patient'));
    }
 
    public function edit(Patient $patient)
    {
        $this->showEditModal = true;
        $this->patient = $patient;
        $this->state = $patient->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updatePatient()
    {
        $validatedData = $this->validateData();
        $this->patient->update($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Patient updated successfully!']);
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
        $patients = Patient::all();
        return view('livewire.admin.patient.patients', [
            'patients' => $patients,
        ]);
    }

    public function index()
    {
        return view('admin.patient.index');
    }
}
