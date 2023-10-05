// Click event for all 'edit' buttons
document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        var id = this.getAttribute('data-id'); // Retrieve the data-id attribute
        document.querySelector('#edit-name-' + id).contentEditable = true;
        // Add similar lines for other editable fields...
    });
});

// Click event for all 'end editing' buttons
document.querySelectorAll('.end-editing').forEach(button => {
    button.addEventListener('click', function() {
        var id = this.getAttribute('data-id'); // Retrieve the data-id attribute
        document.querySelector('#edit-name-' + id).contentEditable = false;
        // Add similar lines for other editable fields...
        saveText(id); //pass the id to your saveText function
    });
});

function saveText(sid){
    console.log('saveText called correctly', sid);
    var xr = new XMLHttpRequest();
    var url = "edit.php";
    
    // Building the vars string dynamically using a loop
    var fields = ["name", "email", "phone", "country", "rating", "opening", "title", "address", "notes"];
    var vars = "id=" + sid;
    
    fields.forEach(function(field) {
        var el = document.getElementById("edit-" + field + "-" + sid);
        if(el) {
            vars += "&new" + field.charAt(0).toUpperCase() + field.slice(1) + "=" + el.innerHTML;
        }
    });

    xr.open("POST", url, true);
    xr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log('vars is ', vars);
    xr.send(vars);
}
