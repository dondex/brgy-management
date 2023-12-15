@extends('admin.nav')

@section('title', 'Residents')

@section('content')
<div class="bg-white h-full m-4 p-3 rounded-lg">
    <div class="pb-3 px-3">
        <h1 class="font-bold lg:text-4xl">Residents Table</h1>
    </div>
    <hr class="pb-3">
    <table class="h-full" id="residentsTable">
        <thead class="font-bold">
            <tr>
                <td>Fullname</td>
                <td>Address</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Occupation</td>
                <td>Civil Status</td>
                <td>Phone</td>
                <td>Email</td>
                <td>4Ps</td>
            </tr>
        </thead>
        <tbody>
            @foreach($residents_data as $resident)
            <tr class="odd:bg-white even:bg-slate-100">
                <td class="capitalize">{{$resident->firstname}} {{$resident->middlename}} {{$resident->lastname}}</td>
                <td class="capitalize">{{$resident->address}}</td>
                <td>{{\Carbon\Carbon::parse($resident->birthdate)->age}}</td>
                @if($resident->gender == 'male')
                  <td><i class="fa-solid fa-mars text-blue-600 mr-2"></i>Male</td>
                @elseif($resident->gender == 'female')
                  <td><i class="fa-solid fa-venus text-pink-600 mr-2"></i>Female</td>
                @else
                  <td><i class="fa-solid fa-transgender text-purple-600 mr-2"></i>LGBT</td>
                @endif
                <td class="capitalize">{{$resident->occupation}}</td>
                <td class="capitalize">{{$resident->civil_status}}</td>
                <td>{{$resident->phone}}</td>
                <td>{{$resident->email}}</td>
                @if($resident->four_ps == 'yes')
                  <td><i class="fa-solid fa-check text-green-600 mr-2"></i></i>Yes</td>
                @else
                  <td><i class="fa-solid fa-xmark text-red-600 mr-2"></i>No</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!----- DATATABLES SCRIPT ----->

<script>
    $(document).ready(function() {
        $('#residentsTable').DataTable({
           dom: 'Bfrtip',
           scrollCollapse: true,
           scrollY: '70vh',
           buttons: [
            { extend: 'excelHtml5'},
            { extend: 'csvHtml5'},
            { extend: 'pdfHtml5'},
           ]
        });
    });
</script>
@stop