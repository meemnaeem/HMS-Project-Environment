<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Transactions extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $transaction;
    public $transactionIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $transactionsQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getTransactionsQueryProperty()
    {
        return Transaction::search($this->search);
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

    public function createTransaction()
    {
        $validatedData = $this->validateData();
        Transaction::create($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Transaction added successfully!']);
    }

    public function edit(Transaction $transaction)
    {
        $this->showEditModal = true;
        $this->transaction = $transaction;
        $this->state = $transaction->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateTransaction()
    {
        $validatedData = $this->validateData();
        $this->transaction->update($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Transaction updated successfully!']);
    }

    public function confirmTransactionRemoval($transactionId)
    {
        $this->transactionIdBeingRemoved = $transactionId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteTransaction()
    {
        $transaction = Transaction::findOrFail($this->transactionIdBeingRemoved);
        $transaction->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Transaction deleted successfully!']);
    }

    public function changeStatus($transactionId, $status)
    {
        $updateStatus = $status == 0 ? 1 : 0;
        Transaction::where('id', $transactionId)->update(['status' => $updateStatus]);
    }

    public function getTransactionsProperty()
    {
        $transactionsQuery = Transaction::search($this->search);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Transaction::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Transaction::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Transaction::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmTransactionsRemoval($transactionId)
    {
        if (!empty($this->deleteId)) {
            $this->transactionIdBeingRemoved = $transactionId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Transaction::find($this->deleteId)->delete();
        } else {
            Transaction::whereIn('id', $this->checked)->delete();
        }
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected transactions deleted successfully!']);
    }

    public function render()
    {
        $transactions = Transaction::all();
        return view('livewire.admin.transaction.transactions', [
            'transactions' => $transactions,
        ])
            ->extends('layouts.admin.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.transaction.index');
    // }
}
