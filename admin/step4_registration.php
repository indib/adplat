
<!DOCTYPE html>
<html>
<head>
<title>Upload Image</title>
<script type="text/javascript" src="http://the-echoplex.net/demos/upload-file/jelly/min.js"></script>
<link rel="stylesheet" href="/looknfeel/css/basic.css" type="text/css" />
<link type="text/css" href="/third-party/registration/formcheck/css/reset.css" rel="stylesheet" media="screen" />
<link type="text/css" href="/third-party/registration/formcheck/css/template.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="/looknfeel/css/galleriffic-5.css" type="text/css" />
		
		
		<!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->
		<link rel="stylesheet" href="/looknfeel/css/blue.css" type="text/css" />
		<link rel="stylesheet" href="/looknfeel/css/colorbox.css" />
		
		<script type="text/javascript" src="/third-party/registration/formcheck/core.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/more.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/formcheck.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/formcheck-yui.js"></script>
<link rel="stylesheet" type="text/css" href="../module/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="../module/autocomplete/jquery.js"></script>

<script type="text/javascript" src="../module/autocomplete/jquery.autocomplete.js"></script>
<link media="screen" type="text/css" href="/third-party/registration/formcheck/css/form.css" rel="stylesheet" />
<link media="screen" type="text/css" href="/third-party/registration/formcheck/css/uploadform.css" rel="stylesheet" />
<link media="screen" type="text/css" href="/third-party/registration/formcheck/theme/green/formcheck.css" rel="stylesheet" /> <script type="text/javascript" src="/js/formcheck/lang/en.js"></script> <script type="text/javascript" src="/js/formcheck/formcheck.js"></script> 
		<script type="text/javascript">
			window.addEvent('domready', function(){
				new FormCheck('formular');
		});
		jQuery.noConflict();
			// Use jQuery via jQuery(...)
			jQuery(document).ready(function(){
				jQuery("#storecountry").autocomplete("../module/autocomplete/autocomplete.php", {
							selectFirst: true
						});
			});
		</script>
<script type="text/javascript">
			window.addEvent('domready', function(){
				new FormCheck('formular');
		});
		jQuery.noConflict();
			// Use jQuery via jQuery(...)
			jQuery(document).ready(function(){
				jQuery("#storecountry").autocomplete("../module/autocomplete/autocomplete.php", {
							selectFirst: true
						});
			});
		</script>
</head>
<body id="page45" class="page">

<div id="container">
	<div id="content">
		<div id="item22" class="item ">
		

<form enctype="multipart/form-data" action="#" method="post" class="formular" id="formular">
	<fieldset> 
		<legend>Upload photo and text for Products/ Services </legend> 
		<label> <span class="desc">Product/ Service #1: </span>
		<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecountry" id="storecountry"/>
		</label>
		<label> <span class="caption">Up Photo For Product/ Service #1: </span>
		<label>
		<div class="field">
		<label class="file-upload">
			<span><strong>Up Photo</strong></span>
			<input type="file" name="uploadfile1" />
		</label>
		</label>
		</div>
		 
		<label> <span class="desc">Product/ Service #2: </span>
		<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecountry" id="storecountry"/>
		</label>
		<label> <span class="caption">Up Photo For Product/ Service #2: </span>
		<div class="field">
		<label class="file-upload">
			<span><strong>Up Photo</strong></span>
			<input type="file" name="uploadfile2" />
		</label>
		</div>
		
		<label> <span class="desc">Product/ Service #3: </span>
		<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecountry" id="storecountry"/>
		</label>
		<label> <span class="caption">Up Photo For Product/ Service #3: </span>
		<div class="field">
		<label class="file-upload">
			<span><strong>Up Photo</strong></span>
			<input type="file" name="uploadfile3" />
		</label>
		</div>
	</fieldset>
	
		<fieldset> 
		<legend>Upload photo to make your site cool</legend> 
		
		<label> <span class="caption1">Up Photo For Logo: </span>
		<label>
		<div class="field">
		<label class="file-upload">
			<span><strong>Up Photo</strong></span>
			<input type="file" name="uploadfile1" />
		</label>
		</label>
		</div>
		 
		
		<label> <span class="caption1">Up Main Photo: </span>
		<div class="field">
		<label class="file-upload">
			<span><strong>Up Photo</strong></span>
			<input type="file" name="uploadfile2" />
		</label>
		</div>
		
		
		
	</fieldset>
	<div class="button">
					<input type="submit" value="Go" class="submit" title="Click to submit the form"/> 
					<input type="reset" value="----" title="Reset"/></div>
					<hr />
	
	
</form>


</div>
</div>
</div>
<script type="text/javascript" src="http://the-echoplex.net/demos/upload-file/file-upload.js"></script>
</body>
</html>