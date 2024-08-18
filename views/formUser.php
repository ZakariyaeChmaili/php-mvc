<?php $this->includeView("nav") ?>

<?php $this->start() ?>
<div class="row mt-5 justify-content-center align-items-center">
    <div class="col col-4">
        <div class="container">
            <div class="card">
                <form method="post" action="<?php
                if (isset($data['userToUpdate']) ?? $data['userToUpdate']->getId())
                    echo ROOT_URL . "user/update";
                else echo ROOT_URL . "user/save";

                ?>">
                    <div class="card-body">
                        <input type="text" value="<?= isset($data['userToUpdate']) ? $data['userToUpdate']->getId() : ''  ?>" hidden name="id"
                               class="form-control" id="id">

                        <div class="mb-3">
                            <label for="firstName" class="form-label">first name</label>
                            <input required type="text" value="<?= isset($data['userToUpdate']) ? $data['userToUpdate']->getFirstName() : ''  ?>"
                                   name="firstName" class="form-control" id="firstName">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">last name</label>
                            <input required type="text" value="<?= isset($data['userToUpdate']) ? $data['userToUpdate']->getLastName() : ''  ?>" name="lastName"
                                   class="form-control" id="lastName">
                        </div>
                        <div class="col-2 mb-3">
                            <label for="age" class="form-label">age</label>
                            <input required type="number" value="<?= isset($data['userToUpdate']) ? $data['userToUpdate']->getAge() : ''  ?>" name="age"
                                   class="form-control" id="age">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-4">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end() ?>
