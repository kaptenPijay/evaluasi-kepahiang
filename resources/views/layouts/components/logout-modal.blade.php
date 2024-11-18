<!-- Modal -->
<div class="modal fade" id="ModalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
          <i class="ri ri-close-line"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <div class="body_text_dialog">
            Apakah kamu ingin keluar dari logout dari aplikasi ?
          </div>
      </div>
      <div class="modal-footer">
        <div class="row w-100">
          <div class="col-md-12 justify-content-end d-flex button_dialog">
            <button type="button" class="btn small-shadow secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn small-shadow danger">
              Logout
            </button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>