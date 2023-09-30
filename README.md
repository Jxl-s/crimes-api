# crimes-api

Project for 420-511-VA (Web Services)

## Getting Started

Run the following command to install the project dependencies. Use XAMPP to run the project.

```shell
.\composer.bat install
```

## Testing

Some tests are setup using PHPUnit. You can run the following commands to
run the tests.

```shell
.\phpunit.bat --bootstrap tests/test_config.php --testdox tests
```


## Common Issues

`The zip extension and unzip command are both missing, skipping.`
- Uncomment the `;extension=zip` line in your `php.ini` file.