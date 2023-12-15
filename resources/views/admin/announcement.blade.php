@extends('admin.nav')

@section('title', 'Announcements')

@section('content')
<div class="bg-white h-full m-4 p-3 rounded-lg">
    <div class="flex justify-between pb-3 px-3">
        <h1 class="font-bold lg:text-4xl">Announcements Table</h1>
        <button class="border border-gray-400 px-3 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
    </div>
    <hr class="pb-3">
    <table class="h-full table-auto" id="announcementsTable">
        <thead class="font-bold">
            <tr>
                <td>No</td>
                <td>Title</td>
                <td>Description</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody class="capitalize">
            @php
              $counter = 0;
            @endphp
            @foreach($announcements_data as $announcement)
            <tr class="odd:bg-white even:bg-slate-100">
                @php
                  $counter++
                @endphp
                <td>{{$counter}}</td>
                <td>{{$announcement->title}}</td>
                <td>{{$announcement->description}}</td>
                <td class="flex justify-evenly items-center px-3">
                    <button class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#editModal" data-announcement-id="{{$announcement->announcement_id}}" data-title="{{$announcement->title}}" data-description="{{$announcement->description}}" data-img="{{$announcement->image}}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#deleteModal" data-announcement-id="{{$announcement->announcement_id}}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Add New Announcement</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <div class="flex justify-center items-center bg-black h-80 rounded overflow-hidden">
                    <img id="imgPreview" class="w-full" src="{{asset('img/default-thumbnail.jpg')}}">
                </div>
                <form action="/announcement/post" method="POST" enctype="multipart/form-data">
                    @CSRF
                    <div class="py-3">
                        <p>Title</p>
                        <input type="text" name="title" class="bg-slate-300 h-8 w-full px-2 rounded" value="{{old('title')}}"  required>
                        @error('title')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <p>Description</p>
                        <textarea name="description" class="bg-slate-300 h-24 w-full px-2 rounded"></textarea>
                        @error('description')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <p>Image</p>
                        <input type="file" name="img" id="imgInput" class="bg-slate-300 h-8 w-full px-2 rounded"  required>
                        @error('img')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
            </div>
                <div class="modal-footer">
                <button type="submit" class="border border-gray-400 rounded-md hover:bg-blue-200 hover:text-blue-600 font-medium py-1 px-2">Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Edit Announcement</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <div class="flex justify-center items-center bg-black h-80 rounded overflow-hidden">
                    <img id="editImgPreview" class="w-full" src="">
                </div>
                <form action="/announcement/update" method="POST" enctype="multipart/form-data">
                    @CSRF
                    <input type="text" name="announcement_id" id="announcementId" class="hidden" value="" required>
                    <div class="py-3">
                        <p>Title</p>
                        <input type="text" name="title" id="title" class="bg-slate-300 h-8 w-full px-2 rounded" value="{{old('title')}}"  required>
                        @error('title')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <p>Description</p>
                        <textarea name="description" id="description" class="bg-slate-300 h-24 w-full px-2 rounded"></textarea>
                        @error('description')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-3">
                        <p>Image</p>
                        <input type="file" name="img" id="editImgInput" class="bg-slate-300 h-8 w-full px-2 rounded">
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

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 flex flex-col w-full">
                <i class="fa-solid fa-circle-exclamation text-red-600 text-5xl text-center"></i>
                <p class="font-bold text-xl text-center my-3">Are you sure you want to delete this announcement?</p>
                <div class="flex justify-end gap-3">
                    <a id="deleteLink" href=""><button class="border border-gray-400 rounded-md hover:bg-red-200 hover:text-red-600 font-medium w-16 py-1">Yes</button></a>
                    <a><button class="border border-gray-400 rounded-md hover:bg-gray-200 hover:text-gray-600 font-medium w-16 py-1" data-bs-dismiss="modal">No</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- IMAGE PREVIEW ADD MODAL SCRIPT -->

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

<!-- IMAGE PREVIEW EDIT MODAL SCRIPT -->

<script>
    $(document).ready(function() {
        $('#editImgInput').change(function(){
            let img = this.files[0];
            let reader = new FileReader();

            reader.onload = function(e){
                $('#editImgPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(img);
        });
    });
</script>

<!-- ANNOUNCEMENT PASS TO EDIT MODAL SCRIPT -->

<script>
    $(document).ready(function(){
        $('#editModal').on('show.bs.modal', function(event){
            let button = $(event.relatedTarget);
            let announcementId = button.data('announcement-id');
            let title = button.data('title');
            let description = button.data('description');
            let img = button.data('img');

            $('#announcementId').val(announcementId);
            $('#title').val(title);
            $('#description').val(description);
            $('#editImgPreview').attr('src', "storage/" + img);
        });
    });
</script>

<!-- PASS ANNOUNCEMENT_ID TO DELETE MODAL -->

<script>
$(document).ready(function(){
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let announcementId = button.data('announcement-id');
        let acceptLink = $('#deleteLink');
        acceptLink.attr('href', '/announcement/delete/' + announcementId);
    });
});
</script>

<!-- SWEETALERTS SCRIPT -->

@if(session('announcement-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Announcement has been posted successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('update-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Announcement has been updated successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('delete-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Announcement has been deleted successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

<!----- DATATABLES SCRIPT ----->

<script>
    $(document).ready(function() {
        $('#announcementsTable').DataTable({
           paging: false,
           scrollCollapse: true,
           scrollY: '70vh',
        });
    });
</script>
@stop
