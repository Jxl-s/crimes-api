# Police

Endpoint: `/police`

- [Police](#police)
  - [Details](#details)
  - [Police Object](#police-object)
  - [1. Get a list of police](#1-get-a-list-of-police)
  - [2. Get police information](#2-get-police-information)
  - [3. Get police reports](#3-get-police-reports)
  - [4. Create police](#4-create-police)
  - [5. Delete a police officer](#5-delete-a-police-officer)
  - [6. Update a police officer](#6-update-a-police-officer)

## Details

The police resource represents police officers who are working for the LAPD. 

## Police Object

```json
    {
      "badge_id": 6,
      "first_name": "Harry",
      "last_name": "Dubois",
      "join_date": "2008-09-04",
      "rank": "Lieutenant",
      "district_id": "1543"
    }
```

| Field                   | Description                                                                                           |
|-------------------------|-------------------------------------------------------------------------------------------------------|
| badge_id  `int`         | Auto-incrementing ID                                                                                  |
| first_name `string`  | First name of the police                                                                       |
| last_name `string`  | Last name of the police                                                     |
| join_date `date`        | When the police joined the department                                                                    |
| rank `string`    | Police Rank                                          |
| district_id `int`        | [District](districts.md#district-object) where the police is stationed |

## 1. Get a list of police

Returns a list of police officers possible modi committed in reports.

`GET /police`

**<u>Parameters</u>** 

| Field                                | Description                                                       |
|--------------------------------------|-------------------------------------------------------------------|
| first_name `string` *optional*       | Filter for police officers containing this value their first name |
| last_name `string` *optional*        | Filter for police officers containing this value their last name  |
| from_join_date `DateTime` *optional* | Filter for police officers joining after this date                |
| to_join_date `DateTime` *optional*   | Filter for police officers joining before this date               |
| rank `string` *optional*             | Filter for police officers having this rank                       |

## 2. Get police information

Return a police officer with the specified badge id

`GET /police/{badge_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: An [police object](#police-object) with the specified badge id.

## 3. Get police reports

Return a list of reports assigned to a police officer with badge id.

`GET /police/{badge_id}/reports`

**<u>Parameters</u>**:

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

**<u>Returns</u>**: A list of [report object](reports.md#report-object) with the associated with the badge id.

## 4. Create police 

Creates a police officer with the given information

`POST /police`

**<u>Parameters</u>**:

| Field                                | Description                                                       |
|--------------------------------------|-------------------------------------------------------------------|
| badge_id  `int` *required*           | Auto-incrementing ID                                              |
| first_name `string` *required*   | First name of the police |
| last_name `string` *required*   | Last name of the police   |
| join_date `date`  *required*        | When the police joined the department  |
| rank `string`  *required*    | Police Rank                                          |
| district_id `int` *required* | [District](districts.md#district-object) where the police is stationed |

**<u>Returns</u>**: Status indicating whether the police officer was successfully created or not

## 5. Delete a police officer

Deletes a police officer with the specified badge id

`DELETE /police/{badge_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the police officer was successfully deleted or not

## 6. Update a police officer

Updates a police officer with the specified badge id, with the specified data

`PUT /police/{badge_id}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                          | Description                                   |
|--------------------------------|-----------------------------------------------|
| first_name `string` *optional*   | First name of the police |
| last_name `string` *optional*   | Last name of the police   |
| join_date `date`  *optional*        | When the police joined the department  |
| rank `string`  *optional*    | Police Rank                                          |
| district_id `int` *optional* | [District](districts.md#district-object) where the police is stationed |

**<u>Returns</u>**: Status indicating whether the police officer was successfully updated or not
