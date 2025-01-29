
---

### ROUTES DE L'ADMIN

LIEES A LA GESTION DES EVENTS

---
---
---

---
---

### Route `admin\event-list`

Cette route permet à l'admin de récupérer la liste des events.

- **Méthode HTTP**: `Get`
- **Endpoint**: `api/admin/event-list`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:
- aucun

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "events": [
        {
            "id": 1,
            "titre": "partenariat unesco",
            "description": "ygfzygiugyifugyziufgaiuegyaziueygaiuzgeyriuygzgiy",
            "date": "25-04-2025",
            "image": null,
            "lien": null,
            "deleted_at": null,
            "created_at": "2025-01-29T09:38:59.000000Z",
            "updated_at": "2025-01-29T09:49:35.000000Z"
        }
    ],
    "deletedEvents": []
}
```
- `500`: Erreur interne

---
---
---

---
---


### Route `admin\event-create`

Cette route permet à l'admin de créer un event.

- **Méthode HTTP**: `Post`
- **Endpoint**: `api/admin/event-create`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "date" : "25-04-2025" ,
    "titre" : "Partenariat" ,
    "image" : null ,
    "lien" : null ,
    "description" : "ygfzygiugyifugyziufgaiuegyaziueygaiuzgeyriuygzgiy"
}
````

#### Réponses :
- `200`:
```json
{
    "status": 201,
    "message": "Événement créé avec succès",
    "event": {
        "titre": "Partenariat",
        "description": "ygfzygiugyifugyziufgaiuegyaziueygaiuzgeyriuygzgiy",
        "date": "25-04-2025",
        "lien": null,
        "image": null,
        "updated_at": "2025-01-29T09:38:59.000000Z",
        "created_at": "2025-01-29T09:38:59.000000Z",
        "id": 1
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\event-edit`

Cette route permet à l'admin d'éditer un event.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/event-edit`

#### Entete :
- Authorization : token de l'admin

#### Paramètres de la requête:

````json
{
    "id": 1 ,
    "titre" : "partenariat Unesco"
}
````

#### Réponses :
- `200`:
```json
{
    "status": 200,
    "message": "Événement mis à jour avec succès",
    "event": {
        "id": 1,
        "titre": "partenariat unesco",
        "description": "ygfzygiugyifugyziufgaiuegyaziueygaiuzgeyriuygzgiy",
        "date": "25-04-2025",
        "image": null,
        "lien": null,
        "deleted_at": null,
        "created_at": "2025-01-29T09:38:59.000000Z",
        "updated_at": "2025-01-29T09:46:13.000000Z"
    }
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\event-delete`

Cette route permet à l'admin de supprimer un event.

- **Méthode HTTP**: `delete`
- **Endpoint**: `api/admin/event-delete`

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
    "message": "Événement supprimé"
}
```
- `500`: Erreur interne

---
---
---

---
---





### Route `admin\event-restore`

Cette route permet à l'admin de restaurer un event précédement supprimé.

- **Méthode HTTP**: `Patch`
- **Endpoint**: `api/admin/event-restore`

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
    "message": "Événement restauré"
}
```
- `500`: Erreur interne

---
---
---

---
---

