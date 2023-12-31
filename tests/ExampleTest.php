<?php

use Entity\User;
use Symfony\Component\Validator\Validation;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    }

    public function testValidUser()
    {
        $user = new User();
        $user->setUsername('JohnDoe');
        $user->setMail('johndoe@example.com');
        $user->setPassword('strongpassword123');

        $violations = $this->validator->validate($user);

        $this->assertCount(0, $violations);
    }

    public function testInvalidUser()
    {
        $user = new User();
        $user->setUsername('J'); // Trop court
        $user->setMail('invalidemail'); // E-mail invalide
        $user->setPassword('123'); // Trop court

        $violations = $this->validator->validate($user);

        $this->assertGreaterThan(0, $violations->count());
    }

    public function testGravatarUrl()
    {
        $user = new User();
        $user->setMail('johndoe@example.com');
        $expectedUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim('johndoe@example.com'))) . '?s=80';

        $this->assertEquals($expectedUrl, $user->getGravatarUrl());
    }
}
