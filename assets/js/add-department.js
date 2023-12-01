    let correspondenceFormCount = 1;
    let relavantFormCount = 0;
    let isFormAdded = false;

    function toggleRelavantForm() {
        const addButton = document.getElementById("_relavant");

        if (!isFormAdded) {
            addRelavantForm();
            addButton.innerText = "-";
            addButton.className = "btn btn-danger ml-2";
            isFormAdded = true;
        } else {
            removeRelavantForm();
            addButton.innerText = "+";
            addButton.className = "btn btn-success ml-2";
            isFormAdded = false;
        }
    }

    function addRelavantForm() {
        relavantFormCount++;
        const additionalRelavantForms = document.getElementById("additionalRelavantForms");
        const relavantFormGroup = document.createElement("div");
        relavantFormGroup.className = "row";

        const relavantFormInput = `
        <div class="col-12">
        <p>Party of the First Part</p>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Name <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_name[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Position <span class="login-danger">*</span></label>
            <input type="email" class="form-control" name="relavant_position[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Agency <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_agency[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Address <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_address[]">
        </div>
    </div>
    <div class="col-12">
        <p>Party of the Second Part</p>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Name <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_name[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Position <span class="login-danger">*</span></label>
            <input type="email" class="form-control" name="relavant_position[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Agency <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_agency[]">
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label>Address <span class="login-danger">*</span></label>
            <input type="text" class="form-control" name="relavant_address[]">
        </div>
    </div>
        `;

        relavantFormGroup.innerHTML = relavantFormInput;
        additionalRelavantForms.appendChild(relavantFormGroup);
    }

    function removeRelavantForm() {
        const additionalRelavantForms = document.getElementById("additionalRelavantForms");
        additionalRelavantForms.innerHTML = ''; // Remove all added forms
    }

    function addCorrespondenceForm() {
        correspondenceFormCount++;

        const additionalCorrespondenceForms = document.getElementById("additionalCorrespondenceForms");

        const correspondenceFormGroup = document.createElement("div");
        correspondenceFormGroup.className = "row";

        const correspondenceFormInputs = `
            <div class="row">
                <div class="col-1" style="width:40px;">
                    <div class="col-12">
                        <button onclick="removeCorrespondenceForm(this)" class="btn btn-danger">-</button>
                    </div>
                </div>
                <div class="col-11">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group local-forms">
                                <label>Name <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="correspondence_name[]">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group local-forms">
                                <label>Telephone <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="correspondence_telephone[]">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group local-forms">
                                <label>Facsimile <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="correspondence_fax[]">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group local-forms">
                                <label>Address <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="correspondence_address[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        correspondenceFormGroup.innerHTML = correspondenceFormInputs;
        additionalCorrespondenceForms.appendChild(correspondenceFormGroup);
    }

    function removeCorrespondenceForm(button) {
        const formToRemove = button.parentNode.parentNode.parentNode;
        formToRemove.remove();
    }
