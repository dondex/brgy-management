@extends('admin.nav')

@section('title', 'Documents')

@section('content')
<div class="bg-white h-full m-4 p-3 rounded-lg">
    <div class="pb-3 px-3">
        <h1 class="font-bold lg:text-4xl">Documents Table</h1>
    </div>
    <hr class="pb-3">
    <table class="h-full" id="documentsTable">
        <thead class="font-bold">
            <tr>
                <td>No</td>
                <td>Resident</td>
                <td>Document Type</td>
                <td>Purpose</td>
                <td>Delivery</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody class="capitalize">
            @php
              $counter = 0;
            @endphp
            @foreach($documents_data as $document)
            <tr class="odd:bg-white even:bg-slate-100">
                @php
                  $counter++
                @endphp
                <td>{{$counter}}</td>
                <td>{{$document->resident->firstname}} {{$document->resident->middlename}} {{$document->resident->lastname}}</td>
                <td>
                @switch($document->doc_type)
                    @case('cli')
                        Certificate of Indigency
                        @break
                    @case('cor')
                        Certificate of Residency
                        @break
                    @default
                        Barangay Clearance
                @endswitch
                </td>
                <td>{{$document->purpose}}</td>
                <td>{{$document->delivery}}</td>
                <td>
                @switch($document->status)
                    @case('approved')
                        <p class="bg-green-600 text-white text-center rounded-2xl">Approved</p>
                        @break
                    @case('declined')
                        <p class="bg-red-600 text-white text-center rounded-2xl">Declined</p>
                        @break
                    @default
                        <p class="bg-orange-600 text-white text-center rounded-2xl">Pending</p>
                @endswitch
                </td>
                <td class="flex justify-evenly items-center px-3">
                    @if($document->status == 'pending')
                    <button class="border border-green-600 text-green-600 hover:bg-green-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="{{ $document->delivery == 'email' ? '#approveModal' : '#approveModal2' }}" data-document-id="{{$document->document_id}}" data-delivery="{{$document->delivery}}">
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white py-2 px-3 rounded" data-bs-toggle="modal" data-bs-target="#declineModal" data-document-id="{{$document->document_id}}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- APPROVE MODAL - EMAIL -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-xl font-bold">Approve Document</h1>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark text-2xl text-gray-400 hover:text-gray-600"></i></button>
            </div>
            <div class="modal-body">
                <div class="flex justify-center items-center bg-black h-80 rounded overflow-hidden">
                    <embed id="docPreview" class="h-full w-full" src="{{asset('img/default-thumbnail.jpg')}}">
                </div>
                <form action="/document/approve" method="POST" enctype="multipart/form-data">
                    @CSRF
                        <input type="text" name="document_id" id="document_id" class="hidden" value="">
                    <div class="py-3">
                        <p>Document</p>
                        <input type="file" name="document" id="docInput" accept="application/pdf" class="bg-slate-300 h-8 w-full px-2 rounded"  required>
                        @error('document')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
            </div>
                <div class="modal-footer">
                <button type="submit" class="border border-gray-400 rounded-md hover:bg-green-200 hover:text-green-600 font-medium py-1 px-2">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- APPROVE MODAL - PICKUP -->
<div class="modal fade" id="approveModal2" tabindex="-1" aria-labelledby="approveModal2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 flex flex-col w-full">
                <i class="fa-solid fa-circle-exclamation text-green-600 text-5xl text-center"></i>
                <p class="font-bold text-xl text-center my-3">Are you sure you want to approve this document request?</p>
                <div class="flex justify-end gap-3">
                    <a id="approveLink" href=""><button class="border border-gray-400 rounded-md hover:bg-green-200 hover:text-green-600 font-medium w-16 py-1">Yes</button></a>
                    <a><button class="border border-gray-400 rounded-md hover:bg-gray-200 hover:text-gray-600 font-medium w-16 py-1" data-bs-dismiss="modal">No</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DECLINE MODAL -->

<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="p-3 flex flex-col w-full">
                <i class="fa-solid fa-circle-exclamation text-red-600 text-5xl text-center"></i>
                <p class="font-bold text-xl text-center my-3">Are you sure you want to decline this document request?</p>
                <div class="flex justify-end gap-3">
                    <a id="declineLink" href=""><button class="border border-gray-400 rounded-md hover:bg-red-200 hover:text-red-600 font-medium w-16 py-1">Yes</button></a>
                    <a><button class="border border-gray-400 rounded-md hover:bg-gray-200 hover:text-gray-600 font-medium w-16 py-1" data-bs-dismiss="modal">No</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PASS DOCUMENT_ID TO APPROVE MODAL - EMAIL -->

<script>
$(document).ready(function(){
    $('#approveModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let documentId = button.data('document-id'); 
        
        $('#document_id').val(documentId);
    });
});
</script>

<!-- PASS DOCUMENT_ID TO APPROVE MODAL - PICKUP -->

<script>
$(document).ready(function(){
    $('#approveModal2').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let documentId = button.data('document-id'); 
        let approveLink = $('#approveLink');
        approveLink.attr('href', '/document/approve/' + documentId);
    });
});
</script>

<!-- PASS DOCUMENT_ID TO DELETE MODAL -->

<script>
$(document).ready(function(){
    $('#declineModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); 
        let documentId = button.data('document-id'); 
        let declineLink = $('#declineLink');
        declineLink.attr('href', '/document/decline/' + documentId);
    });
});
</script>

<!-- DOCUMENT PREVIEW SCRIPT -->

<script>
    $(document).ready(function() {
        $('#docInput').change(function(){
            let img = this.files[0];
            let reader = new FileReader();

            reader.onload = function(e){
                $('#docPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(img);
        });
    });
</script>

<!-- SWEETALERTS SCRIPT -->

@if(session('approve-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Document has been approved successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@elseif(session('decline-success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Document has been declined successfully.',
    showConfirmButton: false,
    timer: 2500,
    })
</script>

@endif

<!----- DATATABLES SCRIPT ----->

<script>
    $(document).ready(function() {
        $('#documentsTable').DataTable({
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