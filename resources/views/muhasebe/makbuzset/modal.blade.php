
  @section('modal')
      <div class="modal fade" id="modalAdd">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Yeni Ayar Ekle</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="setadd" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="set_data" name="set_data" class="form-control">

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <select name="set_tur" class="form-control select2">
                                  <option value="">SEÇİNİZ</option>
                                  <option value="Ödeme Şekli">Ödeme Şekli</option>
                                  <option value="Kur">Kur</option>
                                  <option value="Ödeme Türü">Ödeme Türü</option>

                              </select>
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>

                          <div class="modal-footer justify-content-between">




                              <!-- /.col -->

                              <button type="button" class="btn btn-default bg-danger" data-dismiss="modal">İptal</button>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Kaydet') }}</button>

                              <!-- /.col -->



                          </div>

                      </form>
                  </div>

              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modalEdit">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Ayar Değiştir</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria- hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" id="setedit" action="#">
                          @csrf
                          <div class="input-group mb-3">
                              <input id="set_data" name="set_data" class="form-control">

                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-pen-to-square"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="input-group mb-3">
                              <select name="set_tur" id="set_parent" class="form-control select2">
                                  <option value="" selected>SEÇİNİZ</option>
                                  <option value="odemesekli">Ödeme Şekli</option>
                                  <option value="kur">Kur</option>
                                  <option value="odemeturu">Ödeme Türü</option>

                              </select>
                              <input type="hidden" name="set_tur" value="makbuz">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                  </div>
                              </div>
                          </div>
                          <input type="hidden" id="set_id" name="set_id" class="form-control">

                          <div class="modal-footer justify-content-between">




                              <!-- /.col -->

                              <button type="button" class="btn btn-default bg-danger" data-dismiss="modal">İptal</button>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Kaydet') }}</button>

                              <!-- /.col -->



                          </div>

                      </form>
                  </div>

              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  @endsection
