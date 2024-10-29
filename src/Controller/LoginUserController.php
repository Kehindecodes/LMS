<?php

namespace Controller;

use App\Trait\ErrorTrait;
use Model\User;
use Webmozart\Assert\Assert;

class LoginUserController
{
    use ErrorTrait;
    public function __construct(private User $user)
    {
    }
    private function login(string $email, string $password)
    {
        $errors = [];

        try {
            Assert::notEmpty($email, "Please enter your email");
            Assert::email($email, "Please enter a valid email");
        } catch (\InvalidArgumentException $e) {
            $errors['email'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($password, "Please enter your password");
        } catch (\InvalidArgumentException $e) {
            $errors['password'] = $e->getMessage();
        }

        if (!empty($errors)) {
            return $this->generateErrorHtml($errors);
        }

        try {
            $user = $this->user->getUser($email);
            if (!$user || !password_verify($password, $user['password'])) {
                throw new \Exception("Invalid email or password");
            }
            
            // Start session and set user data
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];

            return '<div class="text-green-500">Login successful. Redirecting...</div>'
                 . '<script>setTimeout(function(){ window.location.href = "/"; }, 2000);</script>';
        } catch (\Exception $e) {
            return $this->generateErrorHtml(['general' => $e->getMessage()]);
        }
    }

    // private function generateErrorHtml(array $errors)
    // {
    //     $html = '';
    //     foreach ($errors as $field => $error) {
    //         $html .= "<p id='{$field}-error' class='text-red-500 text-sm mt-1'>{$error}</p>";
    //     }
    //     return $html;
    // }

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';   

        $result = $this->login($email, $password);
        echo $result;
        exit;
    }
}