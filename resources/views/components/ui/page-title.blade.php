@props([
    'title' => '',
    'subtitle' => '',
])
<!-- Nav Header Component Start -->
<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $title }}</h3>
            <p class="text-subtitle text-muted">{{ $subtitle }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Nav Header Component End -->
@include('partials.messages')
