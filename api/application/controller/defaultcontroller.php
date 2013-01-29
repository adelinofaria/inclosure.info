<?php
class DefaultController extends Controller {
	var $doNotRenderHeader = true;
	
	function __construct($controller) {
		parent::__construct($controller);
	}
	
	function get()
	{
		echo '<html>
			    <head>
			        <title>api.inclosure.info</title>
			    </head>
			    <body>
			        <p>
			            Welcome to api.inclosure.info
			        </p>
			        <p>
			            Avaliable requests.
			        </p>
			        <table border="1">
			            <tr>
			                <td>Requests\Methods</td>
			                <td>GET</td>
			                <td>POST</td>
			                <td>PUT</td>
			                <td>DELETE</td>
			            </tr>
			            <tr>
			                <td>/users</td>
			                <td>--</td>
			                <td>--</td>
			                <td>Register user</td>
			                <td>--</td>
			            </tr>
			            <tr>
			                <td>/users/1</td>
			                <td>User information</td>
			                <td>--</td>
			                <td>Update user information</td>
			                <td>Delete user</td>
			            </tr>
			            <tr>
			                <td>/passwords</td>
			                <td>Passwords list</td>
			                <td>New password</td>
			                <td>--</td>
			                <td>--</td>
			            </tr>
			            <tr>
			                <td>/passwords/1</td>
			                <td>Password</td>
			                <td>--</td>
			                <td>Update password</td>
			                <td>Delete password</td>
			            </tr>
			        </table>
			        <p>
			            Minimum parameters for user creation
			            <br/>
			            {"email":"email","password":"password"}
			        </p>
			        <p>
			            Minimum parameters for password creation
			            <br/>
			            {"name":"domain.com","username":"name","password":"password"}
			        </p>
			    </body>
			</html>';
		
		die();
	}
	
	function post()
	{
		http_response_code(403);
		die();
	}
	
	function put()
	{
		http_response_code(403);
		die();
	}
	
	function delete()
	{
		http_response_code(403);
		die();
	}
}