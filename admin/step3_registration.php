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
					<form class="formular" id="formular" method="post" action="#">
					<fieldset><legend>You have already selected a tamplate </legend> 
					<div class="infos">
					<img src="/looknfeel/image//template/tshirt.png" alt="Title #0" onclick="showSuperbox('superbox0');" class="template"/>
						<p>Carefully fill in all information which will help us to make you famous.</p>
					</div>
					</label>
					</fieldset>
					<fieldset> <legend>Service/ Product Details </legend> 
					<label> <span>Small write up on product/ Services : </span>
					<textarea class="validate['required','length[6,16]','alphanum'] text-input" name="storename" id="storename" /> </textarea>
					</label>
					<label>	<span>Write up to attract your client/ customer : </span>
					<textarea class="validate['required','length[3,-1]','nodigit'] text-input" name="shoproad" /></textarea>
					</label>
					</fieldset>
					<fieldset> <legend>What do you offer to your client/ customer </legend> 
					<label><span>Your first offer/ Service : eg: 50% discount on tshirts</span>
					<input type="text" class="validate['required','length[3,-1]','nodigit'] text-input" name="storecity" />
					</label>
					<label><span>Your second offer/ Service : eg: 20% discount on trousers</span>
					<input type="text" class="validate['required','length[0,6]'] text-input" name="storepin" />
					</label>
					<label><span>Your third offer/ Service : eg: Free shipping</span>
					<input type="text" class="validate['required','length[3,-1]','nodigit'] text-input" name="storestate" />
					</label>
					</fieldset>
					<fieldset> <legend>You can display any of your three products </legend> 
					<label> <span>Product/ Service #1: </span>
					<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecountry" id="storecountry"/>
					</label>
					<label> 
					<span>Product/ Service #2: </span> 
					<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecontinent" id="storecontinent"/></label>
					<label> 
					<span>Product/ Service #3: </span> 
					<input type="text" class="validate['required','digit[16,120]'] text-input" name="storecontinent" id="storecontinent"/></label>
					</fieldset>
					<div class="button">
					<input type="submit" value="Go" class="submit" title="Click to submit the form"/> 
					<input type="reset" value="----" title="Reset"/></div>
					<hr />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
