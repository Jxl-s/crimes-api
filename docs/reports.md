# Crimes
Endpoint: `/reports`

## Table of Contents
- [Crimes](#crimes)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Incident Object](#incident-object)
  - [Location Object](#location-object)
  - [Report Object](#report-object)

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