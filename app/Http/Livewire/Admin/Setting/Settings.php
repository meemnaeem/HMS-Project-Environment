<?php
namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Settings extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $setting;
    public $settingIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $settingsQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getSettingsQueryProperty()
    {
        return Setting::search($this->search);
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
            // 'patient_id' => 'required',
            // 'user_id' => 'required',
            // 'date' => 'required',
            // 'rating' => 'required',
            // 'description' => 'required',
            'status' => 'required',
        ])->validate();
        return $validData;
    }

    public function createSetting()
    {
        $validatedData = $this->validateData();
        Setting::create($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Setting added successfully!']);
    }

    public function edit(Setting $setting)
    {
        $this->showEditModal = true;
        $this->setting = $setting;
        $this->state = $setting->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateSetting()
    {
        $validatedData = $this->validateData();
        $this->setting->update($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Setting updated successfully!']);
    }

    public function confirmSettingRemoval($settingId)
    {
        $this->settingIdBeingRemoved = $settingId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteSetting()
    {
        $setting = Setting::findOrFail($this->settingIdBeingRemoved);
        $setting->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Setting deleted successfully!']);
    }

    public function changeStatus($settingId, $status)
    {
        $updateStatus = $status == 0 ? 1 : 0;
        Setting::where('id', $settingId)->update(['status' => $updateStatus]);
    }

    public function getSettingsProperty()
    {
        $settingsQuery = Setting::search($this->search);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Setting::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Setting::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Setting::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmSettingsRemoval($settingId)
    {
        if (!empty($this->deleteId)) {
            $this->settingIdBeingRemoved = $settingId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Setting::find($this->deleteId)->delete();
        } else {
            Setting::whereIn('id', $this->checked)->delete();
        }
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected settings deleted successfully!']);
    }

    public function render()
    {
        $settings = Setting::all();
        return view('livewire.admin.setting.settings', [
            'settings' => $settings,
        ])
        ->extends('layouts.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.setting.index');
    // }
}
