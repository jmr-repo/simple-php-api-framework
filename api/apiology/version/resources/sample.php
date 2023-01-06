<?php

namespace Apiology\Apiology\Version\Resources;

// Headers Class
use Apiology\Apiology\classes\core\http as HTTP;

// Email Class
use Apiology\Apiology\classes\email as Email;

// Resource / Class
class Sample
{

    private $http_response;
    private $json = array();
    private $settings = array();

    public function sample($_data)
    {

        // Instantiate the HTTP response
        $this->http_response = new HTTP();

        // Evaluate depending on the REQUEST METHOD sent
        switch (strtoupper($_SERVER['REQUEST_METHOD'])) {

            case 'GET':
                // TODO
                // sanitize GET parameters
                // $_GET = json_decode(file_get_contents("php://input"),true);

                $this->json['response'] = $_GET;
                break;
            
            case 'POST':
                // TODO
                // sanitize POST parameters
                $_POST = json_decode(file_get_contents("php://input"),true);
                if(is_array($_POST)){
                    $this->settings['to-email'] = htmlspecialchars($_POST["to-email"]);
                    $this->settings['to-name'] = htmlspecialchars($_POST["to-name"]);
                    $this->settings['subject'] = htmlspecialchars($_POST["subject"]);
                    $this->settings['message'] = htmlspecialchars($_POST["email-message"]);

                    if(self::sendNewEmail($this->settings)){
                        $this->json['response'] = "Your email was sent succesfully";
                    } else {
                        $this->json['response'] = "Your email was not sent";
                    }

                } else {
                    $this->json['response'] = "Wrong Input, check again!";
                }
                
                break;
            
            case 'PUT':
                // TODO
                // sanitize GET parameters
                break;
            
            case 'DELETE':
                // TODO
                // sanitize GET parameters
                break;
            
            default:
                // Send default message for any other method not allowed
                $this->json['response'] = "No Valid Method";
                break;
        }

        $this->http_response->httpJsonResponse(200, $this->json);
    }

    private function sendNewEmail($_settings)
    {
        $this->sendEmail = new Email();

        $this->settings['host'] = "mail.domain.com";
        $this->settings['username'] = "no-reply@domain.com";
        $this->settings['password'] = "SuperSecretPassword";
        $this->settings['from'] = $this->settings['username'];
        $this->settings['from-name'] = "No-Reply";
        $this->settings['to'] = $_settings['to-email'];
        $this->settings['to-name'] = $_settings['to-name'];
        $this->settings['reply-to'] = $this->settings['from'];
        $this->settings['reply-to-name'] = $this->settings['from-name'];
        $this->settings['cc'] = false;
        $this->settings['cc-name'] = false;
        $this->settings['subject'] = $_settings['subject'];
        $this->settings['body'] = array();
        $this->settings['body']['logo-url'] = "https://domain.com/logo.png";
        $this->settings['body']['message'] = $_settings['message'];
        $this->settings['body']['domain'] = "www.domain.com";

        return $this->sendEmail->sendEmail($this->settings);
        
    }
}
