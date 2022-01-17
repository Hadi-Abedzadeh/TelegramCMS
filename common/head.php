<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<script>
		   window.setInterval(function() {
				reloadIFrame()
			}, 5000);

			function reloadIFrame() {
				ajax();
			}		
			
			function ajax(){
				var xmlhttp = new XMLHttpRequest();

				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
					   if (xmlhttp.status == 200) {
						   document.getElementById("ajax-result").innerHTML = xmlhttp.responseText;
					   }
					   else if (xmlhttp.status == 400) {
						  alert('There was an error 400');
					   }
					   else {
						   alert('something else other than 200 was returned');
					   }
					}
				};

				xmlhttp.open("GET", "getUpdates.php", true);
				xmlhttp.send();
			}
			
			
			function checkCheckbox(){
				rate_value = document.getElementById('disable').checked;
				if(rate_value == true){
					
					
					document.getElementById("customChatID").disabled = true;
				}else{
					document.getElementById("customChatID").disabled = false;

				}
			}
  
	</script>
	<style>
		
		// body{
			background: #001220;
			// color: #EEE;
			font-family: Corbel!important;
		// }
		
		a{
			color: blue;
		}
		
		input, select, button{
			// background: #082335;
			height: 30px;
			border-radius: 4px;
			color: #5BB0E6;
		    border: #5BB0E6 solid 2px;
		}
		
		textarea{
			// background: #082335;
			
			border-radius: 4px;
			color: #5BB0E6;
		    border: #5BB0E6 solid 2px;
		}
		
		::placeholder{
			color: #5BB0E6;
		}
		
		:-ms-input-placeholder {
		 color: #5BB0E6;
		}

		::-ms-input-placeholder {
		 color: #5BB0E6;
		}
		
		input[type=radio]{
			    vertical-align: middle;
		}

	#ajax-result{
	  width: 100%;
	  height: 500px;
	  overflow: overlay;
	  border: 1px solid #5BB0E6;
	  padding: 5px;
	  margin: 5px;
	}
	</style>