<?php

session_start();
$dsn = "mysql:dbname=user_app_demo;host=localhost";
$username = "root";
$password = "";

$conn = new PDO($dsn, $username, $password);

$prepare = $conn->prepare("select * from users");
$prepare->execute();
$users = $prepare->fetchAll();
echo $_SESSION["userToUpdate"]['first_name'];
if (array_key_exists("userToUpdate", $_SESSION)) {
    echo "inside userToUpdate";
    $userToUpdate = $_SESSION["userToUpdate"];
    echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('inside if')
    let user = {
        firstName:'{$userToUpdate["first_name"]}',
        lastName:'{$userToUpdate["last_name"]}',
        age:'{$userToUpdate["age"]}',
        id:'{$userToUpdate["id"]}'
    }
    
    updateModal(user);
   
        
        
        
    });</script>";
}

?>

<a href="test">test</a>
<div class="container">
    <div class="row">
        <div class="col text-end ">
            <button id="userModalButton" type="button" class="btn btn-primary" onclick="addModal()">
                Add
            </button>
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
                <?php foreach ($users as $key => $value) { ?>
                    <tr>
                        <th><?= $value['id'] ?></th>
                        <td><?= $value['first_name'] ?></td>
                        <td><?= $value['last_name'] ?></td>
                        <td><?= $value['age'] ?></td>
                        <td>

                            <div class="row">
                                <div class="col col-auto">
                                    <a href="<?= ROOT_URL . "/template/process?id={$value['id']}&method=delete" ?>"
                                       class="btn btn-danger">delete</a>
                                </div>
                                <div class="col col-auto">
                                    <a href="<?= ROOT_URL . "/template/process?id={$value['id']}&method=get" ?>"
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


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php
             $method =isset($_SESSION['userToUpdate']) ? "put" : "post";
             echo ROOT_URL . "/template/process?method=".$method;


             ?>">
                <div class="modal-body">
                    <input type="text" hidden name="id" class="form-control" id="id">

                    <div class="mb-3">
                        <label for="firstName" class="form-label">first name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">last name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName">
                    </div>
                    <div class="col-2 mb-3">
                        <label for="age" class="form-label">age</label>
                        <input type="number" name="age" class="form-control" id="age">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php


    echo "<script>
    
        function updateModal(user){
            console.log('inside updateModal');
            console.log(user);
                let firstName = document.getElementById('firstName');
                let lastName = document.getElementById('lastName');
                let age = document.getElementById('age');
                let id = document.getElementById('id'); 
                if(user){
                                firstName.setAttribute('value', user.firstName);
                lastName.setAttribute('value', user.lastName);
                age.setAttribute('value', user.age);
                id.setAttribute('value', user.id);
                }
                let userModal = document.querySelector('#userModal');
    
                const bootstrapModal = new bootstrap.Modal(userModal);
                bootstrapModal.toggle();
        }
        
        function addModal(){
                let userModal = document.querySelector('#userModal');
    
                const bootstrapModal = new bootstrap.Modal(userModal);
        bootstrapModal.toggle();
        }
    </script>";