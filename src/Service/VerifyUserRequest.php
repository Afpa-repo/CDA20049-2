<?php


namespace App\Service;


use App\Repository\UsersRepository;
use App\Security\MealWithAuthenticator;

class VerifyUserRequest
{
    protected $usersRepository;
    protected $authenticator;
    protected $MealWithAuthenticator;

    public function __construct(UsersRepository $usersRepository,MealWithAuthenticator $authenticator,MealWithAuthenticator $MealWithAuthenticator)
    {
        $this->usersRepository = $usersRepository;
        $this->authenticator = $authenticator;
        $this->MealWithAuthenticator = $MealWithAuthenticator;
    }

    /**
     * @param String $userLogin // Mail of the user
     * @param String $userPlainPassword // Plain password to check for the user
     * @return bool // True if it's a match, false otherwise
     */
    function CheckUserCredentials(String $userLogin, String $userPlainPassword)
    {
        // Fetch the user by using the $userLogin from the request to the API
        $user = $this->usersRepository->findOneBy(['email' => $userLogin]);

        // Check if the user exist
        if (is_null($user)){
            return false;
        }else{
            // Check if this user password match the $userPlainPassword using the MealWithAuthenticador password encoder
            return $this->MealWithAuthenticator->checkCredentials(['password' =>$userPlainPassword],$user);
        }
    }
}