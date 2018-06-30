<form id="editAccountForm">
    <div class="modal-body">
        <p class="italic text-sm mb-4">
            Fields marked with <sup><i class="fa fa-asterisk text-red-dark"></i></sup> are required.
        </p>

        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="uppercase tracking-wide font-medium">Profile Information</div>
                <div class="text-muted text-xs">This information is visible to the public.</div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    <!-- First name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName" class="font-medium">First name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="right" title="max 30 chars; only letters, numbers & spaces"></i></label>

                            <input type="text" class="form-control admin-modal-input first_name" id="firstName" name="first_name" placeholder="Enter first name" />

                            <span class="invalid-feedback first_name"></span>
                        </div>
                    </div>

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName" class="font-medium">Last name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup>  <i class="icon icon-question" data-toggle="tooltip" data-placement="right" title="max 30 chars; only letters, numbers & spaces"></i></label>

                            <input type="text" class="form-control admin-modal-input last_name" id="lastName" name="last_name" placeholder="Enter last name" />

                            <span class="invalid-feedback last_name"></span>
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="font-medium">Title <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>

                            <select name="title" id="profileTitle" class="form-control title admin-modal-input">
                                <option value="" >Select a title</option>

                                @foreach (ProfileTitle::all() as $title => $description)
                                    <option value="{{ $title }}">{{ $description }}</option>
                                @endforeach
                            </select>

                            <span class="invalid-feedback title"></span>
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-box">
                            <label for="roleId" class="font-medium">Role  <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup></label>
                            <select class="role_id form-control req_place" name="role_id[]" id="roleId" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
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
                <div class="uppercase tracking-wide font-medium">Access Credentials</div>
                <div class="text-muted text-xs">The credentails will be sent to the user. The email address requires user verification.</div>
            </div>

            <div class="col-md-8">
                <!-- Email -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="font-medium">E-Mail Address <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="right" title="max 100 chars; email format; unique"></i></label>

                            <input type="text" class="form-control email admin-modal-input"  id="profileEmail" name="email" placeholder="example@domain.com" />

                            <span class="invalid-feedback email"></span>
                        </div>
                    </div>
                </div>

                <!-- Password-->
                <div class="row">

                    <!-- Checkbox -->
                    <div class="col-md-6">
                        <label for="createPassword" class="mb-0 font-medium">Password <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="right" title="min 6 chars when creating manually"></i></label>
                        <div class="form-group mt-2" id="check-password">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="createPassword" id="unchangedPassword" value="unchanged" checked />
                                <label class="form-check-label" for="unchangedPassword">
                                    Do not change password
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="createPassword" id="autoPassword" value="auto" />
                                <label class="form-check-label" for="autoPassword">
                                    Auto generate password
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="createPassword" id="manualPassword" value="manual" />
                                <label class="form-check-label" for="manualPassword">
                                    Create password for the user
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden password -->
                    <div class="col-md-6">
                        <div class="form-group" id="hiddenPassword">
                            <label for=""></label>
                            <input type="password" class="form-control password admin-modal-input" id="profilePassword" name="password" placeholder="Give password to the user" />

                            <span class="invalid-feedback password"></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn bg-none admin-modal-button" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-account admin-modal-button" id="updateAccount">Save</button>
    </div>
</form>