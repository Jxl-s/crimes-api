# Crimes
Endpoint: `/reports`

## Table of Contents
- [Crimes](#crimes)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Report Object](#report-object)

## Details

The reports object represents crime reports that have been filed. A report contains information about the crimes that were committed, the time and location, and those who were involved.

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


| Field                  | Description                     |
|------------------------|---------------------------------|
| report_id `int`        | Auto-incrementing ID            |
| last_update `DateTime` | When the crime was last updated |
| report_status | |