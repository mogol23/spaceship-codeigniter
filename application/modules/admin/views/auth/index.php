<main id="content" class="content" role="main">
    <div class="row">
        <div class="col-lg-12">
            <section class="widget">
                <header>
                    <h4><?= $title ?></h4>
                    <div class="widget-controls">
                        <a title="Tambah Data" href="javascript:void(0)" class="bg-primary" onclick="create()"><i class="glyphicon glyphicon-plus text-white"></i></a>
                        <a data-widgster="fullscreen" title="Full Screen" href="javascript:void(0)"><i class="glyphicon glyphicon-fullscreen"></i></a>
                        <a data-widgster="restore" title="Restore" href="javascript:void(0)"><i class="glyphicon glyphicon-resize-small"></i></a>
                        <a data-widgster="expand" title="Expand" href="javascript:void(0)"><i class="la la-angle-up"></i></a>
                        <a data-widgster="collapse" title="Collapse" href="javascript:void(0)"><i class="la la-angle-down"></i></a>
                    </div>
                </header>
                <div class="widget-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th width="15px">#</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th width="150px"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" id="modal_crud" tabindex="-1" role="dialog" aria-labelledby="modal_crud_label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="form_crud" role="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_crud_label">Data Baru</h5>
                        <button type="button" class="close" onclick="close_crud()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-gray-lighter">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-no-border"
                                           placeholder="Nama Depan" name="first_name" id="first_name" required="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-no-border"
                                           placeholder="Nama Belakang" name="last_name" id="last_name" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control input-no-border"
                                           placeholder="Email" name="email" id="email" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control input-no-border"
                                           placeholder="Telepon" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control input-no-border"
                                           placeholder="Perusahaan" name="company" id="company">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="password" class="form-control input-no-border"
                                           placeholder="Kata Sandi" name="password" id="password" required="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="password" class="form-control input-no-border"
                                           placeholder="Konfirmasi Kata Sandi" name="password_confirm" id="password_confirm" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-action">
                        <button type="button" class="btn btn-gray" onclick="close_crud()">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
