<?php

namespace Vanier\Api\Middleware;

use LogicException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;
use UnexpectedValueException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;

use Vanier\Api\Helpers\JWTManager;

class JWTAuthMiddleware implements MiddlewareInterface
{

    public function __construct(array $options = [])
    {
    }

    /**
     * Handle authorization
     *  Create account
     *  Login - get token
     * 
     * To process -> if valid token
     *  handle request (user's action)
     * 
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface $response
     */
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        /*-- 1) Routes to ignore (public routes):
              We need to ignore the routes that enables client applications
              to create account and request a JWT token.
        */
        if($_SERVER["REQUEST_URI"] === "/crimes-api/v1/token" || $_SERVER["REQUEST_URI"] === "/crimes-api/v1/account") {
            return $handler->handle($request); 
        }
        
        // 1.a) If the request's uri contains /account or /token, handle the request:
        //return $handler->handle($request);

        // If not:
        //-- 2) Retrieve the token from the request Authorization's header. 
        $header = $request->getHeader('Authorization');    
        // 3) Parse the token: remove the "Bearer " word.
        if(!$header) {
            throw new HttpUnauthorizedException($request, 'Authorization token is required');
        }
        preg_match('/(?<=Bearer )(?s)(.*$)/', $header[0], $token);

        //-- 4) Try to decode the JWT token
        //@see https://github.com/firebase/php-jwt#exception-handling
        try {
            $decoded = (array) JWT::decode($token[0], new Key($_ENV['SECRET_KEY'], 'HS256'));
        }catch (LogicException $e) {
            // errors having to do with environmental setup or malformed JWT Keys
            throw new LogicException($e, 422);
        } catch (UnexpectedValueException $e) {
            // errors having to do with JWT signature and claims
            throw new UnexpectedValueException($e,400);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e,400);
        } 
        // --5) Access to POST, PUT and DELETE operations must be restricted.
        //     Only admin accounts can be authorized.
        // If the request's method is: POST, PUT, or DELETE., only admins are allowed.
        // throw new HttpForbiddenException($request, 'Insufficient permission!');
        if(($request->getMethod() === 'POST' || $request->getMethod() === 'PUT' || $request->getMethod() === 'DELETE') && $decoded['role'] != "admin") {
            throw new HttpForbiddenException($request, 'Insufficient permission!');
        }

        //-- 6) The client application has been authorized:
        // 6.a) Now we need to store the token payload in the request object. The payload is needed for logging purposes and 
        // needs to be passed to the request's handling callbacks.  This will allow the target resource's callback 
        // to access the token payload for various purposes (such as logging, etc.)        
        // Use the APP_JWT_TOKEN_KEY as attribute name. 

        
        //-- 7) At this point, the client app's request has been authorized, we pass the request to the next
        // middleware in the middleware stack. 
        return $handler->handle($request);
    }
}
