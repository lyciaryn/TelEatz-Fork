@props(['title' => 'Dashboard'])

<div class="card card-alert animate_animated animate_fadeInUp z-2">
    <div class="card-body header p-4 d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
            <h2 class="fs-4 fw-bold text-secondary p-0 m-0" style="color: var(--darkt);">
                {{ $title }}
            </h2>
        </div>
    </div>
</div>