<div id="deleteModal" class="modal">
    <div class="modal-box text-center">
        <form action="/items/destroy" method="post">
            @csrf

            <input type="hidden" name="id" id="deleteIdInput">

            <div class="flex flex-row">
                <div class="flex-1">
                    <p class="text-lg font-bold">Are you sure you want to delete this item?</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Delete Item</button>

            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('deleteModal').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>
