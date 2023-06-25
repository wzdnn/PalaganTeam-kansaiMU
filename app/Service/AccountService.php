<?php
namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Repository\UserRepository;

class AccountService{
    private UserRepository $userRepository;
    public function __construct() {
        $this->userRepository = new UserRepository(Database::getConnection());
    }


    /**
     * Verified Account
     */
    public function verifiedAccount(string $vkey, string $email): bool{
        try{
            Database::beginTransaction();
            if($emailDB = $this->userRepository->searchVKey($vkey) != null){
                if($this->userRepository->searchVkeyNotVerified($vkey)){
                    if($emailDB == $email){
                        // verified
                        $this->userRepository->verified($vkey);
                        Database::commitTransaction();
                        return true;
                    }else{
                        throw new \Exception('Invalid Data, Please try again later');
                    }
                }else{
                    throw new \Exception('This account already verified');
                }
            }else{
                http_response_code(404);
                throw new \Exception('Invalid Data, Please try again later');
            }
        } catch(\Exception $ex){
            Database::rollbackTransaction();
            throw $ex;
        }
    }

    // private function verifiedValidation()
}