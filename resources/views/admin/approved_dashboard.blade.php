@extends('layouts.app')
@section('content')
<style>
/* === TAB STYLING === */
.service-tabs {
    display: flex;
    flex-wrap: wrap; /* allow wrapping on small screens */
    gap: 10px; /* space between tabs */
    padding: 10px 0; /* top/bottom padding */
}

.service-tabs .nav-link {
    font-weight: 600;
    border-radius: 0.5rem;
    margin: 0; /* remove default margin because we use gap */
    padding: 0.8rem 1.5rem; /* more padding for bigger clickable area */
    color: #333;
    background: #f8f9fa;
    border: 1px solid #ddd;
    transition: all 0.3s;
}

.service-tabs .nav-link.active {
    background: linear-gradient(90deg, #4f46e5, #3b82f6);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Badge inside tab */
.service-tabs .nav-link .badge {
    margin-left: 10px; /* more space from tab text */
    font-size: 0.85rem;
    background: linear-gradient(90deg, #10b981, #06b6d4);
    color: #fff;
    font-weight: 600;
    padding: 0.3em 0.6em;
    border-radius: 0.5rem;
}
/* === SUB-CARD STYLING === */
.sub-card {
    background: #fff;
    border-radius: 16px;
    padding: 22px 15px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    position: relative;
    overflow: hidden;
}

.sub-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 30px rgba(0,0,0,0.15);
    background: #f3f6ff;
}

.sub-card h6 {
    font-weight: 600;
    margin-bottom: 14px;
    font-size: 1rem;
    min-height: 48px;
    color: #1f2937;
}

/* === COUNT BADGE === */
.count-badge {
    display: inline-block;
    padding: 10px 18px;
    background: linear-gradient(90deg, #14b8a6, #06b6d4);
    color: #fff;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    animation: popIn 0.5s ease forwards;
}

/* Badge hover pop */
.count-badge:hover {
    background: linear-gradient(90deg, #0d9488, #0ea5e9);
    transform: translateY(-2px) scale(1.05);
}

/* Pop animation */
@keyframes popIn {
    0% {
        transform: scale(0.8);
        opacity: 0;
    }
    60% {
        transform: scale(1.1);
        opacity: 1;
    }
    100% {
        transform: scale(1);
    }
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .sub-card h6 {
        font-size: 0.9rem;
    }
    .service-tabs .nav-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
    }
}
</style>

<div class="container-fluid">

    <!-- MAIN SERVICE TABS -->
    <ul class="nav nav-tabs service-tabs" role="tablist">
        @foreach($approvedCounts as $pid => $service)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($loop->first) active @endif"
                data-bs-toggle="tab"
                data-bs-target="#service{{ $pid }}"
                type="button"
                role="tab"
                aria-controls="service{{ $pid }}"
                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                {{ $service['parent_name'] }}
                <span class="badge">{{ $service['total'] }}</span>
            </button>
        </li>
        @endforeach
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content mt-4">
        @foreach($approvedCounts as $pid => $service)
        <div class="tab-pane fade @if($loop->first) show active @endif"
            id="service{{ $pid }}" role="tabpanel">
            <div class="row">
                @foreach($service['subs'] as $sub)
                <div class="col-6 col-md-3 mb-4">
                    <div class="sub-card">
                        <h6>{{ $sub->sub_service }}</h6>
                        <a href="{{ route('approved.list', [
                            'table' => $sub->table_name,
                            'service_id' => $sub->sub_id
                        ]) }}" class="count-badge">
                            {{ $sub->total }} Approved
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
