<div id="editModal" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Edit existing items</p>

        <form action="/data-usage/update" method="post">
            @csrf

            <input type="hidden" name="id" id="idInput">

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Barang</span>
                        </label>

                        <div class="flex">
                            <input type="text" name="nama_barang" id="itemEditInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="status" id="statusEditInput" class="select select-sm select-bordered w-full"
                                required>
                                <option disabled selected>Pick status</option>
                                <option value="SELESAI">Selesai</option>
                                <option value="BELUM_SELESAI">Belum Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Pemakai</span>
                        </label>

                        <div class="flex">
                            <input type="text" name="nama_pemakai" id="userEditInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Waktu Pakai</span>
                        </label>

                        <div class="flex">
                            <input type="datetime-local" name="waktu_pakai" id="pakaiEditInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Waktu Beres</span>
                        </label>

                        <div class="input-group">
                            <input type="datetime-local" name="waktu_beres" id="beresEditInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary my-10 mx-2">Edit</button>

            <button type="button" class="btn btn-primary my-10 mx-2" onclick="closeModal('editModal')">Cancel</button>
        </form>
    </div>
</div>
