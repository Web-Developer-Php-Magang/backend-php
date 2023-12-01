<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Add Departments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>admin/department">Department</a></li>
                            <li class="breadcrumb-item active">Add Departments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="<?= BASE_URL ?>controllers/mahasiswa/department.php">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Basic Details</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Department Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="name_mitra">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Department Type <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="type_mitra">
                                            <option value="magang">Magang</option>
                                            <option value="magang penelitian">Magang Penelitian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Cooperation date <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" placeholder="DD-MM-YYYY" name="coorperate_date">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Department Lecture <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="lecutre_mitra">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload MOU (Optional)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input type="file" name="mou">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload Image Department</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input type="file" name="image">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5 d-flex align-items-center">
                                    <h5 class="form-title">
                                        <a onclick="toggleRelavantForm()" id="_relavant" class="btn btn-success ml-2" id="_relavant">+</a>
                                        <span>Relavant Party (Optional)</span>
                                    </h5>
                                </div>
                                <div id="additionalRelavantForms"></div>
                                <div class="col-12 d-flex align-items-center">
                                    <h5 class="form-title">
                                        <a onclick="addCorrespondenceForm()" class="btn btn-success ml-2">+</a>
                                        <span>Correspondence (Optional)</span>
                                    </h5>
                                </div>
                                <div id="additionalCorrespondenceForms">
                                    <!-- Form inputs untuk korespondensi akan ditambahkan di sini -->
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>