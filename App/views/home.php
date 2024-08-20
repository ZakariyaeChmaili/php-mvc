<?php

View::start("body"); ?>
<div style="height: 100vh" class="d-flex align-items-center h-100 border">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col col-4">
                <div class="alert alert-primary text-center">
                    <div class="fs-1">Welcome</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-3">
                <div class="card shadow shadow-lg border border-2 border-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-center gap-5">
                                <a href="<?=ROOT_URL."user"?>" class="btn btn-outline-primary">
                                    Users
                                </a>
                                <a class="btn btn-outline-primary">
                                    Other
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php View::end("body"); ?>
