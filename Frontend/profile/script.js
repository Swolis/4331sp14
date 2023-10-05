
document.addEventListener("DOMContentLoaded", function() {
    // Fields to be edited
    var fields = ["name", "email", "phone", "country", "chess_rating", "favorite_opening", "title", "address", "notes"];
    
    // Click event for all 'edit' buttons
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            console.log("Checking ID:", id);
            document.querySelector('#data-' + id).style.display = 'none'; // Hide the data row
            document.querySelector('#edit-' + id).style.display = ''; // Show the edit row
            
            fields.forEach(field => {
                var el = document.querySelector('#edit-' + field + '-' + id);
                if (el) el.contentEditable = true;
            });
        });
    });

    // Click event for all 'end editing' buttons
    document.querySelectorAll('.end-editing').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            console.log("Checking ID:", id);
            document.querySelector('#data-' + id).style.display = ''; // Show the data row
            document.querySelector('#edit-' + id).style.display = 'none'; // Hide the edit row
            saveText(id); 
        });
    });

    function saveText(sid){
        console.log('saveText called correctly', sid);
        var xr = new XMLHttpRequest();
        var url = "edit.php";
        
        // Begin with the id parameter in the vars string
        var vars = "id=" + sid;

        // Add each field's textContent to the vars string, URL-encoded
        fields.forEach(function(field) {
            var inputEl = document.querySelector('#edit-' + sid + ' input[name=' + field + ']');
            if (inputEl) {
                vars += "&" + field + "=" + encodeURIComponent(inputEl.value.trim());
            }
        });
    
        // Handling server response
        xr.onreadystatechange = function () {
            if (xr.readyState == 4 && xr.status == 200) {
                console.log('Server response:', xr.responseText);
                var response = JSON.parse(xr.responseText);
                if (response.status === 'success') {
                    // Handle success - e.g., show a success message to the user
                    console.log(response.message);
                } else {
                    // Handle error - e.g., show an error message to the user
                    console.log("you got an error");
                    console.log(response.message);
                }
            }
        };
        
        xr.open("POST", url, true);
        xr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        console.log('Sending vars: ', vars);
        xr.send(vars);
    }
});
