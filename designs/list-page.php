<?php include 'includes/header.php';?>

<main>
    <?php include 'includes/menu.php';?>

    <div class="right-main">
        <?php include 'includes/topBar.php';?>

        <div class="main-wrapper">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                    <h4>User List</h4>
                </div>
                <div class="col-md-4 page-head-right text-end">
                    <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
                </div>
            </div>

            <div class="filter-div">

                <div class="row">
                    <h6>Filter</h6>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Keyword Search" aria-label="First name">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="filter-action-btn text-end">
                        <button type="button" class="btn btn-secondary">Reset</button>
                        <button type="button" class="btn btn-primary">Filter</button>

                    </div>

                </div>

            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td scope="row">3</td>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-4 gy-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">xxx</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="custom-btn save primary-btn">Save</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';?>
