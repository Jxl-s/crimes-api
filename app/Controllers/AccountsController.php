<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Models\AccountsModel;

/**
 * A controller class that handles requests for creating new account and 
 * generating JWTs.
 * 
 * @author frostybee
 */
class AccountsController extends BaseController
{
    private $accounts_model = null;

    public function __construct()
    {
        $this->accounts_model = new AccountsModel();
    }
    public function handleCreateAccount(Request $request, Response $response)
    {
        $account_data = $request->getParsedBody();
        // 1) Verify if any information about the new account to be created was included in the 
        // request.
        if (empty($account_data)) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);
        }

        // Before creating the account, verify if there is already an existing one with the provided email.
        if ($this->accounts_model->isAccountExist($account_data['email'])) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Email already taken'], 400);
        }

        // 2) Data was provided, we attempt to create an account for the user.                
        $new_account_id = $this->accounts_model->createAccount($account_data);

        if (!$new_account_id) {
            // 2.a) Failed to create the new account.
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Failed to create new account'], 400);
        }

        // 3) A new account has been successfully created. 
        // Prepare and return a response.  
        return $this->prepareOkResponse($response, ['status' => "success", 'message' => 'Successfully created account!'], 201);
    }

    public function handleGenerateToken(Request $request, Response $response, array $args)
    {
        $account_data = $request->getParsedBody();
        //var_dump($user_data);exit;

        //-- 1) Reject the request if the request body is empty.
        if (empty($account_data)) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'No data was provided in the request.'], 400);
        }

        //-- 2) Retrieve and validate the account credentials.
        $db_account = $this->accounts_model->isPasswordValid($account_data['email'], $account_data['password']);

        //-- 3) Is there an account matching the provided email address in the DB?
        //-- 4) If so, verify whether the provided password is valid.
        //-- 4.a) If the password is invalid --> prepare and return a response with a message indicating the 
        // reason.   
        if (!$db_account) {
            return $this->prepareOkResponse($response, ['error' => true, 'message' => 'Invalid credentials'], 401);
        }

        //-- 5) Valid account detected => Now, we return an HTTP response containing
        // the newly generated JWT.
        // TODO: add the account role to be included as JWT private claims.
        //-- 5.a): Prepare the private claims: user_id, email, and role.

        // Current time stamp * 60 seconds        
        $expires_in = time() + 60; //! NOTE: Expires in 1 minute.
        //!note: the time() function returns the current timestamp, which is the number of seconds since January 1st, 1970
        //-- 5.b) Create a JWT using the JWTManager's generateJWT() method.
        $jwt = JWTManager::generateJWT([
            'user_id' => $db_account['user_id'],
            'email' => $db_account['email'],
            'role' => $db_account['role'],
        ], $expires_in);

        // 5.c) Prepare and return a response with a JSON doc containing the jwt.
        return $this->prepareOkResponse($response, ['status' => "success", 'token' => $jwt, "message" => 'Successfully logged in!'], 201);
    }
}
