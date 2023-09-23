@extends('admin.layouts.master');
@section('page_title') Admin -Person Edit @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('admin.person_update'); }}" method="POST" enctype="multipart/form-data">
      @csrf <input type="hidden" name="hidden_id" value="{{ $person->id }}">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Person Add</h5>
              <a href="{{ route('admin.person_index') }}" class="btn btn-primary">All Persons</a>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Select Role</label>
                <select name="role" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  @if ( $person->role == 1)
                  <option value="0">User</option>
                  <option selected value="1">Admin</option>
                  @else
                  <option selected value="0">User</option>
                  <option value="1">Admin</option>
                  @endif
                </select>
              </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Full Name</label>
                  <input required name="name" type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" value="{{ $person->name; }}"/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Email</label>
                  <div class="input-group input-group-merge">
                    <input required name="email" 
                      type="email"
                      id="basic-default-email"
                      class="form-control"
                      placeholder="john.doe"
                      aria-label="john.doe"
                      aria-describedby="basic-default-email2"
                      value="{{ $person->email; }}"
                    />
                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                  </div>
                  <div class="form-text">You can use letters, numbers & periods</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Phone No</label>
                  <input name="phone" 
                    type="text"
                    id="basic-default-phone"
                    class="form-control phone-mask"
                    placeholder="658 799 8941"
                    value="{{ $person->phone; }}"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Address</label>
                  <textarea name="address"
                    id="basic-default-message"
                    class="form-control"
                    placeholder="Sirajganj(6740), Bangladesh"
                  >{{ $person->billing_address; }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-password">Password</label>
                  <input name="password"  type="text" class="form-control" id="basic-default-password" placeholder="12345678" />
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Add Image</label>
                  <input name="image" class="form-control" type="file" id="formFile" />
                </div>
                <img style="height: 100px;" src="{{ asset('images/'.$person->image.'') }}" alt="">
            </div>
            <button type="submit" class="btn btn-primary">Update Person</button>
          </div>
        </div>
    </div>
    </form>        
    </div>
  </div>
@endsection