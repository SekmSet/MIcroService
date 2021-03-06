<?php

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class deleteUserAction extends Action
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }

    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        $isId = $this->userRepository->findId($userId);
        $errors = [];
        $delete = null;

        if($isId === null){
            $errors[] = "This user does not exist";
        } else {
            if($this->userRepository->deleteUser($userId) > 0 ) {
                $delete = "Your user account is deleted" ;
            } else {
                $delete = "Impossible to delete this account";
            }
        }

        return $this->respondWithData([
            "errors" => $errors,
            "deleteUser" => $delete,
            'message' => "You are one the route : delete user in delete $userId"
        ]);
    }
}