<?php

namespace App\Http\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Component;

class Doctors extends Component
{
    public $doctors;
    public $doctor_id;
    public $about_doctor;
    public $charge;
    public $experience;
    public $user_id;
    public $specialist_id;
    public $created_by_id;
    public $updated_by_id;
    public $updateMode = false;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->doctors = Doctor::all();
        return view('livewire.admin.doctor.doctors');
    }

        public function index()
        {
            $doctors = Doctor::all();

            return view('admin.doctor.index', compact('doctors'));
        }

  
    /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    private function resetInputFields()
    {
        $this->doctor_id = '';
        $this->about_doctor = '';
        $this->charge = '';
        $this->experience = '';
        $this->user_id = '';
        $this->specialist_id = '';
        $this->created_by_id = '';
        $this->updated_by_id = '';
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
    'about_doctor' => 'required',
    'charge' => 'required',
    'experience' => 'required',
    'user_id' => 'required',
    'specialist_id' => 'required',
    'created_by_id' => 'required',
    'updated_by_id' => 'required',
        ]);
  
        Doctor::create($validatedDate);
  
        session()->flash('message', 'Doctor Created Successfully.');
  
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $this->doctor_id = $id;
        $this->about_doctor = $doctor->about_doctor;
        $this->charge = $doctor->charge;
        $this->experience = $doctor->experience;
        $this->user_id = $doctor->user_id;
        $this->specialist_id = $doctor->specialist_id;
        $this->created_by_id = $doctor->created_by_id;
        $this->updated_by_id = $doctor->updated_by_id;
        $this->updateMode = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
    'about_doctor' => 'required',
    'charge' => 'required',
    'experience' => 'required',
    'user_id' => 'required',
    'specialist_id' => 'required',
    'created_by_id' => 'required',
    'updated_by_id' => 'required',
        ]);
  
        $doctor = Doctor::find($this->doctor_id);
        $doctor->update([
        'doctor_id' => $this->doctor_id,
        'about_doctor' => $this->about_doctor,
        'charge' => $this->charge,
        'experience' => $this->experience,
        'user_id' => $this->user_id,
        'specialist_id' => $this->specialist_id,
        'created_by_id' => $this->created_by_id,
        'updated_by_id' => $this->updated_by_id,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Doctor Updated Successfully.');
        $this->resetInputFields();
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Doctor::find($id)->delete();
        session()->flash('message', 'Doctor Deleted Successfully.');
    }
}
