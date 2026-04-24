@extends('cms.parent')

@section('title', 'View Message')
@section('main-title', 'Message Details')
@section('sub-title', 'Details')

@section('styles')
<style>
  .card-shift { margin-left: 0.5cm; margin-right: 0.5cm; }
  .info-label { color: #6c757d; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }
  .info-value { font-weight: 600; color: #333; font-size: 1.1rem; }
  .message-box { background: #f8f9fa; padding: 20px; border-radius: 12px; border-left: 4px solid var(--glow-pink); }
  .badge-brand { background: rgba(201,124,157,0.1); color: #c97c9d; padding: 6px 12px; border-radius: 8px; margin-right: 5px; font-weight: 600; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-outline card-shift" style="border-top:3px solid #17a2b8;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Viewing Message Details</h3>
            {{-- <div class="ml-auto">
                <a href="{{ route('cms.contact-messages.edit', $contactMessage->id) }}" class="btn btn-sm btn-outline-warning rounded-pill">Edit Message</a>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-label">From</div>
                    <div class="info-value">{{ $contactMessage->sender_name }}</div>
                    <small class="text-muted">{{ $contactMessage->sender_email }}</small>
                </div>
                <div class="col-md-4 text-center border-left border-right">
                    <div class="info-label">Date Received</div>
                    <div class="info-value">{{ $contactMessage->created_at->format('M d, Y') }}</div>
                    <small class="text-muted">{{ $contactMessage->created_at->format('h:i A') }}</small>
                </div>
                <div class="col-md-4 text-right">
                    <div class="info-label">Reference ID</div>
                    <div class="info-value">#MSG-{{ $contactMessage->id }}</div>
                </div>
            </div>

            <div class="mb-4">
                <div class="info-label mb-2">Message Content</div>
                <div class="message-box">{{ $contactMessage->message_text }}</div>
            </div>

            <div>
                <div class="info-label mb-2">Related Brands</div>
                @forelse($contactMessage->brands as $brand)
                    <span class="badge-brand">{{ $brand->brand_name }}</span>
                @empty
                    <span class="text-muted italic">No brands associated.</span>
                @endforelse
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('cms.contact-messages.index') }}" class="btn btn-secondary rounded-pill px-4">Close</a>
        </div>
    </div>
</div>
@endsection
