<?php include 'includes/header.php';?>

<main>
    
    <?php include 'includes/menu.php';?>


    <div class="right-main">
        <?php include 'includes/topBar.php';?>

        <div class="main-wrapper client-detaiils">
            <div class="row page-head">
                <div class="col-md-8 page-name">
                    <h4>Client Details</h4>
                </div>

            </div>

            <div class="row wrapper">
                <div class="col-lg-3 basic-info">
                    <img src="public/images/logo.png" class="logo img-fluid">
                    <h6>Skyislimit Technologies</h6>
                    <div class="colum-row">
                        Phone
                        <span>+919898665596</span>
                    </div>

                    <div class="colum-row">
                        Email
                        <span>jijith@salesfokuz.in</span>
                    </div>

                    <div class="colum-row">
                        Created on
                        <span>10 May 2021 3:42PM</span>
                    </div>


                </div>
                <div class="col-lg-9 tab-section">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Quatation</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Invoice</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">History</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-licence" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">licence</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <div class="col text-end mt-15 mb-15">
                                <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#generateQuotation">Generate Quotation</button>
                            </div>
                            <table class="table table-striped table-hover mt-15">
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
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><table class="table table-striped table-hover mt-15">
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
                            </table></div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><table class="table table-striped table-hover mt-15">
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
                            </table></div>
                   
                    <div class="tab-pane fade show active" id="nav-licence" role="tabpanel" aria-labelledby="nav-home-tab">

                            <div class="col text-end mt-15 mb-15">
                                <button type="button" class="primary-btn custom-btn add" data-bs-toggle="modal" data-bs-target="#generateQuotation">licence generate</button>
                            </div>
                            <table class="table table-striped table-hover mt-15">
                            <thead>
                    <tr>
                        
                        
                        <th scope="col">previous licence</th>
                        <th scope="col">current licence</th>
                        <th scope="col">name</th>
                        <th scope="col">current date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                        <td>{{$value->previous_licence}}</td>
                        <td>{{$value->current_licence}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->current_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
                            </table>
                        </div>
                     </div>
                </div>

            </div>

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="generateQuotation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Quatation</h5>
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
