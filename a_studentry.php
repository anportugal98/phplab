        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="row">
            <div class="col-lg-3">
              <a href="<?= base_url('admin/studentry'); ?>" class="btn btn-light bg-gradient-light border btn-icon-split mb-4 rounded-0">
              </a>
            </div>
            <div class="col-lg-5 offset-lg-4">
              <?= $this->session->flashdata('message'); ?>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-10 p-0">
              <?= form_open_multipart('views/studentry/index.php'); ?>
              <div class="card rounded-0">
                <div class="card-body text-dark">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group row">
                        <label for="s_num" class="col-form-label col-lg-4">Student No.</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="s_num" id="s_num" autofocus>
                          <?= form_error('s_num', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="f_name" class="col-form-label col-lg-4">First Name</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="f_name" id="f_name">
                          <?= form_error('f_name', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="m_name" class="col-form-label col-lg-4">Middle Name</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="m_name" id="m_name">
                          <?= form_error('m_name', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="l_name" class="col-form-label col-lg-4">Last Name</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="l_name" id="l_name">
                          <?= form_error('l_name', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-form-label col-lg-4">CvSU Email</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="email" id="email">
                          <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group row">
                        <label for="c_num" class="col-form-label col-lg-4">Contact No.</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="c_num" id="c_num">
                          <?= form_error('c_num', '<small class="text-danger">', '</small>') ?>
                        </div>

                      </div>
                      <div class="form-group row">
                        <label for="college" class="col-form-label col-lg-4">College</label>
                        <div class="col p-0">
                          <select class="form-control" name="college" id="college">
                            <?php foreach ($shift as $sft) : ?>
                              <option value="<?= $sft['id'] ?>"><?= $sft['id'] . ' = ' . $sft['start'] . '-' . $sft['end']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="course" class="col-form-label col-lg-4">Course</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="course" id="course">
                          <?= form_error('course', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>

                      
                      <div class="form-group row">
                        <label for="section" class="col-form-label col-lg-4">Section</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="section" id="section">
                          <?= form_error('section', '<small class="text-danger">', '</small>') ?>
                        </div>
                      

                      </div>
                      <div class="form-group row">
                        <label for="Adviser" class="col-form-label col-lg-4">Adviser</label>
                        <div class="col p-0">
                          <input type="text" class="form-control col-lg" name="Adviser" id="Adviser">
                          <?= form_error('Adviser', '<small class="text-danger">', '</small>') ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success bg-gradient-success btn-icon-split mt-4 float-right rounded-0">
                    <span class="icon text-white">
                      <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Save</span>
                  </button>
                  <?= form_close(); ?>
                </div>
              </div>
              <?= form_close() ?>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <script>
          // Add the following code if you want the name of the file appear on select
          $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>