@extends('admin.nav')

@section('title', 'Officials')

@section('content')
<div class="h-full m-4 p-3 rounded-lg">
    <div class="flex justify-between pb-3 px-3">
        <h1 class="font-bold lg:text-4xl">Barangay Officials</h1>
        <div class="h-10 flex gap-3">
            <button class="border border-gray-400 px-3 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium lg:h-full" data-bs-toggle="modal" data-bs-target="#archiveModal">Archive All</button>
            <form id="form" action="/official" method="GET">
                <select name="year" class="bg-transparent border border-gray-400 px-3 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium lg:h-full">
                    @foreach($officials_year as $year)    
                        <option value="{{$year ? $year : ''}}" {{ request('year') == $year ? 'selected' : '' }}>{{$year ? $year : 'Current'}}</option>
                    @endforeach
                </select>
                <button type="submit" class="border border-gray-400 px-3 rounded-md hover:bg-blue-200 hover:text-blue-600 lg:h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <hr class="pb-3 border-black">
    <div class="grid lg:grid-cols-4 gap-y-3 lg:gap-x-9 gap-x-3 h-5/6 ">
    @foreach($officials_data as $official)
        <div class="bg-white rounded overflow-hidden lg:h-64 h-80 shadow">
            <div class="relative bg-slate-700 w-full h-2/3 overflow-hidden">
                <div class="h-full flex justify-center">
                    <img src="{{ $official->img != '' ? '/storage/' . $official->img : asset('img/default-profile.jpg') }}">
                </div>
                <div class="absolute top-0 right-0 pe-3 pt-2 z-10">
                    <button class=" border border-gray-500 px-2 rounded-md hover:bg-blue-200 hover:text-blue-600 text-white" data-bs-toggle="modal" data-bs-target="#editModal" data-official-id="{{$official->official_id}}" data-name="{{$official->name}}" data-position="{{$official->position}}" data-img="{{$official->img}}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
            </div>
            <div class="flex flex-col justify-between p-3 h-1/3 text-center">
                <p>{{$official->name}}</p>
                <p>
                @switch($official->position)
                    @case('captain')
                        Barangay Captain
                        @break
                    @case('secretary')
                        Barangay Secretary
                        @break
                    @case('treasurer')
                        Barangay Treasurer
                        @break
                    @case('councilor')
                        Barangay Councilor
                        @break
                    @case('sk')
                        Barangay SK Chairman
                        @break
                @endswitch 
                </p>
            </div>
        </div>
    @endforeach
    </div>
</div>

<!-- Edit MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Edit Official</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <div class="flex justify-center items-center bg-black h-80 rounded overflow-hidden">
                    <img id="imgPreview" class="w-full" src="">
                </div>
                <form action="/official/update" method="POST" enctype="multipart/form-data">
                    @CSRF
                    <input type="text" name="official_id" id="officialId" class="hidden" value="" required>
                    <div class="py-3">
                        <p>Name</p>
                        <input type="text" name="name" id="name" class="bg-slate-300 h-8 w-full px-2 rounded" value="{{old('name')}}"  required>
                        @error('name')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <p>Position</p>
                        <input type="text" id="position" class="bg-slate-300 h-8 w-full px-2 rounded" readonly>
                    </div>
                    <div class="py-3">
                        <p>Image</p>
                        <input type="file" name="img" id="imgInput" class="bg-slate-300 h-8 w-full px-2 rounded">
                        @error('img')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
            </div>
                <div class="modal-footer">
                <button type="submit" class="border border-gray-400 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium py-1 px-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ARCHIVE MODAL -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Archive Officials</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <form action="/official/archive" method="POST" enctype="multipart/form-data">
                    @CSRF
                    <div class="py-3">
                        <p>Year Elected</p>
                        <input type="text" name="year" class="bg-slate-300 h-8 w-full px-2 rounded" value="{{old('year')}}"  required>
                        @error('year')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
            </div>
                <div class="modal-footer">
                <button type="submit" class="border border-gray-400 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium py-1 px-2">Archive</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- IMAGE PREVIEW EDIT MODAL SCRIPT -->

<script>
    $(document).ready(function() {
        $('#imgInput').change(function(){
            let img = this.files[0];
            let reader = new FileReader();

            reader.onload = function(e){
                $('#imgPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(img);
        });
    });
</script>

<!-- OFFICIAL PASS TO EDIT MODAL SCRIPT -->

<script>
    $(document).ready(function(){
        $('#editModal').on('show.bs.modal', function(event){
            let button = $(event.relatedTarget);
            let officialId = button.data('official-id'); 
            let name = button.data('name');
            let position = button.data('position');
            let img = button.data('img');

            if(position == 'captain'){
                position = 'Barangay Captain';
            }else if(position == 'secretary'){
                position = 'Barangay Secretary';
            }else if(position == 'treasurer'){
                position = 'Barangay Treasurer';
            }else if(position == 'councilor'){
                position = 'Barangay Councilor';
            }else{
                position = 'Barangay SK Chairman';
            }

            $('#officialId').val(officialId);
            $('#name').val(name);
            $('#position').val(position);
            $('#imgPreview').attr('src', "storage/" + img);
        });
    });
</script>

<!-- SWEETALERTS SCRIPT -->

@if(session('update-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Official has been updated successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('archive-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Officials has been archived successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

@stop