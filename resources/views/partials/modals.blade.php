<div id="requestreg" class="modal">
    <div class="modal-box">
        <p>Are you sure that you want to request registration for an outlet? This will take up to several days through online channels, as an alternative, please visit our branch offices for quicker registration.</p> 

        <form action="/request-registration" method="post">
            <div class="form-control py-4">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="text" placeholder="email" class="input input-bordered">
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Request</button> 
                <button type="button" class="btn" onclick="document.getElementById('requestreg').classList.remove('modal-open')">Cancel</button>
            </div>
        </form>
    </div>
</div>