const api = {
    "getFlterData" : "index.php?r=medinfi-analytics/get-filter-data",
    "getProjectList" : "index.php?r=medinfi-analytics/get-project-list",
    "getProject" : "index.php?r=medinfi-analytics/get-project"
}

$(document).ready(function () {

    //alert('its working yahoo !!')

    //Filters data
    getFilterData(api['getFlterData'])

    //getting project
    getProjectList(api['getProjectList'])

    //Selecting filters
    $("#company_select").change(function (){
        selectCompany(this.value)
    })
    $("#client_select").change(function(){
        selectClient(this.value)
    })
    $("#acm_select").change(function(){
        console.log("select");
        selectAcm(this.value)
    })
    
    $("#btn_export").click(function(){
        alert("TODO: implement")
    })
})  

/*
    compant is the list of companies
*/
function setCompanies(company) {
    company.forEach(element => {
        company = element
        $("#company_select").append(`<option value="${company.id}">${company.name}</option>`);
        console.log(`${company} added`)
    })
}

/*
    client is the list of clients
*/
function setClients(client) {
    client.forEach(element => {
        client = element
        $("#client_select").append(`<option value="${client.id}">${client.name}</option>`);
        console.log(`${client} added`)
    })
}

/*
    acm is the list of account managers
*/
function setAcm(acm) {
    acm.forEach(element => {
        acm = element
        $("#acm_select").append(`<option value="${acm.id}">${acm.name}</option>`);
        console.log(`${acm} added`)
    })
}

//AJAX : getting filter data
function getFilterData(apiUrl) {
    $.get(apiUrl, function(data, status){
        //console.log("data" + data + "status : " + status)
        //data = JSON.parse(data)
        setCompanies(data.company)
        setClients(data.client)
        setAcm(data.acm)
    })
}

/*
    companyId of the company
    TODO: select company implementation
    This will display all the clients assoiate with that company
*/
function selectCompany(companyId) {
    //alert("slient is selected " + companyId)
    $.get(api['getProjectList'], 
    {
        company: companyId
    }, 
    function(data, dtatus){
        console.log(data);
        setProjectList(data.projectList)
    })
}

/*
    This will display all the projects associated with that clients
    TODO: select client implementation
*/
function selectClient(clientId) {
    //alert("slient is selected " + clientId)
    $.get(api['getProjectList'], 
    {
        client: clientId
    }, 
    function(data, dtatus){
        console.log(data);
        setProjectList(data.projectList)
    })
}

/*
    This will display all the projects associated with that Account manager
    TODO: select client implementation
*/
function selectAcm(acmId) {
    //alert("slient is selected " + acmId)
    $.get(api['getProjectList'], 
    {
        acm: acmId
    }, 
    function(data, dtatus){
        console.log(data);
        setProjectList(data.projectList)
    })
}

//AJAX Method for getting project and dashboard
function getProjectAndDashboard() {
    //TODO: Impliment this method
}

function getProjectList(apiUrl) {
    //set project list
     $.get(apiUrl, function(data, status){
        console.log(data);
        //json = JSON.parse(data)
        setProjectList(data.projectList)
    })
}

/*
    projectList is the list of projects
*/
function setProjectList(projectList) {
    $("#project_list").html("");
    projectList.forEach(project => {
        $("#project_list").append(`<a href="#" class="list-group-item list-group-item-action" id="project_list_${project.id}" onclick="selectProject('${project.id}')">${project.name}</a>`)
    })
}

//AJAX: get project by ID
function selectProject(projectID) {
    //$("#project_list_" + projectID).addClass("active")
    //setProjectDashboard(getProjectById(projectID))

    //AJAX call and get project bt id
    $.get(api['getProject'],{
        project_id: projectID
    },function(data, status){
        //console.log(data)
        setProjectDashboard(data)
    })
}

//set project dashboard according to the project selected
function setProjectDashboard(project) {

    console.log(project)

    $("#project_name").html(project.name)
    //Set Targets of medinfi blog, facebook and twitter
    setMedinfiBlogTargets(project.medinfi.total, project.medinfi.target)
    setFacebookTarget(project.facebook.total, project.facebook.target)
    setTwitterTarget(project.twitter.total, project.twitter.target)
    
    //project level target
    let projectTotal = project.medinfi.total + project.facebook.total + project.twitter.total
    let projectTarget = project.medinfi.target + project.facebook.target + project.twitter.target
    setProjectTargets(projectTotal, projectTarget)

    //Table
    //Medinfi Tables
    loadTable("page-views-table", project.medinfi.pageViews, project.duration)
    loadTable("banner-clicks-table", project.medinfi.bannerClicks, project.duration)
    loadTable("online-sales-table", project.medinfi.onlineSales, project.duration)
}

//set project level target
function setProjectTargets(achieved, target) {
    $("#target_achieved").html(achieved)
    $("#target").html(target)
    campaignProgress = Math.floor(achieved/target*100)
    $("#campaign_progress_bar").css("width", campaignProgress + "%")
    $("#campaign_progress_bar").html(campaignProgress + "%")
}

//set medinfi blog target
function setMedinfiBlogTargets(total, target) {
    $("#medinfi_total").html(total)
    $("#medinfi_target").html(target)
    progress = Math.floor(total/target*100)
    $("#medinfi_blog_progress_bar").css("width", progress + "%")
    $("#medinfi_blog_progress_bar").html(progress + "%")
}

//set facebook target
function setFacebookTarget(total, target) {
    $("#fb_achieved").html(total)
    $("#fb_target").html(target)
    progress = Math.floor(total/target*100)
    $("#fb_progress_bar").css("width", progress + "%")
    $("#fb_progress_bar").html(progress + "%")
}

//set twitter target
function setTwitterTarget(total, target) {
    $("#tw_achieved").html(total)
    $("#tw_target").html(target)
    progress = Math.floor(total/target*100)
    $("#tw_progress_bar").css("width", progress + "%")
    $("#tw_progress_bar").html(progress + "%")
}

//Filter data from the table to search
function filterTable(tableID, inputID) {
    var input, filter, table, tr, td, i
    input = document.getElementById(inputID)
    filter = input.value.toUpperCase()
    table = document.getElementById(tableID)
    tr = table.getElementsByTagName("tr")
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = ""
        } else {
          tr[i].style.display = "none"
        }
      }
    }
}

//for loading data in the table
function loadTable(tableId, weekData, duration = 0) {

    console.log(weekData);

    //Creating Table Head
    let tableHead = $(`#${tableId} thead`)
    //removing previous content
    tableHead.html('')
    tableHead.append('<tr>')
    tableHead.children().append('<th colspan="1">No.</th>')
    tableHead.children().append('<th colspan="1">Name</th>')
    tableHead.children().append('<th colspan="1">Launch Date</th>')
    tableHead.children().append('<th class="table-active">Target</th>')
    tableHead.children().append('<th class="table-active">Actual</th>')
    //week duration
    let weekDuration = duration
    for(let i=0; i<weekDuration; i++){
        tableHead.children().append(`<th>W${i}</th>`)
    }
    tableHead.append('</tr>')
    
    //Creating Table Body
    let tableBody = $(`#${tableId} tbody`)
    //removing previous content
    tableBody.html('')
    console.log(weekData)
    console.log("Number of weeks : " + weekData.length)
    let i = 1
    weekData.forEach(e => {
        let row = '<tr>'
        row += `<td>${i}</td>`
        row += `<td>${e.name}</td>`
        row += `<td>${e.launchDate}</td>`
        row += `<td>${e.target}</td>`
        row += `<td>${e.actual}</td>`
        console.log(e.data)
        e.data.forEach(e => {
            row += `<td>${e}</td>`
        })
        row += '</tr>'
        tableBody.append(row)
        i++
    })
}

function exportProject() {
    //TODO: Export project
    alert("project exporting")
}