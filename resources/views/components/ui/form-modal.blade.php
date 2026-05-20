{{-- resources/views/components/ui/form-modal.blade.php --}}
@props([
    'title' => null,
    'submitLabel' => 'Save',
    'cancelLabel' => 'Cancel',
    'show' => false,
    'size' => 'md',
    'wireSubmit' => 'save',
    'loadingText' => 'Processing...',
])

<x-ui.modal :show="$show" :title="$title" :size="$size" {{ $attributes }}>
    <form wire:submit.prevent="{{ $wireSubmit }}">
        {{ $slot }}

        <div class="modal-footer px-0">
            <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">
                {{ $cancelLabel }}
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    {{ $submitLabel }}
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    {{ $loadingText }}
                </span>
            </button>
        </div>
    </form>
</x-ui.modal>
