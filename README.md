### Inpsyde wordpress plugin

- This a technical assignment applied for [inpsyde gmbh](https://inpsyde.com/). 

#### Useful links

* [Inpsyde PHP Coding Standards](https://github.com/inpsyde/php-coding-standards)
* [Unit Tests for PHP code … Without WordPress Loading – Part 1](https://inpsyde.com/en/php-unit-tests-without-wordpress)
* [Brain Monkey test utility for PHP and Worddress](https://brain-wp.github.io/BrainMonkey/)

#### Requirements
* PHP 7.2+.
* Composer.

#### Installation

1. Download a fresh copy from wordpress from [here](https://wordpress.org/download/).
2. Extract the compressed folder and goto the root of project then run this command ``` php -S localhost:4321```, it will help you to quick serve it on the localhost:4321 and definitely you are allowed to 
use another port if it's was reserved.
3. Continue the normal installation by creating the database and add the username and password.
4. After the installation you have to move to ```cd wp-content/plugins``` or wherever the plugin directory 
and run this command ```git clone git@github.com:bafi/inpsyde.git``` to clone the plugin.

- I know this dig in details, but to avoid any errors might occurred while installation.
### Usage

1. Once you activate the plugin you will find the configuration page in the menu list
 `/wp-admin/admin.php?page=inpsyde-configuration` to specify the  **endpoint** and the **frontpage URI**.
2. Don't forget to fire permalink to flush and rewrite the rules for the custom frontpage URI.
3. Then you can access the frontpage like `http://localhost:4321/[FRONTPAGE_URI]`.

### Testing

- To run the unit testing you have to run this command first to install the composer packages
```composer install```. after that you are ready to run the unit testing through
 this command ```composer run-script test```
  
 