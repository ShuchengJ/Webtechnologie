<div class="content">
	<h2>Profiel</h2>
	<p> Verander hier je persoonlijke gegevens door de velden te veranderen en op 'opslaan' te drukken </p>
	<form method="post" action="profile/change" class="register">
	<div class='registerwrapper'>
		<div class='registerForm'>
			Nickname/alias <br>
			<?php echo "<input type='text' name='nickname' id='nickname' value='$profile[nickname]' required/> <br>"?>
		
			Full name<br>
			<?php echo "<input type='text' name='fullname' id='fullname' value='$profile[fullname]' required/> <br>"?>
	
			Email address<br>
			<?php echo "<input type='email' name='email' id='email' value='$profile[email]' required/> <br>"?>
		
			huidige wachtwoord:<br>
			<?php echo "<input type='password' name='password' id='password' minlength='4' required/>"?>
			
			<br>nieuwe wachtwoord:<br>
			<?php echo "<input type='password' name='newPass' id='password' minlength='4' />"?>
		</div>
		
		
		<div class='registerForm'>
			Birthday <br>
			<?php 
			echo "<input type='number' name='day' id='day' maxlength='2' size='4' min='1' max='31' placeholder='day' value='$profile[day]' required/>";
			echo "<input type='number' name='month' id='month' maxlength='2' size='4' min='1' max='12' placeholder='month' value='$profile[month]' required/>";
			echo "<input type='number' name='year' id='year' maxlength='4' size='4' min='1900' max='2016' placeholder='year' value='$profile[year]' required/>";
			?>
			<br>
			I am a:<br>
			<?php
			$mcheck = '';
			$wcheck = '';
			if($profile['gender'] == 'Man'){
				$mcheck = 'checked';
			}else{
				$wcheck = 'checked';
			}
			echo "<input type='radio' name='gender' value='Man' required $mcheck> Man";
			echo "<input type='radio' name='gender' value='Woman' required $wcheck > Woman <br>";
			?>
			looking for: <br>
			<?php
			$mcheck = '';
			$wcheck = '';
			$bcheck = '';
			switch($profile['interest']){
				case 'Man': $mcheck = 'checked'; break;
				case 'Woman': $wcheck = 'checked'; break;
				case 'Both': $bcheck = 'checked'; break;
			}
			echo "<input type='radio' name='interest' value='Man' required $mcheck> Man";
			echo "<input type='radio' name='interest' value='Woman' required $wcheck> Woman";
			echo "<input type='radio' name='interest' value='Both' required $bcheck> Both";
			?>
			<br>
			between the ages of:
			<br>
			<div id="slider"></div>
			<script>
				$( "#slider" ).slider({
					min:18,
					max:100,
					<?php echo "values:[ $profile[agemin], $profile[agemax] ]"; ?>
					,
					range:true,
					slide: function(event, ui) {
				        $("#amount").val(ui.values[0] + " - " + ui.values[1]);
				    }
				});
			</script>
			
			<?php echo"<input id='amount' type='text' readonly name='age' value='$profile[agemin] - $profile[agemax]' required>"; ?>
		</div>
		
		
		<div  class='descriptionForm'>
		Choose your favorite brands: <br>
		<dl class="dropdown"> 
  
    		<dt>
    		<a href="#">
      			<span class="showtext">Select here</span>   
    		</a>
    		</dt>
  
    		<dd>
        		<div class="listofbrands">
           			<ul>
               			<li>
                   			<input type="checkbox" value="Coca-Cola" />Coca-Cola</li>
               			<li>
                   			<input type="checkbox" value="Pepsi" />Pepsi</li>
           			</ul>
        		</div>
    		</dd>
		</dl>
			
		<script>
			$(".dropdown dt a").on('click', function() {
				  $(".dropdown dd ul").slideToggle('fast');
			});

			function getSelectedValue(id) {
				 return $("#" + id).find("dt a span.value").html();
			}

			$('.listofbrands input[type="checkbox"]').on('click', function() {

				 var title = $(this).closest('.listofbrands').find('input[type="checkbox"]').val(),
				 title = $(this).val();

				 if ($(this).is(':checked')) {
				   var html = '<span title="' + title + '"> ,' + title + '</span>';
				   if($('.showtext').text() == "Select here"){
						   $('.showtext').empty();
						   html = '<span title="' + title + '">' + title + '</span>';
				   }
				   $('.showtext').append(html);
				 } else {
				   $('span[title="' + title + '"]').remove();
				   if(!$('.showtext').text())
					   $('.showtext').text("Select here");
				 }
			});
		</script>
		
		Verander profiel beschrijving: <br>
		<?php echo "<textarea name='description' rows='5' cols='57'>$profile[description]</textarea>";?>
		<br>
		<input type="submit" value="Opslaan">
		</div>
		</div>
	</form>
	
	<div>

<?php echo form_open_multipart('profile/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</div>
</div>