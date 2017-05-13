<?php
BeginForm('contact_professional');

//AddTextBox($row, 'company_name', 'Entreprise', '');
?>
<div class="form-group row">
<label for="company_name" class="col-form-label">Entreprise</label>
<span style="width: 100%">
<input type="text" class="form-control typeahead" name="company_name" id="company_name" placeholder="" value="<?= $row["company_name"] ?>" autocomplete="off" >
</div>
</div>
<?php	

AddTextBox($row, 'professional_service', 'Service', '');
AddTextBox($row, 'professional_function', 'Fonction', '');
AddTextBox($row, 'professional_phone', 'Téléphone', '');
AddTextBox($row, 'professional_phone_extension', 'Extension', '');
AddTextBox($row, 'professional_mobile_phone', 'Mobile', '');
AddTextBox($row, 'professional_fax', 'Fax', '');
AddTextBox($row, 'professional_email', 'Email', '');
AddTextBox($row, 'professional_email_2', '', '');
AddTextBox($row, 'professional_website_1', 'Site Internet', '', 'url');
AddTextBox($row, 'professional_website_2', '', '', 'url');
AddTextBox($row, 'professional_viadeo', 'Viadeo', '');
AddTextBox($row, 'professional_linkedin', 'LinkedIn', '');
AddTextBox($row, 'professional_twitter', 'Twitter', '');
AddTextBox($row, 'professional_skype', 'Skype', '');
AddTextBox($row, 'professional_login', 'Login', '');

EndForm('contact_professional', '../controllers/contact_controller.php?type=update');
?>

<script>
var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches);
	  };
	};

	var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
	  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
	  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
	  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
	  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
	  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
	  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
	  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
	  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
	];
	
$('#company_name').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});
</script>