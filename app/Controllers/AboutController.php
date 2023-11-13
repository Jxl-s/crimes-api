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
                        ], 
                    ]
                ],
                'Criminals' => [
                    'uri' => '/criminals',
                    'description' => 'Registered criminals',
                    'actions' => [
                        [
                            'uri' => '/criminals/{id}',
                            'description' => 'Get a specific criminal',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/criminals',
                            'description' => 'Get all criminals',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/criminals',
                            'description' => 'Create a new criminal',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/criminals/{id}',
                            'description' => 'Update a specific criminal',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/criminals/{id}',
                            'description' => 'Delete a specific criminal',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Districts' => [
                    'uri' => '/districts',
                    'description' => 'Districts with police stations',
                    'actions' => [
                        [
                            'uri' => '/districts/{id}',
                            'description' => 'Get a specific district',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/districts',
                            'description' => 'Get all districts',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/districts',
                            'description' => 'Create a new district',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/districts/{id}',
                            'description' => 'Update a specific district',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/districts/{id}',
                            'description' => 'Delete a specific district',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Modi' => [
                    'uri' => '/modi',
                    'description' => 'Possible modus codes for crimes',
                    'actions' => [
                        [
                            'uri' => '/modi/{id}',
                            'description' => 'Get a specific modus',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/modi',
                            'description' => 'Get all modi',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/modi',
                            'description' => 'Create a new modus',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/modi/{id}',
                            'description' => 'Update a specific modus',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/modi/{id}',
                            'description' => 'Delete a specific modus',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Police' => [
                    'uri' => '/police',
                    'description' => 'Police officers',
                    'actions' => [
                        [
                            'uri' => '/police/{id}',
                            'description' => 'Get a specific police officer',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/police',
                            'description' => 'Get all police officers',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/police',
                            'description' => 'Create a new police officer',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/police/{id}',
                            'description' => 'Update a specific police officer',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/police/{id}',
                            'description' => 'Delete a specific police officer',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Reports' => [
                    'uri' => '/reports',
                    'description' => 'Reports that are sent',
                    'actions' => [
                        [
                            'uri' => '/reports/{id}',
                            'description' => 'Get a specific report',
                            'method' => 'GET'
                        ],        
                        [
                            'uri' => '/reports/{id}/weather',
                            'description' => 'Get the weather of a specific report',
                            'method' => 'GET'
                        ],                
                        [
                            'uri' => '/reports',
                            'description' => 'Get all reports',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/reports',
                            'description' => 'Create a new report',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/reports/{id}',
                            'description' => 'Update a specific report',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/reports/{id}',
                            'description' => 'Delete a specific report',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Victims' => [
                    'uri' => '/victims',
                    'description' => 'Victims in reports',
                    'actions' => [
                        [
                            'uri' => '/victims/{id}',
                            'description' => 'Get a specific victim',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/victims',
                            'description' => 'Get all victims',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/victims',
                            'description' => 'Create a new victim',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/victims/{id}',
                            'description' => 'Update a specific victim',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/victims/{id}',
                            'description' => 'Delete a specific victim',
                            'method' => 'DELETE'
                        ], 
                    ]
                ],
                'Weapons' => [
                    'uri' => '/weapons',
                    'description' => 'Types of weapons that can be used',
                    'actions' => [
                        [
                            'uri' => '/weapons/{id}',
                            'description' => 'Get a specific weapon',
                            'method' => 'GET'
                        ],                        
                        [
                            'uri' => '/weapons',
                            'description' => 'Get all weapons',
                            'method' => 'GET'
                        ],
                        [
                            'uri' => '/weapons',
                            'description' => 'Create a new weapon',
                            'method' => 'POST'
                        ],
                        [
                            'uri' => '/weapons/{id}',
                            'description' => 'Update a specific weapon',
                            'method' => 'PUT'
                        ],
                        [
                            'uri' => '/weapons/{id}',
                            'description' => 'Delete a specific weapon',
                            'method' => 'DELETE'
                        ], 
                    ]
                ]
            ]
        ];

        return $this->prepareOkResponse($response, $data);
    }
}
