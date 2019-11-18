# api-platfom-embedding-relations

Create new account and role with existing permision

```
{
  "username": "strsisng",
  "isActive": true,
  "roles": [
    {
      "symbol": "string",
      "description": "string",
      "permissions": [
         "/api/permissions/3"
      ]
    }
  ],
  "password": "string"
}
```

Create new account and role with new permision
```
{
  "username": "strisng",
  "isActive": true,
  "roles": [
    {
      "symbol": "string",
      "description": "string",
      "permissions": [
        {
          "capability": "string"
        }
      ]
    }
  ],
  "password": "string"
}
```
Create new account with existing role with new permission
```
{
  "username": "shtrsisng",
  "isActive": true,
  "roles": [
    {
      "@id": "/api/roles/1",
      "permissions": [
        {
          "capability": "string"
        }
      ]
    }
  ],
  "password": "string"
}
```


