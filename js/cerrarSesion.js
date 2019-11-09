$("#logout").click(function (e) { 
    e.preventDefault();
   
    var dato = {
        "dato":1
    }
    $.ajax({
        type: "post",
        url: "logOut.php",
        data:dato,
        success: function (response) {
            alert(response);
            location.reload();
        }
    });
    
});