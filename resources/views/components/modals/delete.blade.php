@props([
    // 'data' => null,
    'formAction' => false,
    'title' => '',
    'content' => '',
    'buttons' => null,
])

<div class="modal fade" id="deleteModal" role="dialog" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        @if ($formAction)
            <form wire:submit.prevent="{{ $formAction }}">
        @endif
        <div class="modal-content">
            <div class="modal-header">
                @if (isset($title))
                    <h3 class="modal-title text-lg leading-6 font-medium text-gray-900">
                        {{ $title }}
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body text-center">
                <div class="space-y-6">
                    {{ $content }}
                </div>
            </div>
            <div class="modal-footer">
                {{ $buttons }}
            </div>
            @if ($formAction)
                </form>
            @endif
        </div>
    </div>
</div>
