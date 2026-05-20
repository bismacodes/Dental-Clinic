{{-- resources/views/components/ui/confirm-modal.blade.php --}}
@props([
    'show' => false,
    'title' => '',
    'message' => 'Are you sure you want to proceed?',
    'confirmLabel' => 'Confirm',
    'cancelLabel' => 'Cancel',
    'confirmVariant' => 'primary',
    'wireConfirm' => null,
    'wireCancel' => null,
])

@php
    $buttonClass = match ($confirmVariant) {
        'danger' => 'btn-danger',
        'warning' => 'btn-warning',
        'success' => 'btn-success',
        default => 'btn-primary',
    };
@endphp

<x-ui.modal :show="$show" :title="$title" size="md">
    <div class="text-center py-3 px-5">

        <!-- Icon with soft background -->
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
            style="width:80px; height:80px; border-radius:50%; background-color: rgba(255, 213, 61, 0.1);">
            <i class="bx bx-message-circle-question-mark text-warning" style="font-size: 40px;"></i>
        </div>

        <!-- Message -->
        <h5 class="fw-semibold mb-2">Confirm Action</h5>
        <p class="text-muted mb-0" style="font-size: 14px;">
            {{ $message }}
        </p>
    </div>

    <!-- Footer -->
    <div class="modal-footer border-0 pt-2 d-flex justify-content-center gap-2">

        <button type="button" class="btn btn-secondary px-4"
            @if ($wireCancel) wire:click="{{ $wireCancel }}"
            @else
                wire:click="$set('showConfirmModal', false)" @endif>
            {{ $cancelLabel }}
        </button>

        <button type="button" class="btn {{ $buttonClass }} px-4 shadow-sm"
            @if ($wireConfirm) wire:click="{{ $wireConfirm }}"
            @else
                wire:click="$set('showConfirmModal', false)" @endif>
            {{ $confirmLabel }}
        </button>

    </div>
</x-ui.modal>
