<div id="addModal" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Add items to modal</p>

        <form action="/data-usage/create" method="post">
            @csrf

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Barang</span>
                        </label>

                        <div class="input-group">
                            <input type="text" name="nama_barang" id="itemInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="status" id="statusInput" class="select select-sm select-bordered w-full"
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

                        <div class="flex-row">
                            <input type="text" name="nama_pemakai" id="userInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Waktu Pakai</span>
                        </label>

                        <div class="flex-row">
                            <input type="datetime-local" name="waktu_pakai" id="pakaiInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Waktu Beres</span>
                        </label>

                        <div class="input-group">
                            <input type="datetime-local" name="waktu_beres" id="beresInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Create</button>

            <button type="button" class="btn btn-primary my-10 mx-2" onclick="closeModal('addModal')">Cancel</button>
        </form>
    </div>
</div>
