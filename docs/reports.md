# Crimes

Endpoint: `/reports`

## Table of Contents

- [Crimes](#crimes)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Incident Object](#incident-object)
  - [Location Object](#location-object)
  - [Report Object](#report-object)
  - [1. Get a list of reports](#1-get-a-list-of-reports)
  - [2. Get report details](#2-get-report-details)
  - [3. Get report victims](#3-get-report-victims)
  - [4. Get report criminals](#4-get-report-criminals)
  - [5. Get report police officers](#5-get-report-police-officers)
  - [6. Get report crimes](#6-get-report-crimes)
  - [7. Get report modus codes](#7-get-report-modus-codes)
  - [8. Get report weather](#8-get-report-weather)
  - [9. Get distance between two reports](#9-get-distance-between-two-reports)
  - [10. Create a report](#10-create-a-report)
  - [11. Update a report](#11-update-a-report)
  - [12. Delete a report](#12-delete-a-report)

## Details

The reports object represents crime reports that have been filed. A report contains information about the crimes that were committed, the time and location, and those who were involved.

## Incident Object

Used in the report to indicate time information

```json
{
  "reported_time": "2020-02-22 12:00:00",
  "occurred_time": "2020-02-19 12:00:00"
}
```

| Field                    | Description                          |
|--------------------------|--------------------------------------|
| reported_time `DateTime` | Time when the report was reported    |
| occured_time `DateTime`  | Time when the report was carried out |

## Location Object

Used in the report to indicate location details

```json
{
  "district_id": "932",
  "address": "14700 FRIAR ST",
  "cross_street": "",
  "area_name": "Van Nuys",
  "latitude": "34.1857",
  "longitude": "-118.4574"
}
```

| Field                 | Description                                        |
|-----------------------|----------------------------------------------------|
| district_id `numeric` | ID of the [District](districts.md#district-object) |
| address `string`      | Street name                                        |
| cross_street `string` | The street it crosses. Will often be empty         |
| area_name `string`    | The name of the area                               |
| longitude `float`     | Longitude component of the location                |
| latitude `float`      | Latitude component of the location                 |

## Report Object

```json
{
  "report_id": 1,
  "last_update": "2020-02-21 19:00:00",
  "report_status": "IC",
  "fatalities": 0,
  "case_status": "Solved",
  "premise": "MULTI-UNIT DWELLING (APARTMENT, DUPLEX, ETC)",
  "weapon_id": null,
  "crime_codes": [ 354 ],
  "criminal_ids": [ 1 ],
  "modus_codes": [ "1501", "1822" ],
  "police_ids": [ 5 ],
  "victim_ids": [ 1 ],
  "incident": {
    "reported_time": "2020-02-22 12:00:00",
    "occurred_time": "2020-02-19 12:00:00"
  },
  "location": {
    "district_id": "932",
    "address": "14700 FRIAR ST",
    "cross_street": "",
    "area_name": "Van Nuys",
    "latitude": "34.1857",
    "longitude": "-118.4574"
  }
},
```

| Field                   | Description                                                                                           |
|-------------------------|-------------------------------------------------------------------------------------------------------|
| report_id `int`         | Auto-incrementing ID                                                                                  |
| last_update `DateTime`  | When the crime was last updated                                                                       |
| report_status `string`  | Details on the report status. Can be `IC` or `AO`                                                     |
| fatalities `int`        | Number of fatalities in the report                                                                    |
| case_status `string`    | The status of the case, can be `Solved`, `Unsolved`, `Open`                                           |
| premise `string`        | Description of where the crime took place                                                             |
| weapon_id `int`         | The ID of the [Weapon](weapons.md#weapon-object) used in the report                                   |
| crime_codes `int[]`     | Array of [Crime](crimes.md#crime-object) IDs committed in the report                                  |
| criminal_ids `int[]`    | Array of [Criminal](criminals.md#criminal-object) IDs who were involved in the report                 |
| modus_codes `numeric[]` | Array of [Modus](modi.md#modus-object) codes associated with the report                               |
| police_ids `int[]`      | Array of [Police](police.md#police-object) IDs who were involved in the report                        |
| victim_ids `int[]`      | Array of [Victim](victims.md#victim-object) IDs who were involved in the report                       |
| incident `Incident`     | Instance of an [Incident](#incident-object), which date and time information                          |
| location `Location`     | Instance of a [Location](#location-object), which includes the latitude and longitude of the location |

## 1. Get a list of reports

`GET /reports`

**<u>Parameters</u>**

| Field                                  | Description                                  |
|----------------------------------------|----------------------------------------------|
| from_last_update `DateTime` *optional* | Filter for lower range of last_update        |
| to_last_update `DateTime` *required*   | Filter for upper range of last_update        |
| fatalities `int` *optional*            | Filter for exact number of fatalities        |
| criminal_count `int` *optional*        | Filter for exact number of criminals         |
| victim_count `int` *optional*          | Filter for exact number of victims           |
| crime_code `int` *optional*            | Filter for reports including this crime code |
| modus_code `string` *optional*         | Filter for reports including this modus code |
| premise `string` *optional*            | Filter for reports including this premise    |

**<u>Returns</u>**: A list of [Report](reports.md#report-object) objects that match the filters

## 2. Get report details

`GET /reports/{report_id}`

**<u>Parameters</u>**: None

**<u>Returns</u>**: A [Report](reports.md#report-object) object for the given ID

## 3. Get report victims

`GET /reports/{report_id}/victims`

**<u>Parameters</u>**

| Field                          | Description                                               |
|--------------------------------|-----------------------------------------------------------|
| first_name `string` *optional* | Filter for victims containing this value their first name |
| last_name `string` *optional*  | Filter for victims containing this value their last name  |
| age `int` *optional*           | Filter for victims having this age                        |
| descent `char` *optional*      | Filter for victims having this descent                    |
| sex `M\|F\|X` *optional*       | Filters for victims having this sex                       |

**<u>Returns</u>**: An array of [Victim](victims.md#victim-object) objects that were involved in the report,
and match the filters

## 4. Get report criminals

`GET /reports/{report_id}/criminals`

**<u>Parameters</u>**

| Field                          | Description                                                 |
|--------------------------------|-------------------------------------------------------------|
| first_name `string` *optional* | Filter for criminals containing this value their first name |
| last_name `string` *optional*  | Filter for criminals containing this value their last name  |
| age `int` *optional*           | Filter for criminals having this age                        |
| descent `char` *optional*      | Filter for criminals having this descent                    |
| sex `M\|F\|X` *optional*       | Filters for criminals having this sex                       |
| is_arrested `bool` *optional*  | Filters for criminals that are arrested                     |

**<u>Returns</u>**: An array of [Criminal](criminals.md#criminal-object) objects that were involved in the report

## 5. Get report police officers

`GET /reports/{report_id}/police`

**<u>Parameters</u>**

| Field                                | Description                                                       |
|--------------------------------------|-------------------------------------------------------------------|
| first_name `string` *optional*       | Filter for police officers containing this value their first name |
| last_name `string` *optional*        | Filter for police officers containing this value their last name  |
| from_join_date `DateTime` *optional* | Filter for police officers joining after this date                |
| to_join_date `DateTime` *optional*   | Filter for police officers joining before this date               |
| rank `string` *optional*             | Filter for police officers having this rank                       |

**<u>Returns</u>**: A list of [Police](police.md#police-object) objects that were involved in the report

## 6. Get report crimes

`GET /reports/{report_id}/crimes`

**<u>Parameters</u>**

| Field       | Description                                                  |
|-------------|--------------------------------------------------------------|
| description | Filter for crimes containing this value in their description |

**<u>Returns</u>**: A list of [Crime](crimes.md#crime-object) objects that were committed in the report

## 7. Get report modus codes

`GET /reports/{report_id}/modi`

**<u>Parameters</u>**

| Field       | Description                                                       |
|-------------|-------------------------------------------------------------------|
| description | Filter for modus codes containing this value in their description |

**<u>Returns</u>**: A list of [Modus](modi.md#modus-object) objects that were associated with the report

## 8. Get report weather

`GET /reports/{report_id}/weather`

**<u>Parameters</u>**

| Field                                            | Description                                   |
|--------------------------------------------------|-----------------------------------------------|
| temperature_unit `celcius\|farenheit` *optional* | The unit of measurement for the temperature   |
| precipitation_unit `mm\|inch` *optional*         | The unit of measurement for the precipitation |

**<u>Returns</u>**: Weather information at the time and location of the report

## 9. Get distance between two reports

`GET /reports/{report_id}/distance`

**<u>Parameters</u>**

| Field                    | Description                                              |
|--------------------------|----------------------------------------------------------|
| to `int` *required*      | The report to calculate the distance to                  |
| unit `km\|mi` *optional* | The unit of measurement for the distance, defaults to km |

**<u>Returns</u>**: Distance information for the two reports

## 10. Create a report

`POST /reports`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

Provide a `Report` object in the body, with the report_id excluded for report creation

| Field                   | Description                                                                                           |
|-------------------------|-------------------------------------------------------------------------------------------------------|
| last_update `DateTime`  | When the crime was last updated                                                                       |
| report_status `string`  | Details on the report status. Can be `IC` or `AO`                                                     |
| fatalities `int`        | Number of fatalities in the report                                                                    |
| case_status `string`    | The status of the case, can be `Solved`, `Unsolved`, `Open`                                           |
| premise `string`        | Description of where the crime took place                                                             |
| weapon_id `int`         | The ID of the [Weapon](weapons.md#weapon-object) used in the report                                   |
| crime_codes `int[]`     | Array of [Crime](crimes.md#crime-object) IDs committed in the report                                  |
| criminal_ids `int[]`    | Array of [Criminal](criminals.md#criminal-object) IDs who were involved in the report                 |
| modus_codes `numeric[]` | Array of [Modus](modi.md#modus-object) codes associated with the report                               |
| police_ids `int[]`      | Array of [Police](police.md#police-object) IDs who were involved in the report                        |
| victim_ids `int[]`      | Array of [Victim](victims.md#victim-object) IDs who were involved in the report                       |
| incident `Incident`     | Instance of an [Incident](#incident-object), which date and time information                          |
| location `Location`     | Instance of a [Location](#location-object), which includes the latitude and longitude of the location |

**<u>Returns</u>**: Status indicating whether the report was successfully created or not

## 11. Update a report

`PUT /reports/{report_id}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

Provide a `Report` object in the body, with the report_id included for report update

| Field                   | Description                                                                                           |
|-------------------------|-------------------------------------------------------------------------------------------------------|
| last_update `DateTime`  | When the crime was last updated                                                                       |
| report_status `string`  | Details on the report status. Can be `IC` or `AO`                                                     |
| fatalities `int`        | Number of fatalities in the report                                                                    |
| case_status `string`    | The status of the case, can be `Solved`, `Unsolved`, `Open`                                           |
| premise `string`        | Description of where the crime took place                                                             |
| weapon_id `int`         | The ID of the [Weapon](weapons.md#weapon-object) used in the report                                   |
| crime_codes `int[]`     | Array of [Crime](crimes.md#crime-object) IDs committed in the report                                  |
| criminal_ids `int[]`    | Array of [Criminal](criminals.md#criminal-object) IDs who were involved in the report                 |
| modus_codes `numeric[]` | Array of [Modus](modi.md#modus-object) codes associated with the report                               |
| police_ids `int[]`      | Array of [Police](police.md#police-object) IDs who were involved in the report                        |
| victim_ids `int[]`      | Array of [Victim](victims.md#victim-object) IDs who were involved in the report                       |
| incident `Incident`     | Instance of an [Incident](#incident-object), which date and time information                          |
| location `Location`     | Instance of a [Location](#location-object), which includes the latitude and longitude of the location |


**<u>Returns</u>**: Status indicating whether the report was successfully updated or not

## 12. Delete a report

`DELETE /reports/{report_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the report was successfully deleted or not
