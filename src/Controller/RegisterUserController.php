<?php

namespace Controller;

use Enum\Role;
use Model\User;
use Webmozart\Assert\Assert;
use App\Trait\ErrorTrait;
class RegisterUserController
{
    use ErrorTrait;
    public function __construct(private User $user)
    {
    }

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = Role::USER->value; // Default role

        $result = $this->register($name, $email, $password, $role);
        echo $result;
        exit;
    }

    private function register(string $name, string $email, string $password, string $role)
    {
        $errors = [];
        try {
            Assert::notEmpty($name, "Please enter your name");
            Assert::string($name, "Name must be a string");
        } catch (\InvalidArgumentException $e) {
            $errors['name'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($email, "Please enter your email");
            Assert::email($email, "Please enter a valid email");
        } catch (\InvalidArgumentException $e) {
            $errors['email'] = $e->getMessage();
        }

        try {
            Assert::notEmpty($password, "Please enter your password");
            Assert::minLength($password, 5, "Password must be more than 5 characters");
            // Assert::regex($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/", "Password must contain at least one uppercase letter, one lowercase letter, one number and one special character");
        } catch (\InvalidArgumentException $e) {
            $errors['password'] = $e->getMessage();
        }

        if (!empty($errors)) {
            return $this->generateErrorHtml($errors);
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $existingUser = $this->user->getUser($email);
            if ($existingUser) {
                throw new \Exception("Email is already taken");
            }

            $this->user->createUser($name, $email, $hashedPassword, $role);
            return '<div class="text-green-500">User registered successfully. Redirecting to login...</div>'
                 . '<script>setTimeout(function(){ window.location.href = "/login"; }, 2000);</script>';
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
}