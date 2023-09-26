@extends('admin.layouts.master');
@section('page_title') Admin-Persons @endsection
@section('content')
<div class="content-wrapper">
    <div  class="container-xxl flex-grow-1 container-p-y">
      <div class="card">
        <div class="d-flex justify-content-between p-4">
          <h5 class="">All Persons</h5>
          <form action="{{ route('admin.person_search') }}" method="POST">
            @csrf
            <div class="input-group">
              <input required name="search" type="text" class="form-control" placeholder="Search Here..." value="@if (isset($search))@if ($search == 0 || $search == 1)@else{{ $search }}@endif @endif">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
          </form>
        </div>
        

        <div class="d-flex justify-content-between p-4">          
          <div class="d-flex justify-content-between gap-4">
            <a href="{{ route('admin.person_index') }}" class="btn btn-primary">&#8634 Refresh</a>
            <a href="#!"  onclick="deleteAll()" class="btn btn-primary">Delete All</a>
            <form action="{{ route('admin.person_search') }}" class="role_form" method="POST">
              @csrf
              <input type="hidden" name="hidden_select" value="hidden_select">
            <select name="search" class="btn btn-primary role_select">

              @php
                $i = 0;
                foreach($persons as $data){
                  $i++;
                }
              @endphp


              <option selected value=""> 
                @if (isset($search))
                @if ($search == 1)
                  Admin ({{ $i }})
                @elseif($search == 0)
                  User ({{ $i }})
                  @else
                  Filter Role ({{ $i }})
                @endif
              @else
                Filter Role ({{ $i }})
              @endif
            </option>

              <option value="0">User</option>
              <option value="1">Admin</option>
            </select>
            </form>

            <script>
              $(document).ready(function(){
                $('.role_select').change(function(){
                    $('.role_form').submit();
                });
              });
            </script>

          </div>
          <a href="{{ route('admin.person_add') }}" class="btn btn-primary">Add New Person</a>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th><input class="select_all" type="checkbox"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($persons as $data)
              <tr>
                <td><input class="checkbox" name="checkboxAll[]" type="checkbox"></td>
                <td><img style="width: 40px" src="{{ asset('images/'.$data->image.'') }}" alt="Avatar" class="rounded-circle" /></td>
                <td><strong>{{ $data->name }}</strong></td>
                <td>{{ $data->email }}</td>
                <td><span>{{ $data->phone }}</span></td>
                <td>
                @if ($data->role == 1)
                <span class="badge bg-label-info me-1">{{ 'Admin' }}</span>                  
                @else 
                <span class="badge bg-label-danger me-1">{{ 'User' }}</span>
                               
                @endif
                </td>
                <td>
                  <a href="{{ route('admin.person_edit',$data->id) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a> |
                  <a onclick="salert({{ $data->id }})" href="#!" ><i class="bx bx-trash me-1 delet_btn"></i>Delete</a>                
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <br>
          
          @if (!isset($search))          
          <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item prev @if ($persons->onFirstPage()) disabled @endif">
                  <a class="page-link" href="{{ $persons->previousPageUrl() }}"><i class="tf-icon bx bx-chevrons-left"></i></a>
                </li>
                @foreach ($persons->links()->elements[0] as $page => $url)

                <li class="page-item @if ($persons->currentPage() == $page) active @endif">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>

                @endforeach              
                <li class="page-item next @if ($persons->hasMorePages() == false) disabled @endif">
                  <a class="page-link" href="{{ $persons->nextPageUrl() }}"><i class="tf-icon bx bx-chevrons-right"></i></a>
                </li>
            </ul>
          </nav>
          @endif

          


        </div>
      </div>
    </div>
  </div>
@endsection