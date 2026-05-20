@props([
    'id' => null,
    'title' => null,
    'size' => 'md', // sm, md, lg, xl
    'show' => false,
    'closeable' => true,
    'persistent' => false,
])

@php
    $modalId = $id ?? 'modal-' . md5(uniqid());
    $sizeClass = match ($size) {
        'sm' => 'modal-sm',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
        default => '',
    };
@endphp

@if ($show)
    <div id="{{ $modalId }}" class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);"
        wire:key="{{ $modalId }}" x-data="{
            open: true,
            close() {
                if (!{{ $persistent ? 'true' : 'false' }}) {
                    this.open = false;
                    @this.set('showModal', false);
                }
            }
        }" x-show="open" x-on:keydown.escape.window="close()">
        <div class="modal-dialog {{ $sizeClass }}" x-on:click.away="close()">
            <div class="modal-content px-3">
                @if ($title)
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $title }}
                        </h5>
                        @if ($closeable)
                            <button type="button" class="btn-close" @click="close()" aria-label="Close"></button>
                        @endif
                    </div>
                @endif

                <div class="modal-body">
                    {{ $slot }}
                </div>

                @if (isset($footer))
                    <div class="modal-footer">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
