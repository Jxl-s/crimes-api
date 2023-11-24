# Weapons
Endpoint: `/weapons`

## Table of Contents

- [Weapons](#weapons)
  - [Table of Contents](#table-of-contents)
  - [Details](#details)
  - [Weapon Object](#weapon-object)
  - [1. Get a list of weapons](#1-get-a-list-of-weapons)
  - [2. Get weapon details](#2-get-weapon-details)
  - [3. Get weapon reports](#3-get-weapon-reports)
  - [4. Create a weapon](#4-create-a-weapon)
  - [5. Delete a weapon](#5-delete-a-weapon)
  - [6. Update a weapon](#6-update-a-weapon)

## Details

The victim resource represents Victims who are linked in a crime report

## Weapon Object

```json
    {
      "weapon_id": 101,
      "type": "Firearm",
      "material": "Metal",
      "color": "Various",
      "description": "REVOLVER"
    }
```

| Field                | Description                                |
|----------------------|--------------------------------------------|
| weapon_id `int`      | Uniquely identifies weapon, through its id |
| type  `string`       | The type of weapon.                        |
| material `string`    | The material of the weapon                 |
| color `string`       | The primary color of the weapon            |
| description `string` | Details and notes about the weapon         |

## 1. Get a list of weapons

`GET /weapons`

**<u>Parameters</u>**

| Field                | Description                                        |
|----------------------|----------------------------------------------------|
| type  `string`       | Filter for the weapon having this type.            |
| material `string`    | Filter for the weapon having this material.        |
| color `string`       | Filter for the weapon having this color.           |
| description `string` | Filter for the weapon containing this description. |

**<u>Returns</u>**: An array of [Weapon](#weapon-object) objects that match the filters

## 2. Get weapon details

`GET /weapons/{weapon_id}`

**<u>Parameters</u>**: None

**<u>Returns</u>**: A [Weapon](#weapon-object) object for the given ID

## 3. Get weapon reports

Get the crime reports associated with a weapon

`GET /weapons/{weapon_id}/reports`

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

## 4. Create a weapon

`POST /weapons`

**<u>Parameters</u>**

| Field                           | Description                                |
|---------------------------------|--------------------------------------------|
| weapon_id `int` *required*      | Uniquely identifies weapon, through its id |
| type  `string` *required*       | The type of weapon.                        |
| material `string` *required*    | The material of the weapon                 |
| color `string` *required*       | The primary color of the weapon            |
| description `string` *required* | Details and notes about the weapon         |

**<u>Returns</u>**: Status indicating whether the weapon was successfully created or not

## 5. Delete a weapon

Deletes a weapon with the specified weapon id

`DELETE /weapons/{weapon_id}`

**<u>Parameters</u>**: No parameters

**<u>Returns</u>**: Status indicating whether the weapon was successfully deleted or not

## 6. Update a weapon

Updates a weapon with the specified weapon id, with the specified data

`PUT /weapons/{weapon_id}`

**<u>Parameters</u>**: No parameters

**<u>Request Body</u>**:

| Field                           | Description                                |
|---------------------------------|--------------------------------------------|
| weapon_id `int` *optional*      | Uniquely identifies weapon, through its id |
| type  `string` *optional*       | The type of weapon.                        |
| material `string` *optional*    | The material of the weapon                 |
| color `string` *optional*       | The primary color of the weapon            |
| description `string` *optional* | Details and notes about the weapon         |

**<u>Returns</u>**: Status indicating whether the weapon was successfully updated or not