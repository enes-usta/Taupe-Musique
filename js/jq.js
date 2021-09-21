$(document).ready(function(){
				$('#reponse').hide();
				$('#logform').submit(function(e){
					e.preventDefault();
					formdata = $('#logform').serialize();
					submitForm(formdata);
				});
				
				$('#enregform').submit(function(e){
					e.preventDefault();
					formdata = $('#enregform').serialize();
					submitDetails(formdata);
				});
				
				$('#modiform').submit(function(e){
					e.preventDefault();
					formdata = $('#modiform').serialize();
					updateDetails(formdata);
				});
				
				$('#datePicker')
				.datepicker({
					format: 'dd/mm/yyyy',
					startDate: '01/01/1900',
					endDate: '12/30/2020'
				});
				
				$('#datePicker2')
				.datepicker({
					format: 'dd/mm/yyyy',
					startDate: '01/01/1900',
					endDate: '12/30/2020'
				});
			});
			
			function submitForm(formdata){
				$.ajax({
					type: 'POST',
					url: 'Login.php',
					data: formdata,
					dataType: 'json',
					cahce: false,
					success: function(data){
						$('#reponse').removeClass().addClass((data.error === true) ? 'error' : 'success').html(data.msg).fadeIn(500);	
						
						if($('#reponse').hasClass('error')){
							$('#reponse').fadeOut(4000);
						}
						else
						{
								location.reload();
						}
						
					},
				});
			};	
			
			function submitDetails(formdata){
				var str = '';
				$.ajax({
					type: 'POST',
					url: 'Enregistrer.php',
					data: formdata,
					dataType: 'json',
					cahce: false,
					success: function(data){
						if(data.ok == false){
							$('#reponse1').show();
							$.each(data, function(i,item) {
								if(item != data.ok){
									str+='<li>' + item +'</li>'
								}
								$('#reponse1').html('<font color="red"><ul>' + str + '</ul></font">');
								$('#reponse1').fadeOut(5000);
							});
						}
						else{
							location.reload();
						}
						
					},
				});	
};	


function updateDetails(formdata){
				var str = '';
				$.ajax({
					type: 'POST',
					url: 'Update.php',
					data: formdata,
					dataType: 'json',
					cahce: false,
					success: function(data){
						location.reload();
					},
				});
};	

