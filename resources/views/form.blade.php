@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-4">
        <form method="post" action="{{ route('form') }}">
          @csrf
          <div class="form-group mt-3">
            <label for="name"><strong>Name</strong></label>
            <input type="text" class="form-control mt-3" name="name" placeholder="Enter Name">
          </div>
          <div class="form-group mt-3">
            <label class="mb-3"><strong>Hobbies</strong></label><br>
            <label><input type="checkbox" name="hobby[]" value="Reading">Reading</label>
            <label><input type="checkbox" name="hobby[]" value="Listening Music">Listening Music</label>
            <label><input type="checkbox" name="hobby[]" value="Drawing">Drawing</label>
            <label><input type="checkbox" name="hobby[]" value="Cooking">Cooking</label>
          </div>  
          <div class="form-group mt-3">
            <label class="mb-3"><strong>Gender</strong></label><br>
            <label><input type="radio" name="gender" value="Male">Male</label>
            <label><input type="radio" name="gender" value="Female">Female</label>
          </div>  
          <div class="form-group mt-3">
            <label class="mb-3"><strong>Favorite</strong></label><br>
            <select class="form-select" name="favorite[]" multiple="multiple">
              <option selected>Choose your favourite thing</option>
              <option value="Watching Movies">Watching Movies</option>
              <option value="Travelling">Travelling</option>
              <option value="Eating">Eating</option>
            </select>
          </div>
          <div class="form-group mt-3">
            <label class="mb-3"><strong>Marital Status</strong></label><br>
            <select class="form-select" name="maritalStatus">
              <option selected>Choose your marital status</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
            </select>
          </div>
          <button type="submit" class="mt-3 btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>

@endsection