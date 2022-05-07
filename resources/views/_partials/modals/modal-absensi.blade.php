<!-- Modal -->
<div class="modal fade" id="modalAbsensi" tabindex="-1" role="dialog" aria-labelledby="modalAbsensiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mx-0">
                        <div class="col-12">
                            <video class="modal-camera" id="preview" width="100%"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<form action="{{ route('absensi.store') }}" id="form-absen-qr" class="d-none" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="jadwal" id="jadwal" value="">
    <input type="hidden" name="siswa_id" id="siswa_id" value="">
    <input type="hidden" name="keterangan" id="keterangan" value="">
</form>