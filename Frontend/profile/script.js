
document.addEventListener("DOMContentLoaded", function() {
    // Fields to be edited
    var fields = ["name", "email", "phone", "country", "chess_rating", "favorite_opening", "title", "address", "notes"];

    // This acts as a container for all buttons inside the contacts list
    // This container allows the buttons to still work after the search bar is used
    // Previously, the js would not apply to buttons after they were reloaded following a search
    // This keeps the js for the buttons attached to the container rather than the buttons themselves
    // Click event for the common ancestor of edit, end-editing, and delete buttons
    document.querySelector('#contactsTable').addEventListener('click', function(event) {
        var target = event.target;

        // Edit button clicked
        if (target.classList.contains('edit-button')) {
            var id = target.getAttribute('data-id');
            console.log("Checking ID:", id);
            document.querySelector('#data-' + id).style.display = 'none'; // Hide the data row
            document.querySelector('#edit-' + id).style.display = ''; // Show the edit row
            
            fields.forEach(field => {
                var el = document.querySelector('#edit-' + field + '-' + id);
                if (el) el.contentEditable = true;
            });
        }

        // End Editing button clicked
        if (target.classList.contains('end-editing')) {
            var id = target.getAttribute('data-id');
            saveText(id, function(response) {
                if (response.status === 'success') {
                    // On success, update the visible data
                    fields.forEach(field => {
                        var inputEl = document.querySelector('#edit-' + id + ' input[name=' + field + ']');
                        if (inputEl) {
                            document.querySelector('#data-' + id + ' .' + field).textContent = inputEl.value.trim();
                        }
                    });

                    // Switch visibility
                    document.querySelector('#data-' + id).style.display = ''; // Show the data row
                    document.querySelector('#edit-' + id).style.display = 'none'; // Hide the edit row
                } else {
                    // Handle error - e.g., show an error message to the user
                    console.log("You got an error");
                    console.log(response.message);
                }
            });
        }

        // Delete button clicked
        if (target.classList.contains('delete-button')) {
            var id = target.getAttribute('data-id');
            deleteRecord(id, function(response) {
                if (response.status === 'success') {
                    // On success, remove the row from the table
                    document.querySelector('#data-' + id).remove();
                    document.querySelector('#edit-' + id).remove();
                } else {
                    // Handle error - e.g., show an error message to the user
                    console.error("Error deleting record:", response.message);
                }
            });
        }
    });

function deleteRecord(id, callback){
    var xr = new XMLHttpRequest();
    var url = "delete.php"; // Use your actual delete endpoint
    var vars = "id=" + id;
    
    xr.onreadystatechange = function () {
        if (xr.readyState == 4 && xr.status == 200) {
            var response = JSON.parse(xr.responseText);
            if (callback) callback(response);
        }
    };
    
    xr.open("POST", url, true);
    xr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xr.send(vars);
    window.reload()
    window.reload()
     
}



function saveText(sid, callback){
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
            if (callback) callback(response); // Call the callback with the response
        }
    };
    
    xr.open("POST", url, true);
    xr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log('Sending vars: ', vars);
    xr.send(vars);
   
}
});
