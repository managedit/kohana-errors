# Example Application Controller

	class Controller_Users extends Controller {
		public function action_profile()
		{
			$user_id = $this->request->param('id');

			$user = ORM::factory('user', $user_id)->find();

			if ( ! $user->loaded())
				throw new HTTP_Exception_404('Unable to find a user with ID :user_id', array(':user_id' => $user_id));

			$this->response->body(View::factory('user/profile', array('user' => $user));
		}
	}

# Example Error Controller

	class Controller_Errors extends Kohana_Controller_Errors {
		public function action_404()
		{
			$requested_url = $this->failed_request->url();
			$error_message = $this->exception->getMessage();

			$this->response->status(404);
			$this->response->body(View::factory('errors/404', array('requested_url' => $requested_url, 'error_message' => $error_message));
		}
	}

# Example 404 View

	<html>
		<head>
			<title>404 - Page not found</title>
		</head>
		<body>
			<p>The requested URL (<?php echo $requested_url; ?>) could not be found, the error message was <?php echo $error_message; ?></p>
		</body>
	</html>
