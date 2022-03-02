<div id="importModal" class="modal">
    <div class="modal-box w-6/12 text-center">

        <form action="{{ route('import_members') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-control">
                <input type="file" name="file" id="file-import" class="m-4 input input-bordered" required>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Import</button>
                <button type="button" class="btn btn-primary"
                    onclick="this.parentElement.parentElement.parentElement.parentElement.classList.remove('modal-open')">Cancel</button>
            </div>
        </form>
    </div>
</div>
