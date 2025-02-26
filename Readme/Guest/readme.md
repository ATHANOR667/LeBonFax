
---

### ROUTES DE L'UTILISATEUR

LIEES:  
       -  A L'AFFICHAGE DES PACKS ET CERTIF 
       -  AU CONTACT US
       -  AFFICHAGE DES EVENEMENTS
       -  AU  PAYEMENT DES PACKS ET CERTIF


---
---
---

---
---

### Route `guest/package-certif-list`

Cette route permet à l'utilisateur de recuperer la liste des packs et des certifs.

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/guest/package-certif-list`

#### Paramètres de la requête:

- aucun

#### Réponses :
- `200`:
````json
{
    "status": 200,
    "packages": [
        {
            "id": 1,
            "nom": "azerty",
            "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
            "prix": "70",
            "reduction": "30",
            "image": null,
            "deleted_at": null,
            "created_at": "2025-01-29T09:58:54.000000Z",
            "updated_at": "2025-01-29T10:01:42.000000Z",
            "nombre_de_certifs": 1,
            "certifs": [
                {
                    "id": 1,
                    "nom": "John",
                    "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps://youtube.com",
                    "prix": "100",
                    "categorie": "BTP",
                    "image": null,
                    "lien": null,
                    "deleted_at": null,
                    "created_at": "2025-01-29T09:55:33.000000Z",
                    "updated_at": "2025-01-29T09:55:33.000000Z",
                    "pivot": {
                        "pack_id": 1,
                        "certif_id": 1
                    }
                }
            ]
        },
        {
            "id": 2,
            "nom": "azerty",
            "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
            "prix": "0",
            "reduction": "30",
            "image": null,
            "deleted_at": null,
            "created_at": "2025-01-29T09:59:49.000000Z",
            "updated_at": "2025-01-29T09:59:49.000000Z",
            "nombre_de_certifs": 0,
            "certifs": []
        }
    ],
    "certifs": {
        "BTP": [
            {
                "id": 1,
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps://youtube.com",
                "prix": "100",
                "categorie": "BTP",
                "image": null,
                "lien": null,
                "deleted_at": null,
                "created_at": "2025-01-29T09:55:33.000000Z",
                "updated_at": "2025-01-29T09:55:33.000000Z"
            },
            {
                "id": 2,
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps://youtube.com",
                "prix": "100",
                "categorie": "BTP",
                "image": "certifs/GqAClEgLmpjDPA59HHSNYdZPrMHQl2juHh0ul3xt.png",
                "lien": null,
                "deleted_at": null,
                "created_at": "2025-01-29T09:57:53.000000Z",
                "updated_at": "2025-01-29T09:57:53.000000Z"
            }
        ],
        "Informatique": [
            {
                "id": 3,
                "nom": "Alice",
                "description": "Desc 1",
                "prix": "200",
                "categorie": "Informatique",
                "image": "certifs/alice_image.png",
                "lien": null,
                "deleted_at": null,
                "created_at": "2025-01-30T09:55:33.000000Z",
                "updated_at": "2025-01-30T09:55:33.000000Z"
            },
            {
                "id": 4,
                "nom": "Alice",
                "description": "Desc 2",
                "prix": "200",
                "categorie": "Informatique",
                "image": null,
                "lien": null,
                "deleted_at": null,
                "created_at": "2025-01-30T10:10:33.000000Z",
                "updated_at": "2025-01-30T10:10:33.000000Z"
            }
        ]
    }
}

````
-`400`
- `500`: Erreur interne

---
---
---

---
---


### Route `guest\contact-us`

Cette route permet à l'utilisateur de laisser un message a notre adresse.

- **Méthode HTTP**: `POST`
- **Endpoint**: `api/guest/contact-us`

#### Paramètres de la requête:
````json
{
    "name" : "Djiepmo Marc" ,
    "email" : "John@doe.cm" ,
    "message": "jkfbksgbkjdkjkjdsbhfjkqsdhsdkfdkgbkjfqlkgbksdhfgbjbsgkjdsbhgkjhbdqgkdjfgbkjsdbhkjhfbjkdbshgjkfhb" ,
    "subject" : "sur les reseaux sociaux" /** Comment nous avez vous connu  */
}
````

#### Réponses :
- `200`:
````json
{
    "status": 200,
    "message": "Proposition soumise avec succès, consultez vos mails pour le feedback"
}
````
-`400`
- `500`: Erreur interne

---
---
---

---
---




### Route `guest\`

Cette route permet à l'utilisateur de récupérer la liste des évènements.

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/guest/`

#### Paramètres de la requête:

- aucun

#### Réponses :
- `200`:
````json
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
    ]
}
````
-`400`
- `500`: Erreur interne

---
---
---

---
---


### Route `guest\`

Cette route permet à l'utilisateur de payer une certif.

- **Méthode HTTP**: `POST`
- **Endpoint**: `api/guest/`

#### Paramètres de la requête:
````json

````

#### Réponses :
- `200`:
````json

````
-`400`
- `500`: Erreur interne

---
---
---

---
---

