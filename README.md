# crimes-api

Project for 420-511-VA (Web Services)

This is a RESTful web API that follows REST principles, implements error handling, validation, filtering, pagination, sorting, content negotiation, logging, identity management, versioning, and more.

## Getting Started

Run the following command the v1 and v2 folders to install the project dependencies. Use XAMPP to run the project.

```shell
.\composer.bat install
```

Create a config.env file in the v1 and v2 folders. Each config.env file consist of:

```
SECRET_KEY=insertyourkeyhere
```

## Common Issues

`The zip extension and unzip command are both missing, skipping.`

- Uncomment the `;extension=zip` line in your `php.ini` file.

## Documentation
The project's documentation can be viewed [here](docs/README.md)
