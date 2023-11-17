# Crimes

Endpoint: `/crimes`

## Details

The crimes resource represents possible crimes that can be committed in a report.

## Crime Object

| Field               | Description                                   |
|---------------------|-----------------------------------------------|
| crime_code `int`    | Uniquely identifies a crime, through its code |
| crime_desc `string` | The crime's description                       |

## Operations

### Get a list of crimes

Returns a list of possible crimes committed in reports.

`GET /crimes`

#### Parameters

| Field                              | Description                                                  |
|------------------------------------|--------------------------------------------------------------|
| **crime_desc** `string` *optional* | A filter, to find which crimes has this specific description |

#### Returns

An object with a `data` property that contains an array of crime objects

### Get details about a specific crime

Returns a crime with the specified crime code

`GET /crimes/{crime_code}`

#### Parameters

No parameters

#### Returns

An crime object with the specified crime code

### Create a crime

`POST /crimes`

#### Parameters

No parameters

#### Request Body

| Field                          | Description                                   |
|--------------------------------|-----------------------------------------------|
| crime_code `int` *required*    | Uniquely identifies a crime, through its code |
| crime_desc `string` *required* | The crime's description                       |

#### Returns

Status indicating whether the crime was successfully created or not

### Delete a crime

Deletes a crime with the specified crime code

`DELETE /crimes/{crime_code}`

#### Parameters

No parameters

#### Returns

Status indicating whether the crime was successfully deleted or not

### Update a crime

Updates a crime with the specified crime code, with the specified data

`PUT /crimes/{crime_code}`

#### Parameters

No parameters

#### Request Body

| Field                          | Description                                   |
|--------------------------------|-----------------------------------------------|
| crime_code `int` *required*    | Uniquely identifies a crime, through its code |
| crime_desc `string` *required* | The crime's description                       |

#### Returns

Status indicating whether the crime was successfully updated or not
