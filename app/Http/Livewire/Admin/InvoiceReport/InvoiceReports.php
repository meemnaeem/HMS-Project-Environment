<?php

namespace App\Http\Livewire\Admin\InvoiceReport;

use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class InvoiceReports extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $invoice;
    public $invoiceIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $invoicesQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getInvoicesQueryProperty()
    {
        return Invoice::search($this->search);
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
            'patient_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'status' => 'required',
        ])->validate();
        return $validData;
    }

    public function createInvoice()
    {
        $validatedData = $this->validateData();
        Invoice::create($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Invoice added successfully!']);
    }

    public function edit(Invoice $invoice)
    {
        $this->showEditModal = true;
        $this->invoice = $invoice;
        $this->state = $invoice->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateInvoice()
    {
        $validatedData = $this->validateData();
        $this->invoice->update($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Invoice updated successfully!']);
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


    public function render()
    {
        $invoices = Invoice::all();
        return view('livewire.admin.invoice-report.invoice-reports', [
            'invoices' => $invoices,
        ])
            ->extends('layouts.admin.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.invoice-report.index');
    // }
}
