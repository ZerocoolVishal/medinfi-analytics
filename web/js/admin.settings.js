api.addCompany = "index.php?r=medinfi-analytics/add-company"
api.addAcm = "index.php?r=medinfi-analytics/add-acm"
api.getCompanies = "index.php?r=medinfi-analytics/get-companies"

$('document').ready(function(){

    $('#add-company-btn').click(function(){
        addCompany();
    })

    $('#add-acm-btn').click(function(){
        addAcm();
    })

    $('#add-client-btn').click(function(){
        addClient();
    })

    setCompanyList();
    setClientList();
    setAcmlist();

})

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

    alert(companyId);
}

function setCompanyList() {
    $.get(api.getFlterData, function(data, status){
        data.company.forEach(company => {
            $('#company-select').append(`<option value="${company.id}">${company.name}</option>`);
        })
    })
}

function setClientList() {
    $.get(api.getFlterData, function(data, status){
        data.client.forEach(client => {
            $('#client-select').append(`<option value="${client.id}">${client.name}</option>`);
        })
    })
}

function setAcmlist() {
    $.get(api.getFlterData, function(data, status){
        data.acm.forEach(acm => {
            $('#acm-select').append(`<option value="${acm.id}">${acm.name}</option>`);
        })
    })
}