@extends('layouts.account')

@section('content')
  <div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
      Deactivate Account
    </div>
    <div class="account-bdy p-3">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <p class="lead">Deleting or Deactivating Account</p>
         
        </div>
        <div class="col-sm-12 col-md-8">
          <div class="py-3">
            <p class="mb-3">Logout instead</p>
            <a href="{{route('account.logout')}}" class="btn primary-outline-btn">Logout</a>
            <br>
            <br>
            <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">You can Login after, All the data will are saved in database.</span> </p>
            <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">Sorry you can't delete the account.</span> </p>
          </div>
          
          {{-- For Deleting the account --}}
          {{-- <div>
            <p class="text-sm"><i class="fas fa-info-circle"></i> <span class="font-weight-bold">You will not be able to retrieve your account once you have deleted it.</span> </p>
            <div class="my-4">
             <p class="my-3">Click the button to delete this account.</p> 
              <form action="{{route('account.delete')}}" method="POST">
                @csrf
                @method('delete')
                <div class="form-group">
                  <div class="d-flex">
                    <button type="submit" class="btn danger-btn">Delete Account</button>
                  </div>
                </div>
              </form>
            </div>
          </div> --}}

          {{-- remove br tag when you uncomment delete div tag --}}
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
@endsection
