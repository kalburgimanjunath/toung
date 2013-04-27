<html>
<head>
<title>Login/Registration Example</title>

<script type="text/javascript" src="http://platform.linkedin.com/in.js">
  api_key: h44vvpbkitnq
  authorize: true
</script>

<script type="text/javascript">
function onLinkedInAuth() {
  IN.API.Profile("me")
    .result( function(me) {
      var id = me.values[0].id;
	 
      // AJAX call to pass back id to your server
    });
}
</script>

</head>
<body>

<span id="linkedin-apply-placeholder"></span>
<script type="in/Login">
Hello, <?js= firstName ?> <?js= lastName ?>.
</script>

</body>
</html>
