@extends('cms.parent')

@section('title', 'Edit Message')
@section('main-title', 'Edit Message')
@section('sub-title', 'Edit')

@section('styles')
<style>
  :root { --glow-pink: #c97c9d; --glow-pink-dark: #b46888; }
  .card-shift { margin-left: 0.5cm; margin-right: 0.5cm; }
  .btn-glow-pink {
    background-color: var(--glow-pink);
    border-color: var(--glow-pink);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
  }
  .form-control { border-radius: 8px; }
  .brand-selection { background: #faf6f8; padding: 15px; border-radius: 12px; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-outline card-shift" style="border-top:3px solid #ffc107;">
        <div class="card-header">
            <h3 class="card-title">Update Message: #{{ $contactMessage->id }}</h3>
        </div>
        <form id="edit-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sender_name">Sender Name</label>
                            <input type="text" class="form-control" id="sender_name" value="{{ $contactMessage->sender_name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sender_email">Sender Email</label>
                            <input type="email" class="form-control" id="sender_email" value="{{ $contactMessage->sender_email }}">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="message_text">Message Content</label>
                    <textarea class="form-control" id="message_text" rows="4">{{ $contactMessage->message_text }}</textarea>
                </div>

                <div class="form-group">
                    <label>Assigned Brands</label>
                    <div class="brand-selection">
                        <div class="row">
                            @foreach($brands as $brand)
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input brand-checkbox" type="checkbox"
                                           id="brand_{{ $brand->id }}" value="{{ $brand->id }}"
                                           @if($contactMessage->brands->contains($brand->id)) checked @endif>
                                    <label for="brand_{{ $brand->id }}" class="custom-control-label font-weight-normal">{{ $brand->brand_name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="performUpdate('{{ $contactMessage->id }}')" class="btn btn-glow-pink">Update Message</button>
                <a href="{{ route('cms.contact-messages.index') }}" class="btn btn-light rounded-pill float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
        let brandIds = [];
        document.querySelectorAll('.brand-checkbox:checked').forEach((checkbox) => {
            brandIds.push(parseInt(checkbox.value));
        });

        store('/cms/admin/contact-messages/' + id, {
            '_method': 'PUT',
            'sender_name': document.getElementById('sender_name').value,
            'sender_email': document.getElementById('sender_email').value,
            'message_text': document.getElementById('message_text').value,
            'brand_ids': brandIds
        });
    }
</script>
@endsection
