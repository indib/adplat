<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" href="/third-party/registration/formcheck/css/reset.css" rel="stylesheet" media="screen" />
<link type="text/css" href="/third-party/registration/formcheck/css/template.css" rel="stylesheet" media="screen" />
<title>Registration</title>
<meta name="description" content="Mootools Form Validation Example. Formcheck Demo for forum registration. Code sample for integration." />
<meta name="keywords" content="mootools, formcheck, form,  validation, javascript, framework, class, forum, demo, example, input, field, test, check " />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="/third-party/registration/formcheck/core.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/more.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/formcheck.js"></script>
<script type="text/javascript" src="/third-party/registration/formcheck/formcheck-yui.js"></script>
<link rel="stylesheet" type="text/css" href="../module/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="../module/autocomplete/jquery.js"></script>

<script type="text/javascript" src="../module/autocomplete/jquery.autocomplete.js"></script>
<link media="screen" type="text/css" href="/third-party/registration/formcheck/css/form.css" rel="stylesheet" />
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
</head>
<body id="page45" class="page">
	<div id="container">
		<div id="content">
			<div class="head">
				<div class="pageinfo">
					
				</div>
			</div>
			<div id="item22" class="item ">
				<div id = "login">
					<form class="formular" id="formular" method="post" action="#">

					<fieldset> <legend>Enter Login Details </legend> 
					<label> <span>User Name : </span>
					<input type="text" class="validate['required','length[6,16]','alphanum'] text-input" name="storename" id="storename" />
					</label>
					<label>	<span>Password : </span>
					<input type="password" class="validate['required','length[3,-1]','nodigit'] text-input" name="shoproad" />
					</label>
					</fieldset>
					
					<div class="login">
					<input type="submit" value="Go" class="submit" title="Click to submit the form"/> 
					<input type="reset" value="----" title="Reset"/></div>
					<hr />
				</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
