<div class="modal fade" id="modal-crud-user" tabindex="-1" role="dialog" aria-labelledby="modal-crud-userLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-crud-userTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-crud-userBody">
                <form action="#" id="modal-crud-userForm" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Nama pengguna" value="{{ old('name', 'sadsdasdas') }}" name="name">

                                @error('name')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Email pengguna" value="{{ old('email') }}"
                                    name="email">

                                @error('email')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                    @php
                                        $roles = ['admin', 'user'];
                                    @endphp
                                    <option value="" selected>---Role---</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" @if (old('role') == $role) selected @endif>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
    
                                @error('role')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" id="groupFormPassword">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="password">Katasandi</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Katasandi pengguna" name="password">

                                @error('password')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="confirmation_password">Konfirmasi katasandi</label>
                                <input type="password" class="form-control @error('confirmation_password') is-invalid @enderror"
                                    id="confirmation_password" placeholder="Konfirmasi katasandi pengguna"
                                    name="confirmation_password">

                                @error('confirmation_password')
                                    <div class="d-block invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                            id="avatar" placeholder="Avatar pengguna"
                            name="avatar">

                        @error('avatar')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="modal-crud-userSubmitBtn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>