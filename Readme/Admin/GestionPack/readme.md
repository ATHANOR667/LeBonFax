
---

### ROUTES DE L'ADMIN

LIEES A LA GESTION DES PACKS

---
---
---

---
---

### Route `admin\package-list`

Cette route permet à l'admin de récupérer la liste des packages .

- **Méthode HTTP**: `Get`
- **Endpoint**: `api/admin/package-list`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:
- aucun

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "packages": [
        {
            "id": 1,
            "nom": "John",
            "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
            "prix": "90",
            "reduction": "10",
            "image": null,
            "deleted_at": null,
            "created_at": "2025-01-27T19:53:18.000000Z",
            "updated_at": "2025-01-28T13:31:11.000000Z",
            "nombre_de_certifs": 1,
            "certifs": [
                {
                    "id": 1,
                    "nom": "Figma",
                    "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                    "prix": "100",
                    "image": "certifs/4V6GZ0mWoBFke6vVSzmfqHZCHDneDCWeWCJV0Fzh.png",
                    "lien": null,
                    "deleted_at": null,
                    "created_at": "2025-01-27T22:31:06.000000Z",
                    "updated_at": "2025-01-28T13:25:37.000000Z",
                    "pivot": {
                        "pack_id": 1,
                        "certif_id": 1
                    }
                }
            ]
        },
        {
            "id": 21,
            "nom": "azerty",
            "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
            "prix": "0",
            "reduction": "30",
            "image": null,
            "deleted_at": null,
            "created_at": "2025-01-27T22:28:09.000000Z",
            "updated_at": "2025-01-27T22:28:09.000000Z",
            "nombre_de_certifs": 0,
            "certifs": []
        }
    ],
    "deletedPackages": []
}
```
- `500`: Erreur interne

---
---
---

---
---


### Route `admin\package-create`

Cette route permet à l'admin de créer un package.

- **Méthode HTTP**: `Post`
- **Endpoint**: `api/admin/package-create`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "nom" : "azerty" ,
    "description" : "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f ",
    "reduction" : 30 ,
    "image":null
}
````

#### Réponses :
- `200`:
```json
{
    "status": 201,
    "message": "Package créé avec succès",
    "package": {
        "nom": "azerty",
        "reduction": 30,
        "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
        "image": null,
        "prix": 0,
        "updated_at": "2025-01-29T09:59:49.000000Z",
        "created_at": "2025-01-29T09:59:49.000000Z",
        "id": 2
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\package-edit`

Cette route permet à l'admin d'éditer un package.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/package-edit`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "id" : 2 ,
    "nom" : "Figma",
    "autres champs" : "a mettre a jour"
}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Package mis à jour avec succès",
    "package": {
        "id": 1,
        "nom": "fxgfxf",
        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
        "prix": "90",
        "reduction": "10",
        "image": null,
        "deleted_at": null,
        "created_at": "2025-01-27T19:53:18.000000Z",
        "updated_at": "2025-01-28T13:37:07.000000Z"
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\package-delete`

Cette route permet à l'admin de supprimer un package.

- **Méthode HTTP**: `delete`
- **Endpoint**: `api/admin/package-delete`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "id" : 1 
}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Package supprimé"
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\package-restore`

Cette route permet à l'admin de restaurer un package précédement supprimé.

- **Méthode HTTP**: `Get`
- **Endpoint**: `api/admin/package-restore`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "id" : 1
}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Package restauré"
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\package-attach`

Cette route permet à l'admin d'ajouter une certif a un package.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/package-attach`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "pack_id" : 1 ,
    "certif_id" : 1 

}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Certif attachée au Pack avec succès"
}
```
- `500`: Erreur interne


- `400`
````json
{
    "status": 400,
    "message": "Certif déja attachée à ce Pack"
}
````
---
---
---

---
---





### Route `admin\package-detach`

Cette route permet à l'admin de retirer une certif à un package.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/package-detach`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "pack_id" : 1 ,
    "certif_id" : 1 

}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Certif détachée du pack avec succès"
}
```
- `500`: Erreur interne


- `400`
````json
{
    "status": 400,
    "message": "Certif non attachée à ce Pack"
}
````
---
---
---

---
---

