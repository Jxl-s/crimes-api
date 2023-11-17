# Crimes API - Documentation

## Quickstart

## Authentication and Authorization
The crimes API uses JWT to authenticate requests. You may log in to generate a token. In each consequent request, you must pass in an `Authorization: Bearer <jwt_token>` to send an authenticated request.

**POST /account**: Create an account

```json
{ "email": "your_email", "password": "your_password", "role": "user | admin" }
```

**POST /token**: Generate a token to use the API

```json
{ "email": "your_email", "password": "your_password" }
```

## Resources and Operations

- [Crimes](docs/crimes.md)
- [Criminals](docs/criminals.md)
- [Districts](docs/districts.md)
- [Modi](docs/modi.md)
- [Police](docs/police.md)
- [Reports](docs/reports.md)
- [Victims](docs/victims.md)
- [Weapons](docs/weapons.md)