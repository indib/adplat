<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>GreyBox - Examples</title>

   

    <script type="text/javascript" src="http://localhost/adplat/temp/greybox/AJS.js"></script>
    <script type="text/javascript" src="http://localhost/adplat/temp/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="http://localhost/adplat/temp/greybox/gb_scripts.js"></script>
    <link href="gb_styles.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="http://localhost/adplat/temp/js/greybox/static_files/help.js"></script>
	 <script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>
    <link href="http://localhost/adplat/temp/js/greybox/static_files/help.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>


<script type="text/javascript">
GB_myShow = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 500,
        width: width || 500,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
    }
    var win = new GB_Window(options);
    return win.show(url);
}
</script>
<ul>
    <li>
        <a href="http://google.com/" onclick="return GB_myShow('google', 'http://google.com/', 400, 400, this.href)">Visit Google without loading</a>
    </li>
</ul>

</body>
</html>
