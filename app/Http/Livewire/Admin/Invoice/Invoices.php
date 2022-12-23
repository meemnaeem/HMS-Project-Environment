<?php

namespace App\Http\Livewire\Admin\Invoice;


use App\Models\User;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class Invoices extends Component
{
    public $invoicearr = [];
    public $userarr = [];
    public $showEditModal = false;
    public $user;
    public $uid;
    public $invoice;
    public $validatedData;
    public $invoiceIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $invoicesQuery = '';

    // multistep wizarform
    public $currentStep = 1;


    public function mount($invoice)
    {
        $this->invoice = Invoice::all()->where('id', $invoice)->first();
        // dd($this->invoice);
    }

    public function addNew()
    {
        $this->invoicearr = [];
        $this->userarr = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-invoice-modal');
    }

    public function edit($id)
    {
        $this->showEditModal = true;

        $this->invoicearr = Invoice::find($id)->toArray();
        $this->userarr = User::find($this->invoicearr['user_id'])->toArray();

        $this->dispatchBrowserEvent('show-invoice-modal', [
            'id' => $id,
        ]);
    }

    // multistep wizarform
    public function firstStepSubmit()
    {
        if ($this->showEditModal) {
            $this->uid = $this->invoicearr['user_id'];
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
        Validator::make($this->invoicearr, [
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
            $user = User::find($this->invoicearr['user_id'])->update(
                [
                    'email' => $this->userarr['email'],
                ]
            );
            Invoice::find($this->invoicearr['id'])->update(
                [
                    'name' => $this->invoicearr['name'],
                    'phone' => $this->invoicearr['phone'],
                    'image' => $this->invoicearr['image'],
                    'age' => $this->invoicearr['age'],
                    // 'symptoms' => $this->invoicearr['symptoms'],
                    'address_1' => $this->invoicearr['address_1'],
                ]
            );
        } else {
            $user = User::create([
                'email' => $this->userarr['email'],
                'password' => Hash::make($this->userarr['password']),
            ]);
            Invoice::create(
                [
                    'name' => $this->invoicearr['name'],
                    'phone' => $this->invoicearr['phone'],
                    'image' => $this->invoicearr['image'],
                    'age' => $this->invoicearr['age'],
                    // 'symptoms' => $this->invoicearr['symptoms'],
                    'address_1' => $this->invoicearr['address_1'],
                    'user_id' => $user->id,
                ]
            );
        }

        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Invoice added successfully!']);
        $this->resetForm();
        $this->currentStep = 1;
        return redirect(request()->header('Referer'));
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
        $this->invoicearr = [];
        $this->userarr = [];
        $this->showEditModal = false;
    }

    // End of multistep wizardform


    public function getInvoicesQueryProperty()
    {
        return Invoice::search($this->search);
    }

    public function confirmInvoiceRemoval($invoiceId)
    {
        $this->invoiceIdBeingRemoved = $invoiceId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteInvoice()
    {
        $invoice = Invoice::findOrFail($this->invoiceIdBeingRemoved);
        $invoice->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Invoice deleted successfully!']);
    }

    public function changeStatus($invoiceId, $status)
    {
        $updateStatus = $status == 0 ? 1 : 0;
        Invoice::find($invoiceId)->update(['status' => $updateStatus]);
    }

    public function getInvoicesProperty()
    {
        $invoicesQuery = Invoice::search($this->search);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Invoice::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Invoice::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Invoice::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmInvoicesRemoval($invoiceId)
    {
        if (!empty($this->deleteId)) {
            $this->invoiceIdBeingRemoved = $invoiceId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Invoice::find($this->deleteId)->delete();
        } else {
            Invoice::whereIn('id', $this->checked)->delete();
        }
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected invoices deleted successfully!']);
    }

    public function changePassword(UpdatesUserPasswords $updater)
    {
        $updater->update(
            auth()->user(),
            $attributes = Arr::only($this->invoicearr, ['current_password', 'password', 'password_confirmation'])
        );

        collect($attributes)->map(fn ($value, $key) => $this->invoicearr[$key] = '');
        $this->dispatchBrowserEvent('updated', ['message' => 'Password changed successfully!']);
    }

    public function render()
    {
        return view('livewire.admin.invoice.invoices')
            ->extends('layouts.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.invoice.index');
    // }
}
