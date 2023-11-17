# Districts

Endpoint: `/districts`

## Table of Contents

-[Districts](districts)
    - [Table of Contents](#table-of-contents)
    - [Details](#details)
    - [District Object](#district-object)

## Details

The districts represents the available reporting district in the city of Los Angeles

## District Object

```json
{
  "district_id": "932",
  "st_name": "Van Nuys Division",
  "bureau": "VALLEY BUREAU",
  "precinct": 9,
  "omega_label": "LAPD 0932",
  "station": "VAN NUYS"
}
```

| Field               | Description                                   |
|---------------------|-----------------------------------------------|
| district_id `int`   | Uniquely identifies a district, through its id |
| st_name `string`    | The district's station division name          |
| bureau `string`     | The bureau of that district                   |
| precinct `string`    | The precinct of that district                 |
| omega_label `string` | Label of the district by combining the police department and district id |
| station `string` | The district's station name |