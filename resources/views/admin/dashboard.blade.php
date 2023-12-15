@extends('admin.nav')

@section('title', 'Dashboard')

@section('content')

<div class="flex flex-col gap-3 m-5 h-full">
    <div class="flex lg:flex-row flex-col gap-3 lg:h-28">
        <div class="flex-1 flex flex-col justify-between bg-amber-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-users text-xl"></i>
                <p class="text-xl">Total Population</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">1000</p>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-between bg-teal-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-bullhorn"></i>
                <p class="text-xl">Total Announcements</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">{{ isset($count_announcements) ? $count_announcements : '0' }}</p>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-between bg-violet-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <p class="text-xl">4Ps</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">{{ isset($count_fourPs) ? $count_fourPs : '0' }}</p>
            </div>
        </div> 
    </div>
    <div class="flex lg:flex-row flex-col gap-3 lg:h-28">
        <div class="flex-1 flex flex-col justify-between bg-green-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-file-circle-check text-xl"></i>
                <p class="text-xl">Approved Documents</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">{{ isset($count_approved) ? $count_approved : '0' }}</p>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-between bg-orange-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-file-circle-minus text-xl"></i>
                <p class="text-xl">Pending Documents</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">{{ isset($count_pending) ? $count_pending : '0' }}</p>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-between bg-red-400 rounded shadow">
            <div class="flex items-center pt-5 px-5 gap-3">
                <i class="fa-solid fa-file-circle-xmark text-xl"></i>
                <p class="text-xl">Declined Documents</p>
            </div>
            <div class="pb-5 px-5">
                <p class="text-3xl text-end font-bold">{{ isset($count_declined) ? $count_declined : '0' }}</p>
            </div>
        </div> 
    </div>
    <div class="flex-1 flex lg:flex-row flex-col gap-3 lg:h-96">
        <div class="flex flex-col justify-center items-center p-3 bg-white rounded lg:w-1/3 shadow">
            <canvas class="mb-3" id="doughnutChart"></canvas>
            <p class="font-semibold">Registered/Unregistered Users Chart</p>
        </div>
        <div class="p-3 bg-white rounded lg:w-2/3 shadow">
            <div class="flex items-center w-full gap-3">
                <i class="fa-solid fa-id-card text-xl"></i>
                <p class="text-xl font-semibold">For Verification</p>
            </div><hr>
            <table class="h-full" id="verificationsTable">
                <thead class="font-bold">
                    <tr>
                        <td>Fullname</td>
                        <td>Address</td>
                        <td>Age</td>
                        <td>Gender</td>
                        <td>Valid ID</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="capitalize">
                    @foreach($unverified_residents as $unverified)
                    <tr class="odd:bg-white even:bg-slate-100">
                        <td>{{$unverified->firstname}} {{$unverified->middlename}} {{$unverified->lastname}}</td>
                        <td>{{$unverified->address}}</td>
                        <td>{{\Carbon\Carbon::parse($unverified->birthdate)->age}}</td>
                        <td>{{$unverified->gender}}</td>
                        <td><button class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#idModal" data-valid-id="{{$unverified->valid_id}}">View ID</button></td>
                        <td class="flex justify-around">
                            <button class="border border-green-600 text-green-600 hover:bg-green-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#acceptVerifyModal" data-resident-id="{{$unverified->resident_id}}"><i class="fa-solid fa-check"></i></button>
                            <button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#declineVerifyModal" data-resident-id="{{$unverified->resident_id}}"><i class="fa-solid fa-xmark"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
      
    </div>
</div>

<!-- ID MODAL -->
<div class="modal fade" id="idModal" tabindex="-1" aria-labelledby="idModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Valid ID</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <img src="">
            </div>
        </div>
    </div>
</div>

<!-- ACCEPT VERIFY MODAL -->
<div class="modal fade" id="acceptVerifyModal" tabindex="-1" aria-labelledby="acceptVerifyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 flex flex-col w-full">
                <i class="fa-solid fa-circle-exclamation text-green-600 text-5xl text-center"></i>
                <p class="font-bold text-xl text-center my-3">Are you sure you want to accept verification of this resident?</p>
                <div class="flex justify-end gap-3">
                    <a id="acceptLink" href=""><button class="border border-gray-400 rounded-md hover:bg-green-200 hover:text-green-600 font-medium w-16 py-1">Yes</button></a>
                    <a><button class="border border-gray-400 rounded-md hover:bg-gray-200 hover:text-gray-600 font-medium w-16 py-1" data-bs-dismiss="modal">No</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DECLINE VERIFY MODAL -->
<div class="modal fade" id="declineVerifyModal" tabindex="-1" aria-labelledby="declineVerifyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 flex flex-col w-full">
                <i class="fa-solid fa-circle-exclamation text-red-600 text-5xl text-center"></i>
                <p class="font-bold text-xl text-center my-3">Are you sure you want to decline verification of this resident?</p>
                <div class="flex justify-end gap-3">
                    <a id="declineLink" href=""><button class="border border-gray-400 rounded-md hover:bg-red-200 hover:text-red-600 font-medium w-16 py-1">Yes</button></a>
                    <a><button class="border border-gray-400 rounded-md hover:bg-gray-200 hover:text-gray-600 font-medium w-16 py-1" data-bs-dismiss="modal">No</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PASS VALID_ID TO ID MODAL -->

<script>
$(document).ready(function(){
    $('#idModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let validId = button.data('valid-id'); 
        let modal = $(this);
        modal.find('.modal-body img').attr('src', 'storage/' + validId);
    });
});
</script>

<!-- PASS RESIDENT_ID TO ACCEPT VERIFY MODAL -->

<script>
$(document).ready(function(){
    $('#acceptVerifyModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let validId = button.data('resident-id'); 
        let acceptLink = $('#acceptLink');
        acceptLink.attr('href', '/resident/accept/' + validId);
    });
});
</script>

<!-- PASS RESIDENT_ID TO DECLINE VERIFY MODAL -->

<script>
$(document).ready(function(){
    $('#declineVerifyModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let validId = button.data('resident-id'); 
        let acceptLink = $('#declineLink');
        acceptLink.attr('href', '/resident/decline/' + validId);
    });
});
</script>

<!-- SWEETALERTS SCRIPT -->

@if(session('verify-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Resident has been verified successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('verify-decline'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Resident has been declined successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

<!----- DATATABLES SCRIPT ----->

<script>
    $(document).ready(function() {
        $('#verificationsTable').DataTable({
           paging: false,
           scrollCollapse: true,
           scrollY: '70vh',
           info: false,
        });
    });
</script>

<!-- CHART JS SCRIPT -->
<script>
var ctx = document.getElementById('doughnutChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['{{isset($count_residents) ? $count_residents : '0' }} Registered', '{{isset($count_residents) ? (1000 - $count_residents) : '1000' }} Unregistered'],
        datasets: [{
            data: [ {{isset($count_residents) ? $count_residents : '0' }}, {{isset($count_residents) ? (1000 - $count_residents) : '1000' }}],
            backgroundColor: [
                'rgba(75,193,193,255)',
                'rgba(254,159,65,255)'
                
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
});
</script>

@stop