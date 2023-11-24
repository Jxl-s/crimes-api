# Victims
Endpoint: `/victims`

## Table of Contents

- [Victims](#victims)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Victim Object](#victim-object)
  - [1. Get a list of victims](#1-get-a-list-of-victims)
  - [2. Get victim details](#2-get-victim-details)
  - [3. Get victim reports](#3-get-victim-reports)
  - [4. Create a victim](#4-create-a-victim)
  - [5. Delete a victim](#5-delete-a-victim)
  - [6. Update a victim](#6-update-a-victim)

## Details

The victim resource represents Victims who are linked in a crime report

## Victim Object

```json
    {
      "victim_id": 1,
      "first_name": "Glen",
      "last_name": "Smith",
      "age": 46,
      "sex": "M",
      "height": 187,
      "descent": "B"
    }
```

| Field               | Description                                               |
|---------------------|-----------------------------------------------------------|
| victim_id `int`     | Uniquely identifies victim, through its id                |
| first_name `string` | The first name of the victim                              |
| last_name `string`  | The last name of the victim                               |
| age `int`           | The age of the victim                                     |
| sex `M\|F\|X`       | The sex of the victim. Can be 'Male', 'Female' or 'Other' |
| height `int`        | The height of the victim in centimeters                   |
| descent `char`      | The race of the victim                                    |

## 1. Get a list of victims

`GET /victims`

**<u>Parameters</u>**

| Field                          | Description                                                   |
|--------------------------------|---------------------------------------------------------------|
| first_name `string` *optional* | Filter for victims containing this value for their first name |
| last_name `string` *optional*  | Filter for victims containing this value for  their last name |
| age `int` *optional*           | Filter for victims having this age                            |
| descent `char` *optional*      | Filter for victims having this descent                        |
| sex `M\|F\|X` *optional*       | Filters for victims having this sex                           |

**<u>Returns</u>**: An array of [Victim](#victim-object) objects that match the filters

## 2. Get victim details

`GET /victims/{victim_id}`

**<u>Parameters</u>**: None

**<u>Returns</u>**: A [Victim](#victim-object) object for the given ID

## 3. Get victim reports

Get the crime reports associated with a victim

`GET /victims/{victim_id}/reports`

**<u>Parameters</u>**

| Field                                  | Description                                  |
|----------------------------------------|----------------------------------------------|
| from_last_update `DateTime` *optional* | Filter for lower range of last_update        |
| to_last_update `DateTime` *optional*   | Filter for upper range of last_update        |
| fatalities `int` *optional*            | Filter for exact number of fatalities        |
| criminal_count `int` *optional*        | Filter for exact number of criminals         |
| victim_count `int` *optional*          | Filter for exact number of victims           |
| crime_code `int` *optional*            | Filter for reports including this crime code |
| modus_code `string` *optional*         | Filter for reports including this modus code |
| premise `string` *optional*            | Filter for reports including this premise    |

**<u>Returns</u>**: A list of [Report](reports.md#report-object) objects that match the filters

## 4. Create a victim

`POST /victims`

**<u>Parameters</u>**

| Field                          | Description                                               |
|--------------------------------|-----------------------------------------------------------|
| victim_id `int` *required*     | Uniquely identifies victim, through its id                |
| first_name `string` *required* | The first name of the victim                              |
| last_name `string` *required*  | The last name of the victim                               |
| age `int`      *required*      | The age of the victim                                     |
| sex `M\|F\|X`   *required*     | The sex of the victim. Can be 'Male', 'Female' or 'Other' |
| height `int`    *required*     | The height of the victim in centimeters                   |
| descent `char`  *required*     | The race of the victim                                    |

**<u>Returns</u>**: Status indicating whether the victim was successfully created or not

## 5. Delete a victim

Deletes a victim with the specified victim id

`DELETE /victims/{victim_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the victim was successfully deleted or not

## 6. Update a victim

Updates a victim with the specified victim id, with the specified data

`PUT /victims/{victim_id}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                          | Description                                                   |
|--------------------------------|---------------------------------------------------------------|
| first_name `string` *optional* | Filter for victims containing this value for their first name |
| last_name `string` *optional*  | Filter for victims containing this value for their last name  |
| age `int` *optional*           | Filter for victims having this age                            |
| descent `char` *optional*      | Filter for victims having this descent                        |
| sex `M\|F\|X` *optional*       | Filters for victims having this sex                           |

**<u>Returns</u>**: Status indicating whether the victim was successfully updated or not