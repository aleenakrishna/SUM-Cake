<?php
if (Configure::read() == 0):
	$this->cakeError('error404');
endif;
?>
<h2><?php echo 'Documentation for SUM-Cake.'; ?></h2>
<br>
<div width="200px">
	<center>
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/Text" property="dct:title" rel="dct:type">SUM-Cake</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://blockchuck.com" property="cc:attributionName" rel="cc:attributionURL">Chuck Burgess</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.<br />Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://github.com/cdburgess/SUM-Cake" rel="dct:source">github.com</a>.
	</center>
</div>
<?php
if (Configure::read() > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p>
	<?php
		if (is_writable(TMP)):
			echo '<span class="notice success">';
				__('Your tmp directory is writable.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				__('Your tmp directory is NOT writable.');
			echo '</span>';
		endif;
	?>
</p>
<p>
	<?php
		$settings = Cache::settings();
		if (!empty($settings)):
			echo '<span class="notice success">';
					printf(__('The %s is being used for caching. To change the config edit APP/config/core.php ', true), '<em>'. $settings['engine'] . 'Engine</em>');
			echo '</span>';
		else:
			echo '<span class="notice">';
					__('Your cache is NOT working. Please check the settings in APP/config/core.php');
			echo '</span>';
		endif;
	?>
</p>
<p>
	<?php
		$filePresent = null;
		if (file_exists(CONFIGS.'database.php')):
			echo '<span class="notice success">';
				__('Your database configuration file is present.');
				$filePresent = true;
			echo '</span>';
		else:
			echo '<span class="notice">';
				__('Your database configuration file is NOT present.');
				echo '<br/>';
				__('Rename config/database.php.default to config/database.php');
			echo '</span>';
		endif;
	?>
</p>
<?php
	App::import('Core', 'Validation');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><span class="notice">';
		__('PCRE has not been compiled with Unicode support.');
		echo '<br/>';
		__('Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
		echo '</span></p>';
	}
?>
<?php
if (isset($filePresent)):
	if (!class_exists('ConnectionManager')) {
		require LIBS . 'model' . DS . 'connection_manager.php';
	}
	$db = ConnectionManager::getInstance();
	@$connected = $db->getDataSource('default');
?>
<p>
	<?php
		if ($connected->isConnected()):
			echo '<span class="notice success">';
	 			__('Cake is able to connect to the database.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				__('Cake is NOT able to connect to the database.');
			echo '</span>';
		endif;
	?>
</p>
<?php endif;?>
<h3><?php __('Editing this Page'); ?></h3>
<p>
<?php
__('To change the content of this page, modify: APP/views/elements/documentation.ctp.');
?>
</p>

<br />
<h3><?php __('Documentation'); ?></h3>
<p>
	This project is to help you get your site up and running quickly with user registration. It is not intended to
	be a package that contains all of the bells and whistles. It will be kept simple enough that it will be a good
	foundation for someone to build from.
</p><br />
<p>
	If you think there is some functionality this project could benefit from, please feel free to submit it. Keep
	in mind the goal to keep it simple. If I feel the functionality is worth adding, I will do so.
</p><br />
<p>
	The code should be an obvious setup. Drop the entire application into cake as the beginning of your app, load
	the sql (APP/config/schema/users_schema.sql) into your database, configure the database, and point to /users/login
	and you will be off and running. What I want to document here is some of the functionality that may NOT be so
	obvious.
</p><br />
<h4><b><?php __('User Validation'); ?></b></h4>
<p>
	Once a user registers, an email will be sent to that user with a validation link. The email content can be modified
	and is stored in the email directory (APP/views/elements/email/html/welcome.ctp & APP/views/elements/email/text/welcome.ctp).
	The email will be sent using the SystemEmail and CompanyName variables from the bootstrap file: APP/config/bootstrap.
</p><br />
<p>
	Once a user clicks on the validation link in the email, the database is updated and the user is directed to the
	login page. They will now be able to login to the site. To auto enable logins so the user does NOT have to be
	validated through a validation link, set autoValidate to true in the bootstrap file. If you do not want to send a
	welcome email at all, you can also disable that in the bootstrap file.
</p><br />

<p>
	If you need to use SMTP for email delivery, there is an option in the bootstrap that will allow you to enable SMTP
	delivery and set all of the variables required. By setting the required variables and turning smtpEmailOn = true, 
	the system will send the emails via SMTP instead of SENDMAIL.
</p><br />

<h4><b><?php __('Permissions'); ?></b></h4>
<p>
	As you start adding controllers and methods to your application, you will need to give the users permissions if they
	are going to access them. You can do this one of two ways.
</p><br />
<p>
	<b>Global Access:</b> If you want to provide access to a specific controller or method, you simply add it inside the
	controller. For controller wide access add $this->Auth->allow('*'); to your beforeFilter() method in the controller.
	For a specific method add $this->Auth->allow('method1','method2','etc.'); to your beforeFilter() method in the controller.
</p><br />
<p>
	<b>Registered User Access:</b> To give access to specific roles, use the permissions section of the website. As you
	add controllers and methods, you simply provide access by going to New Permission link in the permissions section
	of the website. It will allow you to select the Name of the permission and the Role to assign the permission to.
	(http://SEM-Cake/admin/permissions)
</p><br />

<br />
<h3><?php __('More about Me'); ?></h3>
<p>
<?php __('I enjoy writing code. It is my passion. I learn more every day.'); ?>
</p>

<ul>
	<li><a href="http://blogchuck.com/"><?php __('My Blog'); ?> </a>
	<ul><li><?php __('My ramblings about stuff'); ?></li></ul></li>
	<li><a href="http://github.com/cdburgess"><?php __('My GitHub'); ?> </a>
	<ul><li><?php __('The code I have posted for public use'); ?></li></ul></li>
	<li><a href="http://code.google.com/p/blogchuck/"><?php __('My Google Code'); ?> </a>
	<ul><li><?php __('More code I have posted for public use'); ?></li></ul></li>
</ul>
