var App = (function(){
	return {
		regFormValidate: function(obj){
				
			var pass = document.getElementsByName('reg[pass]')[0];
			var pass_confirm = document.getElementsByName('reg[pass_confirm]')[0];	
			function checkPass(){
				if (pass.value !== pass_confirm.value) {
					pass_confirm.setCustomValidity(obj.passMess);
				} else {
					pass_confirm.setCustomValidity("");
				}
			}
			pass.addEventListener("keyup", checkPass);
			pass_confirm.addEventListener("keyup", checkPass);
			
			var file = document.getElementsByName('reg[image]')[0];
			file.addEventListener("change", function(){
				var files = file.files;
				var types = ['image/png','image/jpeg','image/gif'];
				if (files.length > 0) {
					if (files[0].size > obj.fSize) {
						file.setCustomValidity(obj.sizeMess+ " " 
							+ Math.round(obj.fSize/1024) + " KB");
						return;
					}else if(types.indexOf(files[0].type)===-1){
						file.setCustomValidity(obj.typeMess);
						return;
					}
				}
				file.setCustomValidity("");				
			});
			
		}
	};
})();
