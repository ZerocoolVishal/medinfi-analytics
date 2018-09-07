    <div class="container">
        <div id="display_message"></div>
        <div class="row" style="margin-top:20px;">
            <div class="col">
                <div class="modal fade" role="dialog" tabindex="-1" id="client">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Client</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <form>
                                            <div class="form-row" style="margin-bottom:20px;">
                                                <div class="col"><label class="col-form-label">Client Name</label><input class="form-control" id="client-name" type="text"></div>
                                                <div class="col"><label class="col-form-label">Brand Name</label><input class="form-control" id="client-brand-name" type="text"></div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6 offset-lg-0"><label class="col-form-label">Company</label><select class="form-control" id="company-select"><option value="" disabled selected>Select a company</option></select></div>
                                                <div
                                                    class="col"><label class="col-form-label">Client ID</label><div class="input-group mb-3">
  <input type="text" id="client-id" class="form-control" placeholder="Client ID" aria-label="Client ID" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Check</button>
  </div>
</div></div>
                                    </div>
                                    <div class="form-row" style="margin-bottom:20px;">
                                        <div class="col"><label class="col-form-label">Email</label><input class="form-control" id="client-email" type="text" inputmode="email"></div>
                                        <div class="col"><label class="col-form-label">Mobile</label><input class="form-control" id="client-mobile" type="text" maxlength="10" minlength="10" inputmode="numeric"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-6"><label class="col-form-label">Password</label><div class="input-group mb-3">
  <input type="text" class="form-control" id="client-password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Check</button>
  </div>
</div></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col"><button class="btn btn-primary" id="add-client-btn" type="button">Add</button></div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="company">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Company</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <div class="form-row">
                                            <div class="col"><label class="col-form-label">Company Name</label><input  id="company-name" class="form-control" type="text"></div>
                                            <div class="col"><label class="col-form-label">Contact Person</label><input  id="company-contact-person" class="form-control" type="text"></div>
                                        </div>
                                        <div class="form-row" style="margin-bottom:20px;">
                                            <div class="col"><label class="col-form-label">Email</label><input class="form-control"  id="company-email" type="email" inputmode="email"></div>
                                            <div class="col"><label class="col-form-label">Mobile</label><input class="form-control" id="company-mobile" type="text" maxlength="10" minlength="10" inputmode="numeric"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><button class="btn btn-primary" id="add-company-btn" type="button">Add</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="acm">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Account Manager</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <form>
                                        <div class="form-row">
                                            <div class="col"><label class="col-form-label">Name</label><input class="form-control" id="acm-name" type="text"></div>
                                            <div class="col"><label class="col-form-label">Password</label><input class="form-control" id="acm-password" type="text"></div>
                                        </div>
                                        <div class="form-row" style="margin-bottom:20px;">
                                            <div class="col"><label class="col-form-label">Email</label><input class="form-control" id="acm-email" type="email"></div>
                                            <div class="col"><label class="col-form-label">Mobile</label><input class="form-control" id="acm-mobile" type="text" maxlength="10" minlength="10" inputmode="numeric"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><button class="btn btn-primary" id="add-acm-btn" type="button">Add</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
            <div class="btn-group" role="group"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#company" style="margin-right:3px;">Add Company</button><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#client" style="margin-right:3px;">Add Client</button>
                <button
                    class="btn btn-primary" type="button" data-toggle="modal" data-target="#acm">Add Account Manager</button>
            </div>
        </div>
    </div>
    <hr>
    <h1>Create Project</h1>
    <div class="row">
        <div class="col">
            <form>
                <div class="form-row">
                    <div class="col">
                        <div>
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="pill" href="#tab-5">Medinfi blog</a></li>
                                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="pill" href="#tab-6">Facebook</a></li>
                                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="pill" href="#tab-7">Twitter</a></li>
                                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="pill" href="#tab-8">Project</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="tab-5">
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col-4"><label class="col-form-label">Page View Target</label><input class="form-control" id="blog_pageview_target" type="number"></div>
                                        <div class="col-4"><label class="col-form-label">Banner Clicks Target</label><input class="form-control" id="blog_bannerclicks_target" type="number"></div>
                                        <div class="col-4"><label class="col-form-label">Online Sales Target</label><input class="form-control" id="blog_online_sale_target" type="number"></div>
                                    </div>
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><button class="btn btn-outline-primary btn-sm" type="button" data-toggle="pill" href="#tab-6" role="tab">Next</button></div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab-6">
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><label class="col-form-label">Likes &amp; Shares Target</label><input class="form-control" id="fb_likes_share_target" type="number"></div>
                                        <div class="col"><label class="col-form-label">Clicks To Site Target</label><input class="form-control" id="fb_click_target" type="number"></div>
                                        <div class="col"><label class="col-form-label">Comments Target</label><input class="form-control" id="fb_comments_target" type="number"></div>
                                    </div>
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><button class="btn btn-outline-primary btn-sm" type="button" data-toggle="pill" href="#tab-6" role="tab">Next</button></div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab-7">
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><label class="col-form-label">Impression Target</label><input class="form-control" id="tw_impression_target" type="number"></div>
                                        <div class="col"><label class="col-form-label">Retweets Target</label><input class="form-control" id="tw_retweets_target" type="number"></div>
                                        <div class="col"><label class="col-form-label">Comments Target</label><input class="form-control" id="tw_comments_target" type="number"></div>
                                    </div>
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><button class="btn btn-outline-primary btn-sm" type="button" data-toggle="pill" href="#tab-6" role="tab">Next</button></div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab-8">
                                    <div class="form-row" style="margin-top:20px;">
                                        <div class="col"><label class="col-form-label">Client</label><div class="input-group">
                                            <select class="custom-select" id="client-select">
                                                <option selected disabled>Select a client...</option>
                                            </select>
                                        </div></div>
                                        <div class="col"><label class="col-form-label">Project Name</label><input class="form-control" id="project_name" type="text"></div>
                                        <div class="col"><label class="col-form-label">Account Manager</label>
                                        <select class="form-control" id="acm-select">                                        
                                            <option selected disabled>Select an account manager</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col"><label class="col-form-label">Duration (no. of weeks)</label><input class="form-control" id="duration" type="number"></div>
                                        <div class="col"><label class="col-form-label">Launch date</label><input class="form-control" id="launchDate" type="date"></div>
                                    </div>
                                    <div class="form-row" style="margin-top:20px;margin-bottom:20px;">
                                        <div class="col">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#project-prev" style="margin-right:3px;">Preview</button>
                                            <button class="btn btn-primary" id="add-project-btn" type="button" style="margin-left:20px;">Create</button>
                                            <div
                                                class="modal fade" role="dialog" tabindex="-1" id="project-prev">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Preview</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                                        <div class="modal-body" id="project_preview">
                                                            
                                                        </div>
                                                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
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
        </form>
    </div>
    </div>
    </div>