function addUser()
{
    // Get user input for new-account login and pasword.
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();
    var firstName = document.getElementById("firstName").value.trim();
    var lastName= document.getElementById("lastName").value.trim();
    var email = document.getElementById("email").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var country = document.getElementById("country").value.trim();
    var chessRating = document.getElementById("chessRating").value.trim();
    var favoriteOpening = document.getElementById("favoriteOpening").value.trim();
    var title = document.getElementById("title").value.trim();

   
	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password +'", "firstName" : "' +firstName+'", "lastName" : "' + lastName+'", "email" : "' + email+'", "phone" : "' + phone+'", "country" : "' + country+'", "chessRating" : "' + chessRating+'", "favoriteOpening" : "' + favoriteOpening+'", "title" : "' + title+'"}';
	var baseurl = "https://chessconnect.xyz/register";
	var extention="/process-register.php";
	
	console.log(username);
	// http POST : Attempt to send json with new-account login and pasword data to server.	
	var xhr = new XMLHttpRequest();
	
	xhr.open("POST", baseurl+extention,false);
	
	console.log(xhr);
	xhr.setRequestHeader("Content-type", "application/json");
	try{
	xhr.send(jsonPayload);}
	catch (err){

		
	}
	console.log(xhr.responseText);
	if(xhr.responseText==1){
		
			return true;
		}
		else{
			
			return false;
		}
}

