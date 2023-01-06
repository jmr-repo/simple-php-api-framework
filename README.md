# APIOLOGY - PHP API FRAMEWORK

| repository: https://github.com/jmr-repo/simple-php-api-framework

Change **docker-compose.yml** _port_ to a custo port not used.

If required, remember to change the name of the containaer

## Setup

There are different ways to setup

### 1. Create a Reource

- Add the name of the method to be called in v\*.php, which will be the resource
- Add Function Name in v\*.php with the following code in it

```php
public function sample($_data){
    // assign resource name to a variable
    $resource = "sample";
    $file = "apiology/version/resources/" .$resource. ".php";
    // require file
    require $file;
    // call by namespace
    $module = "Apiology\\Apiology\\version\\resources\\" .ucfirst($resource). "";
    // instantiate object
    $module = new $module();
    // call method (resource)
    $module->sample($_data);
}

```

### 2. Creating a new version

- Create a function inside v*.php (where * means number of the version)

&nbsp;

---

&nbsp;

## How to use the sendmail utility

In this example we will use the mail resource prebuilt `mail.php`, but is just for demo purposes.

The instance can be instantiate inside any resource

### 1. Call the namespace

```php
// Email Class
use Apiology\Apiology\classes\email as Email;
```

### 2. Instance the email utility

Inside the resource used ie: `mail.php` call the email instance:

```php
// Insantiate Email Object
$this->sendEmail = new Email();
```

### 3. Fulfill the settings array with valid parameters

```php
/**
 * Settings [array]
 * host [string] = server ie: mail.domain.com
 * username [string] = user account ie: myemail@domain.com
 * password [string] = account password
 * port [int] = smtp outgoing host port ie: 465
 * from-email [string] = same as username
 * from-name [string] = user name (this goes what's enclosed in the <> tags) ie: John Doe
 * to [string] = email to send
 * reply-to [string] = add reply-to email
 * cc [string] = add Cc email
 * bcc [string] = add Bcc email
 * subject [string] = text (no more than 9 words or 60 characters)
 * body [string] = Use the templateBody function (returns base64 string)
 */
$this->settings['host'] = "mail.domain.com";
$this->settings['username'] = "myemail@domain.com";
$this->settings['password'] = "aVeryStrongPassword";
$this->settings['port'] = 465;
$this->settings['from-email'] = $this->settings['username'];
$this->settings['reply-to'] = "replyto@domain.com";
$this->settings['cc'] = "cc@domain.com";
$this->settings['bcc'] = "bcc@domain.com";
```

### 4. Customize templateBody function

This function is the email body to be sent. It is written to be used in any email software and as HTML.

It accepts 3 parameters by default, but it is 100% customizable

This function return a base64 string and it is also part of the `$this->settings['body']` array

```php
/**
 * this function is made to send just a simple message
 * function templateBody expects an array as arguments to be used inside the template
 * logo [string] = logo url
 * message [string] = message to be sent
 * domain [string] = domain for the email template footer
 */
$this->settings['body'] = self::templateBody(array(
    "logo" => "https://domain.com/logo.png",
    "message" => "lorem ipsum dolor it samet.",
    "domain" => "www.domain.com"
));
```

### 5. Send Message

Use a separate private function to send an email using [PHPMailer](https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjd3c-L4q78AhVBJrkGHd7lDyMQFnoECA0QAQ&url=https%3A%2F%2Fgithub.com%2FPHPMailer%2FPHPMailer&usg=AOvVaw3uU1KjcPnp3XeJLvX06U0g) which returns `true` or `false`.

In the example we used the POST method with the follwing json settings

```json
{
  "to-email": "email@domain.com",
  "to-name": "User Name",
  "subject": "Subject no longer than 9 words",
  "email-message": "A nice pretty message"
}
```

Evaluate the call to the `sendMail()` method inside the `Email` class

```php
/**
 * Call te sendNewEmail method (function) inside a conditional
 * the sendMail() function return true or false, depending
 * if the email was sent or not
 */
if(self::sendNewEmail($this->settings)){
    $this->json['response'] = "Your email was sent succesfully";
} else {
    $this->json['response'] = "Your email was not sent";
}
```
