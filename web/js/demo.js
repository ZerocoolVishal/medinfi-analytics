$('document').ready(()=>{
    
    //alert("testing project list")
    //testProjectList()

})

function testProjectList() {
    $.get("http://localhost:8080/index.php?r=medinfi-analytics/get-project-list",function(data, status) {
        console.log("data : " + data + "Status : " + status)
        var myJson = JSON.parse(data)
        console.log(myJson)
    })
}