var globalUser = new User();
// var globalCompany = new Company();
// var globalBusinessField = new BusinessField();
// var globalBusinessField = new BusinessField();

var arrayGlobalUser = new Array();
var arrayGlobalCompany = new Array();
var arrayGlobalBunessField = new Array();
var arrayGlobalStatus = new Array();


$.post('application/model/service/businessfield_all.php', function(data) {
	arrayGlobalBunessField.length = 0;
	$.each(data.businessfield, function(index,object){
		arrayGlobalBunessField.push(object);
	});
},'json');

$.post('application/model/service/status_all.php', function(data) {
	arrayGlobalStatus.length = 0;
	$.each(data.status, function(index,object){
		arrayGlobalStatus.push(object);
	});                    
},'json');

$.post('application/model/service/user_all.php', function(data) {
	arrayGlobalUser.length = 0;
	$.each(data.user, function(index,object){
		arrayGlobalUser.push(object);
	});                    
},'json');

$.post('application/model/service/status_all.php', function(data) {
	arrayGlobalStatus.length = 0;
	$.each(data.status, function(index,object){
		arrayGlobalStatus.push(object);
	});                    
},'json');


//------------------------------------------------------------------------


function getNameBusinessField(id) {
	for (var index = 0;index < arrayGlobalBunessField.length; index++) {
		if (arrayGlobalBunessField[index].Id == id) {
			return arrayGlobalBunessField[index].Name;
		}
	}
}

function getNameStatus(id) {
	for (var index = 0;index < arrayGlobalStatus.length; index++) {
		if (arrayGlobalStatus[index].Id == id) {
			return arrayGlobalStatus[index].Name;
		}
	}
}

function getNameUser(id) {
	for (var index = 0;index < arrayGlobalUser.length; index++) {
		if (arrayGlobalUser[index].Id == id) {
			return arrayGlobalUser[index].Name;
		}
	}
}

function getNameStatus(id) {
	for (var index = 0;index < arrayGlobalStatus.length; index++) {
		if (arrayGlobalStatus[index].Id == id) {
			return arrayGlobalStatus[index].Name;
		}
	}
}


function Validate() {
	this.IsEmpty = function(data) {
		var string  = this.Trim(data);
		if (string.length > 0) {
			return false;
		} else {
			return true;
		}
	};
	this.Trim = function(data) {
		return $.trim(data);
	};
}

