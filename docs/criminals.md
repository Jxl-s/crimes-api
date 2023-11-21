# Criminals
Endpoint: `/criminals`

- [Criminals](#criminals)
  - [Details](#details)
  - [Criminal Object](#criminal-object)
  - [1. Get a list of criminals](#1-get-a-list-of-criminals)
  - [2. Get criminal details](#2-get-criminal-details)
  - [3. Get criminal reports](#3-get-criminal-reports)
  - [4. Create a criminal](#4-create-a-criminal)
  - [5. Delete a criminal](#5-delete-a-criminal)
  - [6. Update a criminal](#6-update-a-criminal)

## Details

The criminal resource represents criminals who are linked in a crime report

## Criminal Object

```json
    {
      "criminal_id": 1,
      "first_name": "Rene",
      "last_name": "Martell ",
      "age": 26,
      "sex": "M",
      "height": 173,
      "descent": "W",
      "is_arrested": 1
    }
```

| Field               | Description                                                 |
|---------------------|-------------------------------------------------------------|
| criminal_id `int`   | Uniquely identifies a criminal, through its id              |
| first_name `string` | The first name of the criminal                              |
| last_name `string`  | The last name of the criminal                               |
| age `int`           | The age of the criminal                                     |
| sex `M\|F\|X`       | The sex of the criminal. Can be 'Male', 'Female' or 'Other' |
| height `int`        | The height of the criminal in centimeters                   |
| descent `char`      | The race of the criminal                                    |
| is_arrested `bool`  | Arrest status of the criminal                               |

## 1. Get a list of criminals

`GET /criminals`

**<u>Parameters</u>**

| Field                          | Description                                                     |
|--------------------------------|-----------------------------------------------------------------|
| first_name `string` *optional* | Filter for criminals containing this value for their first name |
| last_name `string` *optional*  | Filter for criminals containing this value for their last name  |
| age `int` *optional*           | Filter for criminals having this age                            |
| descent `char` *optional*      | Filter for criminals having this descent                        |
| sex `M\|F\|X` *optional*       | Filters for criminals having this sex                           |
| is_arrested `bool` *optional*  | Filters for criminals that are arrested                         |

**<u>Returns</u>**: An array of [Criminal](#criminal-object) objects that were involved in the report

## 2. Get criminal details

`GET /criminals/{criminal_id}`

**<u>Parameters</u>**: None

**<u>Returns</u>**: A [Criminal](#criminal-object) object for the given ID

## 3. Get criminal reports

Get the crime reports associated with a criminal

`GET /criminals/{criminal_id}/reports`

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

## 4. Create a criminal

`POST /criminals`

**<u>Parameters</u>**

| Field                          | Description                                                     |
|--------------------------------|-----------------------------------------------------------------|
| criminal_id `int` *required*   | Uniquely identifies a criminal, through its id                  |
| first_name `string` *required* | Filter for criminals containing this value for their first name |
| last_name `string` *required*  | Filter for criminals containing this value for their last name  |
| age `int` *required*           | Filter for criminals having this age                            |
| descent `char` *required*      | Filter for criminals having this descent                        |
| sex `M\|F\|X` *required*       | Filters for criminals having this sex                           |
| is_arrested `bool` *required*  | Filters for criminals that are arrested                         |

**<u>Returns</u>**: Status indicating whether the criminal was successfully created or not

## 5. Delete a criminal

Deletes a criminal with the specified criminal id

`DELETE /criminals/{criminal_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the criminal was successfully deleted or not

## 6. Update a criminal

Updates a criminal with the specified criminal id, with the specified data

`PUT /criminal/{criminal_id}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                          | Description                                                     |
|--------------------------------|-----------------------------------------------------------------|
| first_name `string` *optional* | Filter for criminals containing this value for their first name |
| last_name `string` *optional*  | Filter for criminals containing this value for their last name  |
| age `int` *optional*           | Filter for criminals having this age                            |
| descent `char` *optional*      | Filter for criminals having this descent                        |
| sex `M\|F\|X` *optional*       | Filters for criminals having this sex                           |
| is_arrested `bool` *optional*  | Filters for criminals that are arrested                         |

**<u>Returns</u>**: Status indicating whether the criminal was successfully updated or not