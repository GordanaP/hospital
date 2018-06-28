<form id="createAccountForm">
    <div class="modal-body">
        <p class="italic text-sm mb-4">
            Fields marked with <sup><i class="fa fa-asterisk text-red-dark"></i></sup> are required.
        </p>

        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div>Profile Information</div>
                <div class="text-muted small">This information is visible to the public.</div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    <!-- First name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <input type="text" class="form-control admin-modal-input first_name" id="first_name" name="first_name" placeholder="Enter first name" />

                            <span class="invalid-feedback first_name"></span>
                        </div>
                    </div>

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <input type="text" class="form-control admin-modal-input last_name" id="last_name" name="last_name" placeholder="Enter last name" />

                            <span class="invalid-feedback last_name"></span>
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <select name="title" id="title" class="form-control title admin-modal-input">
                                <option value="" >Select a title</option>

                                {{-- @foreach (ProfileTitles::all() as $title => $description)
                                    <option value="{{ $title }}">{{ $description }}</option>
                                @endforeach --}}
                            </select>

                            <span class="invalid-feedback title"></span>
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-box">
                            <label for="role_id">Role  <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>
                            <select class="role_id form-control req_place" name="role_id[]" id="role_id" multiple="multiple">
                                {{-- @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                    @endforeach --}}
                            </select>

                            <span class="invalid-feedback role_id"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-0 mb-0">

        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div>Access Credentials</div>
                <div class="text-muted small">The credentails will be sent to the user. The email address requires user verification.</div>
            </div>

            <div class="col-md-8">

                <!-- Email -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-Mail Address <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <input type="text" class="form-control email admin-modal-input"  id="email" name="email" placeholder="example@domain.com" />

                            <span class="invalid-feedback email"></span>
                        </div>
                    </div>
                {{-- </div> --}}

                <!-- Password-->
                {{-- <div class="row"> --}}
                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="create_password" class="mb-0">Password <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <input type="password" class="form-control password admin-modal-input" id="password" name="password" placeholder="Give password to the user" />

                            <span class="invalid-feedback password"></span>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input admin-modal-input" type="checkbox" name="create-password" id="auto_password" value="auto"  checked />
                            <label class="form-check-label" for="auto_password">
                                Auto generate password
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn bg-none" data-dismiss="modal" style="font-size: 16px">Close</button>
        <button type="button" class="btn btn-success btn-account" id="storeAccount"  style="font-size: 16px">Save</button>
    </div>
</form>


