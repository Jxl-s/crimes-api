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

#### Endpoint

`GET /crimes`

#### Parameters

| Field                              | Description                                                  |
|------------------------------------|--------------------------------------------------------------|
| **crime_desc** `string` *optional* | A filter, to find which crimes has this specific description |

#### Returns

An object with a `data` property that contains an array of crime objects


### Get details about a specific crime
### Create a crime
### Delete a crime
### Update a crime