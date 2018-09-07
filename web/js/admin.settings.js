api.addCompany = "index.php?r=medinfi-analytics/add-company"
api.addAcm = "index.php?r=medinfi-analytics/add-acm"
api.addClient = "index.php?r=medinfi-analytics/add-client"
api.addProject = "index.php?r=medinfi-analytics/add-project"
api.getCompanies = "index.php?r=medinfi-analytics/get-companies"

$('document').ready(function(){

    $('#add-company-btn').click(function(){
        addCompany()
    })

    $('#add-acm-btn').click(function(){
        addAcm()
    })

    $('#add-client-btn').click(function(){
        addClient()
    })

    $('#add-project-btn').click(function(){
        //alert("add project")
        addProject()
    })

    setCompanyList()
    setClientList()
    setAcmlist()

    //test();
})

function test() {
    $.post("index.php?r=medinfi-analytics/test", 
    {
        name: "Vishal"

    },function(data, statuc) {
        alert(data);
    })
}

function addCompany() {

    let name = $('#company-name').val();
    let contactPerson = $('#company-contact-person').val();
    let email = $('#company-email').val();
    let mobile = $('#company-mobile').val();

    $.get(api.addCompany, {

        companyName: name,
        contactPerson: contactPerson,
        email: email,
        mobile: mobile

    }, function(data, status){
        if(data >= 1) {
            alert(data + " Company Added")
        } else {
            alert("Something went wrong")
        }
    })
}

function addAcm() {

    let name = $('#acm-name').val();
    let email = $('#acm-email').val();
    let mobile = $('#acm-mobile').val();
    let password = $('#acm-password').val();

    $.get(api.addAcm, {

        name: name,
        email: email,
        mobile: mobile,
        password: password,

    }, function(data, status){
        if(data >= 1) {
            alert(data + " Account manager Added")
        } else {
            alert("Something went wrong")
        }
    })
}

function addClient() {
    let name = $('#client-name').val();
    let brandName = $('#client-brand-name').val();
    let companyId = $('#company-select').val();
    let clientId = $('#client-id').val();
    let email = $('#client-email').val();
    let mobile = $('#client-mobile').val();
    let password = $('#client-password').val();

    alert(companyId)

    $.get(api.addClient, {

        name : name,
        brandName : brandName,
        companyId : companyId,
        clientId : clientId,
        email : email,
        mobile : mobile,
        password : password

    }, function(data, status){
        alert(data);
    })
}

function addProject() {
    
    let name = $('#project_name').val()
    let client = $('#client-select').val()
    let tw_retweets_target = $('#tw_retweets_target').val()
    let tw_impression_target = $('#tw_impression_target').val()
    let tw_comments_target = $('#tw_comments_target').val()
    let fb_likes_share_target = $('#fb_likes_share_target').val()
    let fb_click_target = $('#fb_click_target').val()
    let fb_comments_target = $('#fb_comments_target').val()
    let blog_pageview_target = $('#blog#_pageview_target').val()
    let blog_bannerclicks_target = $('blog_bannerclicks_target').val()
    let blog_online_sale_target = $('#blog_online_sale_target').val()
    let duration = $('#duration').val()
    let accountManager = $('#acm-select').val()
    let launchDate = $('#launchDate').val()

    $.post(api.addProject, {

        name : name,
        client : client,
        tw_retweets_target : tw_retweets_target,
        tw_impression_target : tw_impression_target,
        tw_comments_target : tw_comments_target,
        fb_likes_share_target : fb_likes_share_target,
        fb_click_target : fb_click_target,
        fb_comments_target : fb_comments_target,
        blog_pageview_target : blog_pageview_target,
        blog_bannerclicks_target : blog_bannerclicks_target,
        blog_online_sale_target : blog_online_sale_target,
        duration : duration,
        accountManager : accountManager,
        launchDate : launchDate

    }, function(data, status){
        
        alert(data);
    })

}

function setCompanyList() {
    $.get(api.getFlterData, function(data, status){
        data.company.forEach(company => {
            $('#company-select').append(`<option value="${company.id}">${company.name}</option>`)
        })
    })
}

function setClientList() {
    $.get(api.getFlterData, function(data, status){
        data.client.forEach(client => {
            $('#client-select').append(`<option value="${client.id}">${client.name}</option>`)
        })
    })
}

function setAcmlist() {
    $.get(api.getFlterData, function(data, status){
        data.acm.forEach(acm => {
            $('#acm-select').append(`<option value="${acm.id}">${acm.name}</option>`)
        })
    })
}