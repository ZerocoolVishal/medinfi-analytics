<!--Project Data-->
<div class="col-12">
    <div id="project_name" style="margin-bottom: 10px;">Project Name</div>
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

            <div>
                <ul class="nav nav-tabs d-flex">
                    <li class="nav-item">
                        <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Medinfi Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Facebook</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">Twitter</a>
                    </li>
                    <button class="btn btn-primary" id="btn_export" style="margin-left: 52%;" type="button">Export</button>
                </ul>

                <div class="tab-content">

                    <!--Medinfi Prject data-->
                    <div class="tab-pane show active" role="tabpanel" id="tab-1">
                        <h1 style="margin-top:20px;">Medinfi Blog</h1>

                        <!--Peoject Progress bar-->
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label">Medinfi Blog Progress</label>
                                <div class="progress">
                                    <div class="progress-bar" id="medinfi_blog_progress_bar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                                </div>
                            </div>
                        </div>

                        <!--Peoject Targets-->
                        <div class="row" style="margin-top:20px;">
                            <div class="col">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h4 class="card-title" id="medinfi_total">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Total Page View</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" id="medinfi_target">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Page View Target</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Project Search-->
                        <div class="row" style="margin-top:20px;">
                            <div class="col sm-12 md-3">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" id="searchInput" onkeyup="filterTable('myTable','searchInput')" placeholder="Blog name" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Preoject Data-->
                        <div class="row" style="margin-top:0px;">
                            <div class="col">

                                <div class="row">
                                    <div class="col-3">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab">
                                            <a class="nav-link active" id="mb-page-views-tab" data-toggle="pill" href="#mb-page-views">Page Views</a>
                                            <a class="nav-link" id="mb-banner-clicks-tab" data-toggle="pill" href="#mb-banner-clicks">Banner Clicks</a>
                                            <a class="nav-link" id="mb-online-sales-tab" data-toggle="pill" href="#mb-online-sales">Online Sales</a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="mb-page-views">
                                                <!--TODO: Table data goes here-->
                                                <!-- Page Views -->
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-sm" id="page-views-table">
                                                        
                                                        <thead></thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="mb-banner-clicks">
                                                <!--TODO: Table data goes here-->
                                                <!-- Banner Clicks -->
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-sm" id="banner-clicks-table">
                                                        
                                                        <thead></thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>    
                                            </div>

                                            <div class="tab-pane fade" id="mb-online-sales">
                                                <!--TODO: Table data goes here-->
                                                <!-- Online Sale -->
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-sm" id="online-sales-table">
                                                        
                                                        <thead></thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!--Facebook Project data-->
                    <div class="tab-pane" role="tabpanel" id="tab-2">
                        <h1 style="margin-top:20px;">Facebook</h1>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label">Facebook Progress</label>
                                <div class="progress">
                                    <div class="progress-bar" id="fb_progress_bar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h4 class="card-title" id="fb_achieved">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Facebook Target Achieved</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" id="fb_target">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Target</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col sm-12 md-3">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" placeholder="Post name" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Facebook Table-->
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab">
                                    <a class="nav-link active" id="fb-likes-shares-tab" data-toggle="pill" href="#fb-likes-shares">Likes & Shares</a>
                                    <a class="nav-link" id="fb-click-to-site-tab" data-toggle="pill" href="#fb-click-to-site">Click to Site</a>
                                    <a class="nav-link" id="fb-comments-tab" data-toggle="pill" href="#fb-comments">Comments</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="fb-likes-shares">

                                        <!--TODO : Table goes here-->
                                        likes and share
                                        <?php include "table.html" ?>

                                    </div>
                                    <div class="tab-pane fade" id="fb-click-to-site">

                                        <!--TODO : Table goes here-->
                                        click to site
                                        <?php include "table.html" ?>

                                    </div>

                                    <div class="tab-pane fade" id="fb-comments">

                                        <!--TODO : Table goes here-->
                                        comments
                                        <?php include "table.html" ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--Twitter Project data-->
                    <div class="tab-pane" role="tabpanel" id="tab-3">
                        <h1 style="margin-top:20px;">Twitter</h1>

                        <!--Twitter Progress bar-->
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label">Twitter Progress</label>
                                <div class="progress">
                                    <div class="progress-bar" id="tw_progress_bar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                                </div>
                            </div>
                        </div>

                        <!--Twitter Target-->
                        <div class="row" style="margin-top:20px;">
                            <div class="col">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h4 class="card-title" id="tw_achieved">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Twitter Target Achieved</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" id="tw_target">0</h4>
                                        <h6 class="text-muted card-subtitle mb-2">Target</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Twitter Search-->
                        <div class="row" style="margin-top:20px;">
                            <div class="col sm-12 md-3">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" placeholder="Post name" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Twitter data-->
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab">
                                    <a class="nav-link active" id="tw-impression-tab" data-toggle="pill" href="#tw-impression">Impression</a>
                                    <a class="nav-link" id="tw-retweets-tab" data-toggle="pill" href="#tw-retweets">Retweets</a>
                                    <a class="nav-link" id="tw-comments-tab" data-toggle="pill" href="#tw-comments">Comments</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="tw-impression">

                                        <!--TODO : Table goes here-->
                                        Impression
                                        <?php include "table.html" ?>

                                    </div>
                                    <div class="tab-pane fade" id="tw-retweets">

                                        <!--TODO : Table goes here-->
                                        Retweets
                                        <?php include "table.html" ?>

                                    </div>

                                    <div class="tab-pane fade" id="tw-comments">

                                        <!--TODO : Table goes here-->
                                        Comments
                                        <?php include "table.html" ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>