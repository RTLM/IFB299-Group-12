<!DOCTYPE html>
<html lang="en">
    <?php
        include 'head.php';
    ?>
    <body>
	<?php
            include 'navbar.php';
        ?>
        <div class="container">
			<h1 class="text-center" style="padding-bottom: 0.5cm;">Delivery Cost Calculator</h1>
			<div class="col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="weight">Package Weight (Kgs):</label>
						<input type="text" class="form-control" id="weight" name="weight" placeholder="Package Weight in Kilograms" onkeydown="validate('weight','weight');">
					</div>	
					<div class="form-group">
						<label for="size">Package Size:</label>
						<select class="form-control" id="size" name="size">
							<option hidden value="" selected disabled>Select a Size</option>
							<option value="Envelope">Envelope (Up to 22cm x 33.5cm)</option>
							<option value="Small">Small (Up to 20cm&#179;)</option>
							<option value="Medium">Medium (Up to 35cm&#179;)</option>
							<option value="Large">Large (Up to 45cm&#179;)</option>
							<option value="X-Large">X-Large (Up to 70cm&#179;)</option>
						</select>
					</div>									
					<div class="form-group">
						<label for="priority">Package Priority:</label>
						<select class="form-control" id="priority" name="priority">
							<option value="0">Standard (5-7 Working Days)</option>
							<option value="5">Express (2-4 Working Days) (+$5)</option>
							<option value="10">Overnight (1 Working Day) (+$10)</option>
						</select>
					</div>
				<div class="text-center">
				<button  onclick="calc()" class="btn btn-info btn-space" name role="button">Calculate</button>
				</div>
				<h3 class="text-center" id="calc"></h3>
			</div>
        </div>
		
		<script>
		function calc() {
			if (validateWeight('weight')) {
				var weight = document.getElementById('weight').value;
				var size = document.getElementById('size').value;
				var total = 0;
				if (String(size) == "X-Large" || parseInt(weight) >= 10) {
					total += 25.6;
				} else if (String(size) == "large" || parseInt(weight) >= 5) {
					total += 20.05;
				} else if (String(size) == "Medium" || parseInt(weight) >= 3) {
					total += 17.6;
				} else if (String(size) == "Small" || parseInt(weight) >= 0.5) {
					total += 13.8;
				} else if (String(size) == "Envelope") {
					total += 7.6;
				}			
				var priority = document.getElementById('priority').value;
				total += parseInt(priority);
				document.getElementById("calc").innerHTML = "Total Price: $" + total;
			} else {
				document.getElementById("calc").innerHTML = "Weight must be 22Kg or under";
			}
		}		
		</script>
        
        <?php
            include "tail.php";
        ?>
  </body>
</html>