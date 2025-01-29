
---

### ROUTES DE L'ADMIN

LIEES A LA GESTION DES CERTIFS

---
---
---

---
---

### Route `admin\certif-list`

Cette route permet à l'admin de récupérer la liste des certifs .

- **Méthode HTTP**: `Get`
- **Endpoint**: `api/admin/certif-list`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:
- aucun

#### Réponses :
- `200`:
```json
{
    "status": 201,
    "message": "Certif créé avec succès",
    "certif": {
        "nom": "John",
        "categorie": "BTP",
        "prix": "100",
        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
        "image": "certifs/GqAClEgLmpjDPA59HHSNYdZPrMHQl2juHh0ul3xt.png",
        "updated_at": "2025-01-29T09:57:53.000000Z",
        "created_at": "2025-01-29T09:57:53.000000Z",
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


### Route `admin\certif-create`

Cette route permet à l'admin de créer une certif.

- **Méthode HTTP**: `Post`
- **Endpoint**: `api/admin/certif-create`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "nom": "Cisco",
    "prix" : 100000 ,
    "description" : "lfbkjehakzebrkjzeahbrkjzaerhbjzahkjbhkjh" ,
    "lien" : "https:Cisco.com" ,
    "image" : "azerty"

}
````

#### Réponses :
- `200`:
```json
{
    "status": 201,
    "message": "Certif créé avec succès",
    "certif": {
        "nom": "Cisco",
        "prix": 100000,
        "description": "lfbkjehakzebrkjzeahbrkjzaerhbjzahkjbhkjh",
        "image": null,
        "updated_at": "2025-01-28T13:11:49.000000Z",
        "created_at": "2025-01-28T13:11:49.000000Z",
        "id": 5
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\certif-edit`

Cette route permet à l'admin d'éditer une certif.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/certif-edit`

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
    "message": "Certif mise à jour avec succès",
    "certif": {
        "id": 2,
        "nom": "Figma",
        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
        "prix": "100",
        "image": "certifs/ovOU9xFwAGzFOEcebsxXypRJ1lyBEPpdvn5KVwPP.png",
        "lien": null,
        "deleted_at": null,
        "created_at": "2025-01-27T22:31:14.000000Z",
        "updated_at": "2025-01-28T13:13:29.000000Z"
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\certif-delete`

Cette route permet à l'admin de supprimer une certif.

- **Méthode HTTP**: `delete`
- **Endpoint**: `api/admin/certif-delete`

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
    "message": "Certif supprimée"
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\certif-restore`

Cette route permet à l'admin de restaurer une certif précédement supprimée.

- **Méthode HTTP**: `Get`
- **Endpoint**: `api/admin/certif-restore`

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
    "message": "Certif restaurée"
}
```
- `500`: Erreur interne

---
---
---

---
---

