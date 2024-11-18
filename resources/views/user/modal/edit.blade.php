<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalEdit" tabindex="-1" role="dialog"
    aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content large-shadow">
            {{-- Modal header --}}
            <div class="modal-header" style="border-bottom: none !important; padding: 1rem 2rem 0rem 2rem !important">
                <div class="modal-title" id="exampleModalLabel">Edit Data</div>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri ri-close-line"></i>
                </button>
            </div>

            {{-- Modal body --}}
            <form action="" method="POST" id="formEdit">
                @csrf
                @method('PUT')
                <div class="modal-body"
                    style="display: flex; flex-direction:column; justify-content:space-between; display: flex; flex-direction: column; row-gap: 1em">
                    <input type="hidden" id="cekForRole" name="cekRole" value="">


                    <div class="form-group col-12">
                        <label class="labelText mb-1" for="name">Nama</label>
                        <input value="{{ old('name') }}" name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama" required>

                        @error('name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="col-12" id="roleEdit-select">
                        <label for="role">Pilih Role</label>
                        <select class="form-select" name="role" id="roleEdit">
                            @can('superAdmin')
                            <option value="Super Admin" {{ old('role')=='Super Admin' ? 'selected' : '' }}>Super
                                Admin</option>
                            <option value="Operator Bidang" {{ old('role')=='Operator Bidang' ? 'selected' : '' }}>
                                Operator Bidang</option>
                            @else
                            <option value="Operator Bidang" {{ old('role')=='Operator Bidang' ? 'selected' : '' }}>
                                Operator Bidang</option>
                            @endcan
                            @error('role')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="" id="instansiEdit-select" style="display: none">
                        <label for="bidang_id" class="labelText mb-1" id="labelText">Pilih Bidang</label>
                        <select class="form-select" name="bidang_id">
                            @can('superAdmin')
                            @foreach ($dataBidangs as $item)
                            <option value="{{ $item->id }}" {{ old('bidang_id')==$item->id ? 'selected' : ''
                                }}>{{ $item->name }}</option>
                            @endforeach
                            @else
                            <option value="{{ Auth::user()->bidang_id }}" class="d-none"></option>
                            @endcan
                            @error('bidang_id')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label class="labelText mb-1" for="username">Username</label>
                        <input value="{{ old('username') }}" name="username" type="text"
                            class="form-control {{ $errors->has('username') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Username" required>

                        @error('username')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label class="labelText mb-1" for="nohp">nohp</label>
                        <input value="{{ old('nohp') }}" name="nohp" type="text"
                            class="form-control {{ $errors->has('nohp') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan nohp" required>

                        @error('nohp')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label class="labelText mb-1" for="password">password</label>
                        <input value="{{ old('password') }}" name="password" type="password"
                            class="form-control {{ $errors->has('password') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan password">

                        @error('password')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex mt-1" style="justify-content: space-between">
                        <button class="btn btn-danger"
                            style="background-color: #F3F4F7 !important; border: none !important" type="button"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" id="btnInput">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @can('superAdmin')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const roleSelect = document.getElementById("roleEdit");
            roleSelect.addEventListener('change', () => {
                toggleInstansiDisplay(roleSelect.value);
            });
        });

        const toggleInstansiDisplay = (param) => {
            const instansiEditSelect = document.getElementById("instansiEdit-select");
            instansiEditSelect.style.display = (param === "Operator Bidang") ? 'block' : 'none';
        };

        const cekRole = (param) => {
            console.log(param);

            toggleInstansiDisplay(param);
        };

    </script>
    @endcan
