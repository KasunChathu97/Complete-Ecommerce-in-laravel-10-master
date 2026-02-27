@extends('backend.layouts.master')

@section('title','Admin Profile')

@section('main-content')

<div class="profile-page">
    <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-body p-0">
            <div class="profile-hero">
                <div class="profile-hero__content">
                    <div class="profile-hero__avatar">
                        @if($profile->photo)
                            <img id="photo_preview" src="{{$profile->photo}}" alt="profile picture" />
                        @else
                            <img id="photo_preview" src="{{asset('backend/img/avatar.png')}}" alt="profile picture" />
                        @endif
                    </div>
                    <div class="profile-hero__meta">
                        <h4 class="mb-1">{{$profile->name}}</h4>
                        <div class="text-white-50 mb-2">{{$profile->email}}</div>
                        <span class="badge badge-light text-uppercase">{{$profile->role}}</span>
                    </div>
                    <div class="profile-hero__actions">
                        <a href="{{route('admin')}}" class="btn btn-light btn-sm">Back to Dashboard</a>
                    </div>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <div class="row">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="text-muted text-uppercase mb-3">Profile picture</h6>

                                <div class="custom-file">
                                    <input id="inputPhoto" type="file" class="custom-file-input" name="photo_file" accept="image/*" form="profileForm">
                                    <label class="custom-file-label" for="inputPhoto">Choose image</label>
                                </div>
                                <small class="text-muted d-block mt-2">JPG/PNG/WebP, max 2MB. The preview updates instantly.</small>

                                @error('photo_file')
                                    <span class="text-danger d-block mt-2">{{$message}}</span>
                                @enderror

                                <hr>

                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <div class="profile-mini-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted">Logged in as</div>
                                        <div class="font-weight-bold">{{$profile->name}}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3" style="gap: 10px;">
                                    <div class="profile-mini-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted">Email</div>
                                        <div class="font-weight-bold">{{$profile->email}}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3" style="gap: 10px;">
                                    <div class="profile-mini-icon">
                                        <i class="fas fa-hammer"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted">Role</div>
                                        <div class="font-weight-bold text-uppercase">{{$profile->role}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5 class="mb-0">Profile</h5>
                                    <span class="text-muted">Update your details</span>
                                </div>

                                <form id="profileForm" method="POST" action="{{route('profile-update',$profile->id)}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="inputTitle" class="col-form-label">Name</label>
                                        <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{$profile->name}}" class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="col-form-label">Email</label>
                                        <input id="inputEmail" disabled type="email" name="email" value="{{$profile->email}}" class="form-control">
                                    </div>

                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <div class="form-group">
                                            <label for="role" class="col-form-label">Role</label>
                                            <select id="role" name="role" class="form-control">
                                                <option value="">-----Select Role-----</option>
                                                <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>Admin</option>
                                                <option value="sales_admin" {{(($profile->role=='sales_admin')? 'selected' : '')}}>Sales Admin</option>
                                                <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>User</option>
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center justify-content-end" style="gap: 10px;">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .profile-hero{
        background: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);
        padding: 28px 28px;
    }
    .profile-hero__content{
        display:flex;
        align-items:center;
        gap: 16px;
        color: #fff;
    }
    .profile-hero__avatar{
        width: 92px;
        height: 92px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
        border: 2px solid rgba(255,255,255,0.55);
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        flex: 0 0 auto;
    }
    .profile-hero__avatar img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-hero__meta{
        flex: 1 1 auto;
        min-width: 180px;
    }
    .profile-hero__actions{
        flex: 0 0 auto;
    }
    .profile-mini-icon{
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8f9fc;
        display:flex;
        align-items:center;
        justify-content:center;
        color: #4e73df;
    }
    .custom-file-label{
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        var input = document.getElementById('inputPhoto');
        var preview = document.getElementById('photo_preview');
        if (!input || !preview) return;

        // Update the bootstrap custom file label.
        input.addEventListener('change', function (e) {
            var file = e.target.files && e.target.files[0];
            if (!file) return;
            var label = document.querySelector('label.custom-file-label[for="inputPhoto"]');
            if (label) label.textContent = file.name;
        });

        input.addEventListener('change', function (e) {
            var file = e.target.files && e.target.files[0];
            if (!file) return;
            preview.src = URL.createObjectURL(file);
        });
    })();
</script>
@endpush