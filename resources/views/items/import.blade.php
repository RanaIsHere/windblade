<div id="importModal" class="modal">
    <div class="modal-box text-center">
        <p>Add items to modal</p>

        <form action="{{ route('import_item') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row m-4">
                <div class="flex-1">
                    <input type="file" name="file" class="input input-bordered p-1">
                </div>
            </div>
            <div class="flex flex-row m-4">
                <div class="flex-1">
                    <button type="submit" class="btn btn-primary btn-sm">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>
