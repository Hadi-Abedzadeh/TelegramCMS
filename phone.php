<img src="https://pixlok.in/Pixlok/Images/PNG/Mobile_PNG_Mockup_bsfjvr.png" width="280px">
<div class="mask">
  <div class="canvas">
    <div class="page">
		<div id="ajax-result"></div>
	</div>
  </div>
</div>

<style>

/* width */
::-webkit-scrollbar {
  width: 10px;
  border-radius:10px;
}

/* Track */
::-webkit-scrollbar-track {
  display: none
}
 
/* Handle */
::-webkit-scrollbar-thumb:hover {
  background: #888; 
  display:block;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
  display:block;
}

.mask {
  position: absolute;
    left: 33px;
    top: 60px;
    width: 233px;
    height: 490px;
  overflow-x: hidden;
}
.canvas {
  position: relative;
  width: 2195px;
  height: 342px;
}
.page {
  width: 239px;
  height: 342px;
  float:left;
}
</style>


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