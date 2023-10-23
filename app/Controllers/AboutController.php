<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AboutController extends BaseController
{
    public function handleAboutApi(Request $request, Response $response, array $uri_args)
    {
        $data = [
            'about' => 'This is a Web service that provides crime report information',
            'resources' => [
                'Crimes' => [
                    'uri' => '/crimes',
                    'description' => 'Types of crimes that can be committed',
                    'actions' => [
                        [
                            'uri' => '/crimes/{id}',
                            'description' => 'Get a specific crime',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/crimes',
                            'description' => 'Get all crimes',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/crimes',
                            'description' => 'Create a new crime',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/crimes/{id}',
                            'description' => 'Update a specific crime',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/crimes/{id}',
                            'description' => 'Delete a specific crime',
                            'method' => 'DELETE'
                        ]
                    ]
                ],
                'Criminals' => [
                    'uri' => '/criminals',
                    'description' => 'Registered criminals'
                ],
                'Districts' => [
                    'uri' => '/districts',
                    'description' => 'Districts with police stations'
                ],
                'Modi' => [
                    'uri' => '/modi',
                    'description' => 'Possible modus codes for crimes'
                ],
                'Police' => [
                    'uri' => '/police',
                    'description' => 'Police officers'
                ],
                'Reports' => [
                    'uri' => '/reports',
                    'description' => 'Reports that are sent'
                ],
                'Victims' => [
                    'uri' => '/victims',
                    'description' => 'Victims in reports'
                ],
                'Weapons' => [
                    'uri' => '/weapons',
                    'description' => 'Types of weapons that can be used'
                ]
            ]
        ];

        return $this->prepareOkResponse($response, $data);
    }
}
