<div id="deleteModal" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Add items to modal</p>

        <form action="/items/destroy" method="post">
            @csrf

            <input type="hidden" name="id" id="deleteIdInput">

            <div class="flex flex-row">
                <div class="flex-1">
                    <p>Are you sure you want to delete this item?</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Delete Item</button>

            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('addModal').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>
