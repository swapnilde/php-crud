var saveButton = document.getElementById("save");
var getButton = document.getElementById("get");
var updateButton = document.getElementById("update")
var modal = document.getElementById("update_form");

saveButton.addEventListener('click', saveUser);
getButton.addEventListener('click',getUser);
updateButton.addEventListener('click',updateUserDetails);

function saveUser(e){
	e.preventDefault();
	var formData = new FormData(myForm);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "http://localhost:8080/php-crud/server.php", true);
	xhr.onload = function(){
		if(this.status === 200){
			console.log(this.status);
			document.getElementById("display-data").innerHTML += this.responseText;
		}
	}
	xhr.send(formData);
}

function getUser(){
	var inputId = document.getElementById("input-id").value;
	var finalId = Number(inputId);
	var table;

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "http://localhost:8080/php-crud/server.php?q="+finalId, true);
	xhr.responseType = "json";
	xhr.onload = function(){
		if(this.status === 200){
			console.log(this.status);
			var data = this.response;
			for (var key in data) {
				table += '<tr>'
				table += '<td>' + data[key].id + '</td>';
				table += '<td>' + data[key].first_name + '</td>';
				table += '<td>' + data[key].last_name + '</td>';
				table += '<td>' + data[key].email + '</td>';
				table += '<td>' + data[key].gender + '</td>';
				table += '<td>' + data[key].ip_address + '</td>';
				table += '<td>'+'<button class="btn edit_btn" onclick="editUser(this)" value='+data[key].id+'>Edit</button>'+'</td>';
				table += '<td>'+'<button class="btn del_btn" onclick="deleteUser(this)" value='+data[key].id+'>Delete</button>'+'</td>';
				table += '</tr>'
			}
			document.getElementById("data-table").innerHTML = table;
		}
	}
	xhr.send();
}

window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}

function editUser(e){
	var form;
	modal.style.display = "block";
	console.log("edit button clicked:"+e.value);

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "http://localhost:8080/php-crud/server.php?edit="+e.value, true);
	xhr.responseType = "json";
	xhr.onload = function(){
		if(this.status === 200){
			console.log(this.status);
			var data = this.response;
			console.log(data);
			for (var key in data) {
				document.getElementById("u_id").setAttribute('value',data[key].id);
				document.getElementById("u_first_name").setAttribute('value',data[key].first_name)
				document.getElementById("u_last_name").setAttribute('value',data[key].last_name)
				document.getElementById("u_email").setAttribute('value',data[key].email)
				document.getElementById("u_gender").setAttribute('value',data[key].gender)
				document.getElementById("u_ip_address").setAttribute('value',data[key].ip_address)
			}
		}
	}
	xhr.send();

}

function deleteUser(e){
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "http://localhost:8080/php-crud/server.php?del="+e.value, true);
	xhr.onload = function(){
		if(this.status === 200){
			console.log(this.responseText);
			document.getElementById("display-data").innerHTML += this.responseText;
			getUser();
		}
	}
	xhr.send();
}

function updateUserDetails(obj){
	obj.preventDefault();

	var fdata = new FormData(myForm2);

	var xhr = new XMLHttpRequest();
	xhr.open("POST","http://localhost:8080/php-crud/server.php",true);
	xhr.onload = function (){
		if (this.status === 200){
			console.log(this.responseText);
			document.getElementById("display-data").innerHTML += this.responseText;
			getUser();
		}
	}
	xhr.send(fdata);
}



