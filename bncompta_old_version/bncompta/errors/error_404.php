<html>
<head>
<title>Error</title>
<style type="text/css">

#error-page {
    margin-top: 50px;
}

body {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 3px double #000000;
    border-radius: 11px 11px 11px 11px;
    color: #333333;
    font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
    font-size: 10px;
    margin: auto;
    padding: 1em;
    width: 654px;
}
#error-page p {
    font-size: 12px;
    line-height: 18px;
    margin: 25px 0 20px;
}

p, li {
    padding-bottom: 2px;
}

p, dl, multicol {
    display: block;
}
</style>
</head>
<body id="error-page">
	<p><?php echo $message; ?></p>
        <a href="<?php echo base_url();?>">BNCompta</a>
     
	</p>
</body>
</html>