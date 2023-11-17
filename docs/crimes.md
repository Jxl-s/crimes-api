# Crimes
Endpoint: `/crimes`

## Table of Contents

- [Crimes](#crimes)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Crime Object](#crime-object)
  - [1. Get a list of crimes](#1-get-a-list-of-crimes)
  - [2. Get crime information](#2-get-crime-information)
  - [3. Create a crime](#3-create-a-crime)
  - [4. Delete a crime](#4-delete-a-crime)
  - [5. Update a crime](#5-update-a-crime)

## Details

The crimes resource represents possible crimes that can be committed in a report.

## Crime Object

| Field               | Description                                   |
|---------------------|-----------------------------------------------|
| crime_code `int`    | Uniquely identifies a crime, through its code |
| crime_desc `string` | The crime's description                       |

## 1. Get a list of crimes

Returns a list of possible crimes committed in reports.

`GET /crimes`

**<u>Parameters</u>**

| Field                              | Description                                                  |
|------------------------------------|--------------------------------------------------------------|
| **crime_desc** `string` *optional* | A filter, to find which crimes has this specific description |

**<u>Returns</u>**: An object with a `data` property that contains an array of crime objects

## 2. Get crime information

Returns a crime with the specified crime code

`GET /crimes/{crime_code}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: An crime object with the specified crime code

## 3. Create a crime

`POST /crimes`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                          | Description                                   |
|--------------------------------|-----------------------------------------------|
| crime_code `int` *required*    | Uniquely identifies a crime, through its code |
| crime_desc `string` *required* | The crime's description                       |

**<u>Returns</u>**: Status indicating whether the crime was successfully created or not

## 4. Delete a crime

Deletes a crime with the specified crime code

`DELETE /crimes/{crime_code}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the crime was successfully deleted or not

## 5. Update a crime

Updates a crime with the specified crime code, with the specified data

`PUT /crimes/{crime_code}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                          | Description                                   |
|--------------------------------|-----------------------------------------------|
| crime_code `int` *required*    | Uniquely identifies a crime, through its code |
| crime_desc `string` *required* | The crime's description                       |

**<u>Returns</u>**: Status indicating whether the crime was successfully updated or not
