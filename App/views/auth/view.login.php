<?php $this->start("body");?>

<div class="row justify-content-center align-items-center h-100">
    <div class="col col-4">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="h2">Sign-in</div>
                </div>
                <form method="post" action="<?=ROOT_URL . "auth/authenticate"?>">
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <input required type="text" name="username" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input required type="text"  name="password" class="form-control" id="password">
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

<?php $this->end("body");?>
