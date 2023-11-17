# Crimes API Documentation

## Table of Contents

- [Crimes API Documentation](#crimes-api-documentation)
  - [Table of Contents](#table-of-contents)
  - [Resource Representations](#resource-representations)
  - [Authentication and Authorization](#authentication-and-authorization)
  - [Pagination and Sorting](#pagination-and-sorting)
  - [Resources and Operations](#resources-and-operations)

## Resource Representations

Each request must have the `Accept` header set to `application/json`, because it is the only supported resource representation for this web service.

## Authentication and Authorization
The crimes API uses JWT to authenticate requests. You may log in to generate a token. In each consequent request, you must pass in an `Authorization: Bearer <jwt_token>` to send an authenticated request.

**POST /account**: Create an account

```json
{
    "email": "your_email",
    "password": "your_password",
    "role": "user | admin"
}
```

**POST /token**: Generate a token to use the API

```json
{
    "email": "your_email",
    "password": "your_password"
}
```

## Pagination and Sorting

All collections have support for pagination and sorting. Any request that involves a GET request can contain the following.

| Field | Description | Default |
| --| --| -- |
| **page** `int` *optional* | The page number to view | 1
| **page_size** `int` *optional* | How large a page should be | 10
| **order** `asc\|desc` *optional* | The sort order | asc
| **sort_by** `string` *optional* | The field to sort by, differs per resource | The resource ID

## Resources and Operations

- [Crimes](crimes.md)
- [Criminals](criminals.md)
- [Districts](districts.md)
- [Modi](modi.md)
- [Police](police.md)
- [Reports](reports.md)
- [Victims](victims.md)
- [Weapons](weapons.md)