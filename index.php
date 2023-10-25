<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex w-100 align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
      <a href="<?= base_url('master/a_employee'); ?>" class="btn btn-primary btn-sm bg-gradient-primary rounded-0 btn-icon-split mb-0">
        <span class="icon text-white-600">
          <i class="fas fa-plus-circle"></i>
        </span>
        <span class="text">Add New Employee</span>
      </a>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-12 cols-md-12 col-sm-12">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>

  <!-- Data Table employee-->
  <div class="card rounded-0 shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">DataTables Employee</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <style>
          .inactive-row {
            background-color: darkred;
            color: #ffffff;
          }
          .activate-button {
            background-color: #4e73df;
            border-color: #4e73df;
          }
          .activate-button:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
          }
          .activate-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.5);
          }
        </style>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <colgroup>
            <col width="5%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
          </colgroup>
          <thead>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Shift</th>
              <th>Gender</th>
              <th>DOB</th>
              <th>Hire Date</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $i = 1;
            foreach ($employee as $emp) :
              $rowClass = $emp['Activate'] == 0 ? 'inactive-row' : '';
              if ($emp['shift_id'] == 0) {
                continue;
              }
            ?>
              <tr class="<?= $rowClass ?>">
                <td class=" align-middle"><?= $i++; ?></td>
                <td class=" align-middle"><?= $emp['id']; ?></td>
                <td class="textcenter"><img src="<?= base_url('images/pp/') . $emp['image']; ?>" style="width: 3em; height:3em;object-fit:cover;object-position:center center; border-width: 3px !important;" class="img-rounded border rounded-circle"></td>
                <td class=" align-middle"><?= $emp['name']; ?></td>
                <td class=" align-middle text-xs text-center"><?= date("h:i A", strtotime('2022-06-23 '.$emp['start'])) ?> - <?= date("h:i A", strtotime('2022-06-23 '.$emp['end'])) ?></td>
                <td class=" align-middle"><?php if ($emp['gender'] == 'M') {
                                            echo 'Male';
                                          } else {
                                            echo 'Female';
                                          }; ?></td>
                <td class=" align-middle"><?= date("M d, Y", strtotime($emp['birth_date'])); ?></td>
                <td class=" align-middle"><?= date("M d, Y", strtotime($emp['hire_date'])); ?></td>
                <td class="text-center align-middle">
                  <a href="<?= base_url('master/e_employee/') . $emp['id'] ?>" class="btn btn-primary rounded-0 btn-sm text-xs">
                    <span class="icon text-white" title="Edit">
                      <i class="fas fa-edit"></i>
                    </span>
                  </a> |
                  <a href="<?= base_url('master/d_employee/') . $emp['id'] ?>" class="btn btn-danger rounded-0 btn-sm text-xs" onclick="return confirm('Deleted employee will be lost forever. Still want to delete?')">
                    <span class="icon text-white" title="Delete">
                      <i class="fas fa-trash-alt"></i>
                    </span>
                  </a> |
                  <?php if ($emp['Activate'] == 0) { ?>
                    <a href="<?= base_url('master/act_employee/') . $emp['id'] ?>" class="btn btn-success btn-sm rounded-0 activate-button" onclick="return confirm('Are you sure you want to activate this employee?')">
                      <span class="icon text-white" title="Activate">
                        <i class="fa fa-check"></i>
                      </span>
                    </a>
                  <?php } else { ?>
                    <a href="<?= base_url('master/deact_employee/') . $emp['id'] ?>" class="btn btn-secondary btn-sm rounded-0" onclick="return confirm('Are you sure you want to deactivate this employee?')">
                      <span class="icon text-white" title="Deactivate">
                        <i class="fa fa-exclamation-circle"></i>
                      </span>
                    </a>
                  <?php } ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

