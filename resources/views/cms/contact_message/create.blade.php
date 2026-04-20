@extends('cms.parent')

@section('title', 'Create Message')
@section('main-title', 'Create Message')
@section('sub-title', 'Create')

@section('styles')
<style>
  :root {
    --glow-pink: #c97c9d;
    --glow-pink-dark: #b46888;
  }
  .card-shift { margin-left: 0.5cm; margin-right: 0.5cm; }
  .btn-glow-pink {
    background-color: var(--glow-pink);
    border-color: var(--glow-pink);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    padding: .5rem 1.5rem;
  }
  .btn-glow-pink:hover { background-color: var(--glow-pink-dark); color: #fff; }
  .form-control { border-radius: 8px; border: 1px solid rgba(0,0,0,.1); }
  .form-control:focus { border-color: var(--glow-pink); box-shadow: none; }
  label { font-weight: 600; color: #555; font-size: 0.9rem; }
  .brand-selection {
    background: #faf6f8;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid rgba(201,124,157,0.1);
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
        <div class="card-header">
            <h3 class="card-title">Add New Contact Message</h3>
        </div>
        <form id="create-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sender_name">Sender Name</label>
                            <input type="text" class="form-control" id="sender_name" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sender_email">Sender Email</label>
                            <input type="email" class="form-control" id="sender_email" placeholder="Email Address">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="message_text">Message Content</label>
                    <textarea class="form-control" id="message_text" rows="4" placeholder="Write your message here..."></textarea>
                </div>

                <div class="form-group">
                    <label>Related Brands</label>
                    <div class="brand-selection">
                        <div class="row">
                            @foreach($brands as $brand)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input brand-checkbox" type="checkbox" id="brand_{{ $brand->id }}" value="{{ $brand->id }}">
                                    <label for="brand_{{ $brand->id }}" class="custom-control-label font-weight-normal">{{ $brand->brand_name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-transparent">
                <button type="button" onclick="performStore()" class="btn btn-glow-pink">
                    <i class="fas fa-save mr-1"></i> Send Message
                </button>
                <a href="{{ route('cms.contact-messages.index') }}" class="btn btn-light rounded-pill float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function performStore() {
        let brandIds = [];
        document.querySelectorAll('.brand-checkbox:checked').forEach((checkbox) => {
            brandIds.push(parseInt(checkbox.value));
        });

        store('/cms/admin/contact-messages', {
            sender_name: document.getElementById('sender_name').value,
            sender_email: document.getElementById('sender_email').value,
            message_text: document.getElementById('message_text').value,
            brand_ids: brandIds
        });
    }
</script>
@endsection
