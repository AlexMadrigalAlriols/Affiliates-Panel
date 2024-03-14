<form action="">
    <div class="row">
        <h6>General Settings</h6>

        <div class="col-12 text-center">
            <img src="{{asset('img/NotFound.png')}}" alt="" class="rounded-circle border border-dark" width="100px"><br>
            <button class="btn btn-primary mt-3 mb-2"><i class='bx bx-image' ></i> Change Photo</button>
        </div>

        <hr>
        <div class="col-6 mb-3">
            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
        </div>

        <div class="col-12 mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" disabled class="form-control" id="name" value="{{ $user->email }}">
        </div>

        <div class="col-12 mb-3">
            <label for="name" class="form-label">Phone</label>
            <input type="text" class="form-control" id="name" value="{{ $user->phone }}">
        </div>

        <hr>
        <div class="col-12 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Current Password">
        </div>
    </div>

    <button class="btn btn-success w-100 mt-3" disabled><i class='bx bx-save' ></i> Save Settings</button>
</form>
