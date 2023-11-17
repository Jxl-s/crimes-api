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

Endpoint: `GET /crimes`




- Get details about a specific crime
- Create a crime
- Delete a crime
- Update a crime