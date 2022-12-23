<?php
namespace App\Http\Livewire\Admin\Review;

use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Reviews extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $review;
    public $reviewIdBeingRemoved = null;
    public $selectAll = false;
    public $checked = [];
    public $search = '';
    public $currentUrl;
    public $deleteId = '';
    public $reviewsQuery = '';


    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getReviewsQueryProperty()
    {
        return Review::search($this->search);
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
            'user_id' => 'required',
            'date' => 'required',
            'rating' => 'required',
            'description' => 'required',
        ])->validate();
        return $validData;
    }

    public function createReview()
    {
        $validatedData = $this->validateData();
        Review::create($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Review added successfully!']);
    }

    public function edit(Review $review)
    {
        $this->showEditModal = true;
        $this->review = $review;
        $this->state = $review->toArray();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateReview()
    {
        $validatedData = $this->validateData();
        $this->review->update($validatedData);
        $this->dispatchBrowserEvent('hide-modal', ['message' => 'Review updated successfully!']);
    }

    public function confirmReviewRemoval($reviewId)
    {
        $this->reviewIdBeingRemoved = $reviewId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteReview()
    {
        $review = Review::findOrFail($this->reviewIdBeingRemoved);
        $review->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Review deleted successfully!']);
    }

    public function changeStatus($reviewId, $status)
    {
        $updateStatus = $status == 0 ? 1 : 0;
        Review::where('id', $reviewId)->update(['status' => $updateStatus]);
    }

    public function getReviewsProperty()
    {
        $reviewsQuery = Review::search($this->search);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = Review::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        if (count($this->checked) == Review::count()) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }

    public function SelectAllRecord()
    {
        $this->checked = Review::get()->pluck('id')->map(fn ($value) => (string) $value)->toArray();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmReviewsRemoval($reviewId)
    {
        if (!empty($this->deleteId)) {
            $this->reviewIdBeingRemoved = $reviewId;
            $this->dispatchBrowserEvent('show-delete-modal');
        } else {
            $this->dispatchBrowserEvent('show-multi-delete-modal');
        }
    }

    public function delete()
    {
        if (!empty($this->deleteId)) {
            Review::find($this->deleteId)->delete();
        } else {
            Review::whereIn('id', $this->checked)->delete();
        }
        $this->selectAll = false;
        $this->checked = [];
        $this->dispatchBrowserEvent('hide-multi-delete-modal', ['message' => 'Selected reviews deleted successfully!']);
    }

    public function render()
    {
        $reviews = Review::all();
        return view('livewire.admin.review.reviews', [
            'reviews' => $reviews,
        ])
        ->extends('layouts.app')
            ->section('content');
    }

    // public function index()
    // {
    //     return view('admin.review.index');
    // }
}
