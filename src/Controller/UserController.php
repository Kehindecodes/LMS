<?php

namespace Controller;

use Model\User;
use Webmozart\Assert\Assert;

class UserController
{
    public function __construct( private User $user )
    {
    }

    public function register ( string $name, string $email, string $password, string $role ){
        try {
            // Input validations
            Assert::notEmpty($name, "Please enter your name");
            Assert::string($name, "name must be a string");
            Assert::notEmpty($email, "Please enter your email");
            Assert::email($email, "Please enter a valid email");
            Assert::notEmpty($password, "Please enter your password");
            Assert::minLength($password, 5, "Password must be more than 5 characters");
            Assert::regex($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/", "Password must contain at least one uppercase letter, one lowercase letter, one number and one special character");
            
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $existingUser = $this->user->getUser($email);
            if ($existingUser) {
                throw new \Exception("Email is already taken");
            }

            $this->user->createUser($name, $email, $hashedPassword, $role);
            return json_encode(['success' => true, 'message' => 'User registered successfully']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}