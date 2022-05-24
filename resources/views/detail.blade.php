@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Hobbies</th>
            <th scope="col">Gender</th>
            <th scope="col">Favorite</th>
            <th scope="col">Marital Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ session()->get('name') }}</td>
            <td>
              @foreach (session()->get('hobbies') as $hobby)
              {{ $hobby . ','}}<br>
              @endforeach
            </td>
            <td>{{ session()->get('gender') }}</td>
            <td>              
              @foreach (session()->get('favorite') as $favorite)
                {{ $favorite . ','}}<br>
              @endforeach
            </td>
            <td>{{ session()->get('maritalStatus') }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection