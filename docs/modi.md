# modi
Endpoint: `/modi`

## Table of Contents

- [modi](#modi)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Modus Object](#modus-object)
  - [1. Get a list of modi](#1-get-a-list-of-modi)
  - [2. Get modus information](#2-get-modus-information)
  - [3. Create a modus](#3-create-a-modus)
  - [4. Delete a modus](#4-delete-a-modus)
  - [5. Update a modus](#5-update-a-modus)

## Details

The modi resource represents possible modi that can be committed in a report.

## Modus Object

```json
{
    "mo_code": 0100,
    "mo_desc": "Suspect Impersonate"
}
```

| Field              | Description                                                         |
|--------------------|---------------------------------------------------------------------|
| modo_code `int`    | Uniquely identifies a modus, through its code with a 4 digit number |
| modo_desc `string` | The modus's description                                             |

## 1. Get a list of modi

Returns a list of possible modi committed in reports.

`GET /modi`

**<u>Parameters</u>**

| Field                           | Description                                                |
|---------------------------------|------------------------------------------------------------|
| **mo_desc** `string` *optional* | A filter, to find which modi has this specific description |

**<u>Returns</u>**: An array of [Modi](#modus-object) objects that match the filters

## 2. Get modus information

Returns a modus with the specified modus code

`GET /modi/{mo_code}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: An [modus object](#modus-object) with the specified mo code

## 3. Create a modus

Creates a modus with the given information

`POST /modi`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                       | Description                                                         |
|-----------------------------|---------------------------------------------------------------------|
| mo_code `int` *required*    | Uniquely identifies a modus, through its code with a 4 digit number |
| mo_desc `string` *required* | The modus's description                                             |

**<u>Returns</u>**: Status indicating whether the modus was successfully created or not

## 4. Delete a modus

Deletes a modus with the specified modus code

`DELETE /modi/{mo_code}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the modus was successfully deleted or not

## 5. Update a modus

Updates a modus with the specified modus code, with the specified data

`PUT /modi/{mo_code}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                       | Description                                                         |
|-----------------------------|---------------------------------------------------------------------|
| mo_code `int` *required*    | Uniquely identifies a modus, through its code with a 4 digit number |
| mo_desc `string` *required* | The modus's description                                             |

**<u>Returns</u>**: Status indicating whether the modus was successfully updated or not
