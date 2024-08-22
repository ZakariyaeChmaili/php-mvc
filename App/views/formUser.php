<?php

View::includeView("nav") ?>

<?php View::start() ?>
<div class="row mt-5 justify-content-center align-items-center">
    <div class="col col-4">
        <div class="container">
            <div class="card">
                <form method="post" action="<?php
                if (isset($userToUpdate) ?? $userToUpdate->getId())
                    echo ROOT_URL . "user/update";
                else echo ROOT_URL . "user/save";

                ?>">
                    <div class="card-body">
                        <input type="text" value="<?= isset($userToUpdate) ? $userToUpdate->getId() : ''  ?>" hidden name="id"
                               class="form-control" id="id">

                        <div class="mb-3">
                            <label for="firstName" class="form-label">first name</label>
                            <input required type="text" value="<?= isset($userToUpdate) ? $userToUpdate->getFirstName() : ''  ?>"
                                   name="firstName" class="form-control" id="firstName">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">last name</label>
                            <input required type="text" value="<?= isset($userToUpdate) ? $userToUpdate->getLastName() : ''  ?>" name="lastName"
                                   class="form-control" id="lastName">
                        </div>
                        <div class="col-2 mb-3">
                            <label for="age" class="form-label">age</label>
                            <input required type="number" value="<?= isset($userToUpdate) ? $userToUpdate->getAge() : ''  ?>" name="age"
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

<?php View::end() ?>
