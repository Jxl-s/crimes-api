# Districts

Endpoint: `/districts`

## Table of Contents

- [Districts](#districts)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [District Object](#district-object)
  - [1. Get a list of districts](#1-get-a-list-of-districts)
  - [2. Get district information](#2-get-district-information)
  - [3. Get district reports](#3-get-district-reports)
  - [4. Get district police](#4-get-district-police)
  - [5. Create a district](#5-create-a-district)
  - [6. Delete a district](#6-delete-a-district)
  - [7. Update a district](#7-update-a-district)

## Details

Returns a list of reporting districts in the city of Los Angeles.

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

| Field                | Description                                                              |
|----------------------|--------------------------------------------------------------------------|
| district_id `int`    | Uniquely identifies a district, through its id                           |
| st_name `string`     | The district's station division name                                     |
| bureau `string`      | The bureau of that district                                              |
| precinct `string`    | The precinct number of that district                                     |
| omega_label `string` | Label of the district by combining the police department and district id |
| station `string`     | The district's station name                                              |

## 1. Get a list of districts

`GET /districts`

**<u>Parameters</u>**

| Field                            | Description                                                         |
|----------------------------------|---------------------------------------------------------------------|
| **bureau** `string` *optional*   | A filter, to find which districts has this specific bureau          |
| **precinct** `string` *optional* | A filter, to find which districts has this specific precinct number |

**<u>Returns</u>**: An array of [District](#district-object) objects that match the filters

## 2. Get district information

Returns a district with the specified district id

`GET /district/{district_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: An district object with the specified district id

## 3. Get district reports

Returns a list of reports with the specified district id

`GET /district/{district_id}/reports`

| Field                   | Description                                                                                                     |
|-------------------------|-----------------------------------------------------------------------------------------------------------------|
| report_id `int`         | Auto-incrementing ID                                                                                            |
| last_update `DateTime`  | When the crime was last updated                                                                                 |
| report_status `string`  | Details on the report status. Can be `IC` or `AO`                                                               |
| fatalities `int`        | Number of fatalities in the report                                                                              |
| case_status `string`    | The status of the case, can be `Solved`, `Unsolved`, `Open`                                                     |
| premise `string`        | Description of where the crime took place                                                                       |
| weapon_id `int`         | The ID of the [Weapon](weapons.md#weapon-object) used in the report                                             |
| crime_codes `int[]`     | Array of [Crime](crimes.md#crime-object) IDs committed in the report                                            |
| criminal_ids `int[]`    | Array of [Criminal](criminals.md#criminal-object) IDs who were involved in the report                           |
| modus_codes `numeric[]` | Array of [Modus](modi.md#modus-object) codes associated with the report                                         |
| police_ids `int[]`      | Array of [Police](police.md#police-object) IDs who were involved in the report                                  |
| victim_ids `int[]`      | Array of [Victim](victims.md#victim-object) IDs who were involved in the report                                 |
| incident `Incident`     | Instance of an [Incident](reports.md#incident-object), which date and time information                          |
| location `Location`     | Instance of a [Location](reports.md#location-object), which includes the latitude and longitude of the location |

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: An list of report objects with the specified district id

## 4. Get district police

Returns a list of police with the specified district id

`GET /district/{district_id}/police`

| Field                                | Description                                                       |
|--------------------------------------|-------------------------------------------------------------------|
| first_name `string` *optional*       | Filter for police officers containing this value their first name |
| last_name `string` *optional*        | Filter for police officers containing this value their last name  |
| from_join_date `DateTime` *optional* | Filter for police officers joining after this date                |
| to_join_date `DateTime` *optional*   | Filter for police officers joining before this date               |
| rank `string` *optional*             | Filter for police officers having this rank                       |

**<u>Returns</u>**: An [police object](police.md#police-object) with the specified badge id

## 5. Create a district

Creates a district with the given information

`POST /crimes`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                           | Description                                                              |
|---------------------------------|--------------------------------------------------------------------------|
| district_id `int` *required*    | Uniquely identifies a district, through its id                           |
| st_name `string` *required*     | The district's station division name                                     |
| bureau `string` *required*      | The bureau of that district                                              |
| precinct `string` *required*    | The precinct number of that district                                     |
| omega_label `string` *required* | Label of the district by combining the police department and district id |
| station `string` *required*     | The district's station name                                              |

**<u>Returns</u>**: Status indicating whether the crime was successfully created or not

## 6. Delete a district

Deletes a district with the specified district id

`DELETE /district/{district_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the crime was successfully deleted or not

## 7. Update a district

Updates a crime with the specified district id, with the specified data

`PUT /district/{crime_code}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                           | Description                                                              |
|---------------------------------|--------------------------------------------------------------------------|
| st_name `string` *optional*     | The district's station division name                                     |
| bureau `string` *optional*      | The bureau of that district                                              |
| precinct `string` *optional*    | The precinct number of that district                                     |
| omega_label `string` *optional* | Label of the district by combining the police department and district id |
| station `string` *optional*     | The district's station name                                              |

**<u>Returns</u>**: Status indicating whether the crime was successfully updated or not