<?php $this->includeView("nav") ?>




<?php $this->start("body"); ?>

<?php //dd($data)  ?>

<div class="container">
    <div class="row">
        <div class="col text-end ">
            <a id="userModalButton" type="button" class="btn btn-primary">
                Add
            </a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">first name</th>
                    <th scope="col">last name</th>
                    <th scope="col">age</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data["users"] as $user) { ?>
                    <tr>
                        <td><?=$user->getId()?></td>
                        <td><?=$user->getFirstName()?></td>
                        <td><?=$user->getLastName()?></td>
                        <td><?=$user->getAge()?></td>
                        <td>
                            <div class="row">
                                <div class="col col-auto">
                                    <a href=""
                                       class="btn btn-danger">delete</a>
                                </div>
                                <div class="col col-auto">
                                    <a href=""
                                       class="btn btn-info" onclick="updateModal()">update</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->end("body"); ?>
