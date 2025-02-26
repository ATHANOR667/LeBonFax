
---

### ROUTES DE L'ADMIN

LIEES ET AU DASHBOARD

---
---
---

---
---

### Route `admin\dashboard\certifs`

Cette route permet à l'admin de récupérer la liste des certifications , leurs acheteurs respectif et le nombre d'acheteur

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/admin/dashboard/certifs`

#### Paramètres de la requête:
````json
````
#### Entete :
- Authorization : token de l'admin


#### Réponses :
- `200`: 
```json
{
    "status": 200,
    "data": [
        {
            "certif": {
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 0,
            "acheteurs": []
        },
        {
            "certif": {
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 1,
            "acheteurs": [
                {
                    "nom": "David",
                    "prenom": "Ngoue",
                    "email": "mdjiepmo@gmail.com",
                    "telephone": null,
                    "devise": "XAF",
                    "montant": "100",
                    "transaction_id": "Certif_2-mdjiepmo@gmail.com-2025/02/26 13:01:40"
                }
            ]
        },
        {
            "certif": {
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 0,
            "acheteurs": []
        },
        {
            "certif": {
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 0,
            "acheteurs": []
        },
        {
            "certif": {
                "nom": "John",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 0,
            "acheteurs": []
        },
        {
            "certif": {
                "nom": "Johnghgfh",
                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                "prix": "100",
                "lien": null
            },
            "nombre_acheteurs": 0,
            "acheteurs": []
        }
    ]
}
```

-`400`
- `500`: Erreur interne

---
---
---

---
---



### Route `admin\dashboard\packages`

Cette route permet à l'admin de récupérer la liste des packages, leurs acheteurs respectif et le nombre d'acheteur

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/admin/dashboard/packages`

#### Paramètres de la requête:
````json
````
#### Entete :
- Authorization : token de l'admin


#### Réponses :
- `200`: 
```json
{
    "status": 200,
    "data": [
        {
            "pack": {
                "nom": "azerty",
                "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                "prix": "100",
                "reduction": "30",
                "image": null,
                "certifs": [
                    {
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "lien": null
                    },
                    {
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "lien": null
                    }
                ]
            },
            "nombre_acheteurs": 2,
            "acheteurs": [
                {
                    "nom": "Djiepmo",
                    "prenom": "Marc",
                    "email": "mdjiepmo@gmail.com",
                    "telephone": null,
                    "devise": "XAF",
                    "montant": "100",
                    "transaction_id": "Pack_1-mdjiepmo@gmail.com-2025/02/25 16:19:04"
                },
                {
                    "nom": "David",
                    "prenom": "Ngoue",
                    "email": "mdjiepmo@gmail.com",
                    "telephone": null,
                    "devise": "XAF",
                    "montant": "100",
                    "transaction_id": "Pack_1-mdjiepmo@gmail.com-2025/02/26 11:15:46"
                }
            ]
        },
        {
            "pack": {
                "nom": "hdhgfdhg",
                "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                "prix": "100",
                "reduction": "30",
                "image": null,
                "certifs": []
            },
            "nombre_acheteurs": 1,
            "acheteurs": [
                {
                    "nom": "David",
                    "prenom": "Ngoue",
                    "email": "mdjiepmo@gmail.com",
                    "telephone": null,
                    "devise": "XAF",
                    "montant": "100",
                    "transaction_id": "Pack_2-mdjiepmo@gmail.com-2025/02/26 12:53:39"
                }
            ]
        }
    ]
}
```

-`400`
- `500`: Erreur interne

---
---
---

---
---



### Route `admin\dashboard\calendrier`

Cette route permet à l'admin de récupérer la liste des packages et certifications vendus mensuellement

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/admin/dashboard/calendrier`

#### Paramètres de la requête:
````json
````
#### Entete :
- Authorization : token de l'admin


#### Réponses :
- `200`:
```json
{
    "status": 200,
    "data": {
        "2024": {
            "February": {
                "packs": [
                    {
                        "id": 1,
                        "nom": "azerty",
                        "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                        "prix": "100",
                        "reduction": "30",
                        "image": null,
                        "certifs": [
                            {
                                "nom": "John",
                                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                                "prix": "100",
                                "lien": null
                            },
                            {
                                "nom": "John",
                                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                                "prix": "100",
                                "lien": null
                            }
                        ],
                        "acheteurs": [
                            {
                                "nom": "Djiepmo",
                                "prenom": "Marc",
                                "email": "mdjiepmo@gmail.com",
                                "telephone": null
                            }
                        ],
                        "acheteurs_count": 1
                    }
                ],
                "certifs": []
            },
            "March": {
                "packs": [],
                "certifs": []
            },
            "April": {
                "packs": [],
                "certifs": []
            },
            "May": {
                "packs": [],
                "certifs": []
            },
            "June": {
                "packs": [],
                "certifs": []
            },
            "July": {
                "packs": [],
                "certifs": []
            },
            "August": {
                "packs": [],
                "certifs": []
            },
            "September": {
                "packs": [],
                "certifs": []
            },
            "October": {
                "packs": [],
                "certifs": []
            },
            "November": {
                "packs": [],
                "certifs": []
            },
            "December": {
                "packs": [],
                "certifs": []
            }
        },
        "2025": {
            "January": {
                "packs": [],
                "certifs": []
            },
            "February": {
                "packs": [
                    {
                        "id": 1,
                        "nom": "azerty",
                        "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                        "prix": "100",
                        "reduction": "30",
                        "image": null,
                        "certifs": [
                            {
                                "nom": "John",
                                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                                "prix": "100",
                                "lien": null
                            },
                            {
                                "nom": "John",
                                "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                                "prix": "100",
                                "lien": null
                            }
                        ],
                        "acheteurs": [
                            {
                                "nom": "David",
                                "prenom": "Ngoue",
                                "email": "mdjiepmo@gmail.com",
                                "telephone": null
                            }
                        ],
                        "acheteurs_count": 1
                    },
                    {
                        "id": 2,
                        "nom": "hdhgfdhg",
                        "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                        "prix": "100",
                        "reduction": "30",
                        "image": null,
                        "certifs": [],
                        "acheteurs": [
                            {
                                "nom": "David",
                                "prenom": "Ngoue",
                                "email": "mdjiepmo@gmail.com",
                                "telephone": null
                            }
                        ],
                        "acheteurs_count": 1
                    }
                ],
                "certifs": [
                    {
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "lien": null,
                        "acheteurs": [
                            {
                                "nom": "David",
                                "prenom": "Ngoue",
                                "email": "mdjiepmo@gmail.com",
                                "telephone": null
                            }
                        ],
                        "acheteurs_count": 1
                    }
                ]
            }
        }
    }
}
```

-`400`
- `500`: Erreur interne

---
---
---

---
---



### Route `admin\dashboard\find-payment`

Cette route permet à l'admin de récupérer la liste des payements correspondant a une recherche

- **Méthode HTTP**: `GET`
- **Endpoint**: `api/admin/dashboard/find-payment`

Valeurs possible de field : transaction_id,nom,prenom,email
#### Paramètres de la requête:
````json
{
    "field" : "transaction_id" ,
    "search": "pac"
}
````
#### Entete :
- Authorization : token de l'admin


#### Réponses :
- `200`:
```json
{
    "status": 200,
    "data": [
        {
            "id": 1,
            "nom": "Djiepmo",
            "prenom": "Marc",
            "email": "mdjiepmo@gmail.com",
            "telephone": null,
            "status": "completed",
            "devise": "XAF",
            "montant": "100",
            "transaction_id": "Pack_1-mdjiepmo@gmail.com-2025/02/25 16:19:04",
            "token": "89c36fed9c40212ed38bada06f48d32f65357f3ded7f50b3aa38eb656e7aa216bf19c9acbd7e302ff633657a7b61e1f34a545246be8e00",
            "dateDisponibilite": "2024-02-26T16:19:25.748000Z",
            "motif": null,
            "methode": "MTNCM",
            "deleted_at": null,
            "created_at": "+056124-12-04T03:49:08.000000Z",
            "updated_at": "2025-02-25T16:23:02.000000Z",
            "pack_id": 1,
            "certif_id": null,
            "pack": {
                "id": 1,
                "nom": "azerty",
                "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                "prix": "100",
                "reduction": "30",
                "image": null,
                "deleted_at": null,
                "created_at": "2025-02-10T19:40:43.000000Z",
                "updated_at": "2025-02-10T19:41:11.000000Z",
                "certifs": [
                    {
                        "id": 1,
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "categorie": "BTP",
                        "image": null,
                        "lien": null,
                        "deleted_at": null,
                        "created_at": "2025-02-10T19:32:32.000000Z",
                        "updated_at": "2025-02-10T19:32:32.000000Z",
                        "pivot": {
                            "pack_id": 1,
                            "certif_id": 1
                        }
                    },
                    {
                        "id": 2,
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "categorie": "BTP",
                        "image": null,
                        "lien": null,
                        "deleted_at": null,
                        "created_at": "2025-02-10T19:32:37.000000Z",
                        "updated_at": "2025-02-10T19:32:37.000000Z",
                        "pivot": {
                            "pack_id": 1,
                            "certif_id": 2
                        }
                    }
                ]
            },
            "certif": null
        },
        {
            "id": 2,
            "nom": "David",
            "prenom": "Ngoue",
            "email": "mdjiepmo@gmail.com",
            "telephone": null,
            "status": "completed",
            "devise": "XAF",
            "montant": "100",
            "transaction_id": "Pack_1-mdjiepmo@gmail.com-2025/02/26 11:15:46",
            "token": "30cf281a0bcac84741c018a1b1ab94b256878562a5a1d0e30151db89cdc2aea1fbe56f86c30e434a1c0aae6dac6fa14b3786449013405f",
            "dateDisponibilite": "2025-02-27T11:16:14.735000Z",
            "motif": null,
            "methode": "MTNCM",
            "deleted_at": null,
            "created_at": "2025-02-26T11:15:47.000000Z",
            "updated_at": "2025-02-26T12:48:14.000000Z",
            "pack_id": 1,
            "certif_id": null,
            "pack": {
                "id": 1,
                "nom": "azerty",
                "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                "prix": "100",
                "reduction": "30",
                "image": null,
                "deleted_at": null,
                "created_at": "2025-02-10T19:40:43.000000Z",
                "updated_at": "2025-02-10T19:41:11.000000Z",
                "certifs": [
                    {
                        "id": 1,
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "categorie": "BTP",
                        "image": null,
                        "lien": null,
                        "deleted_at": null,
                        "created_at": "2025-02-10T19:32:32.000000Z",
                        "updated_at": "2025-02-10T19:32:32.000000Z",
                        "pivot": {
                            "pack_id": 1,
                            "certif_id": 1
                        }
                    },
                    {
                        "id": 2,
                        "nom": "John",
                        "description": "jkbkhbzrkhbkjrhkhujhhv  \n\nkvjhgjgjgjhgjhgjhgjhgjgjhgjhgj\n\n\nhttps::youtube.com",
                        "prix": "100",
                        "categorie": "BTP",
                        "image": null,
                        "lien": null,
                        "deleted_at": null,
                        "created_at": "2025-02-10T19:32:37.000000Z",
                        "updated_at": "2025-02-10T19:32:37.000000Z",
                        "pivot": {
                            "pack_id": 1,
                            "certif_id": 2
                        }
                    }
                ]
            },
            "certif": null
        },
        {
            "id": 3,
            "nom": "David",
            "prenom": "Ngoue",
            "email": "mdjiepmo@gmail.com",
            "telephone": null,
            "status": "completed",
            "devise": "XAF",
            "montant": "100",
            "transaction_id": "Pack_2-mdjiepmo@gmail.com-2025/02/26 12:53:39",
            "token": "29db2d53b5a55e77468dc5102b83af922c0b1114d44d779ebaafe45e02cdf1f5c9d61ade57decad9bca9d7b14fe62d321c5bbdef855950",
            "dateDisponibilite": "2025-02-27T12:53:59.156000Z",
            "motif": null,
            "methode": "MTNCM",
            "deleted_at": null,
            "created_at": "2025-02-26T12:53:40.000000Z",
            "updated_at": "2025-02-26T12:55:03.000000Z",
            "pack_id": 2,
            "certif_id": null,
            "pack": {
                "id": 2,
                "nom": "hdhgfdhg",
                "description": "uyrdcudcufufavyazvfyurvfuiybvfiuiufyiuzrfuizr ferfuerfyib f",
                "prix": "100",
                "reduction": "30",
                "image": null,
                "deleted_at": null,
                "created_at": "2025-02-10T19:40:43.000000Z",
                "updated_at": "2025-02-10T19:41:11.000000Z",
                "certifs": []
            },
            "certif": null
        }
    ]
}
```

-`400`
- `500`: Erreur interne
- `422` : Erreur de validation
````json
{
    "status": 422,
    "message": "Échec de la validation des données.",
    "errors": {
        "field": [
            "The field field is required."
        ],
        "search": [
            "The search field is required."
        ]
    }
}
````
---
---
---

---
---


