# 🧑‍💼 Plateforme de Recrutement – Projet Symfony

Plateforme complète de **recrutement en ligne** développée avec **Symfony** dans le cadre de ma formation.  
Ce projet reproduit un **workflow réel** entre **candidats**, **recruteurs** et **administrateur**, avec une gestion des rôles et un back-office complet.

---

## 🚀 Fonctionnalités

### 🌍 Accès public
- Consultation des offres d’emploi sans être connecté
- Page de détail des offres
- Formulaire de contact pour les recruteurs souhaitant obtenir un compte

---

### 📩 Contact recruteur & création de compte
- Les recruteurs peuvent envoyer leurs informations via le **formulaire de contact**
- L’**administrateur** reçoit la demande
- L’administrateur crée le compte recruteur
- Les identifiants sont envoyés par **email**

---

### 🧑‍💼 Espace recruteur
Une fois connecté, un recruteur peut :
- Créer, modifier et supprimer des **offres d’emploi**
- Gérer ses offres depuis un tableau de bord sécurisé
- Consulter et gérer les **candidatures reçues**
- Mettre à jour le statut des candidatures (en attente, acceptée, refusée…)

---

### 🧑‍🎓 Espace candidat
Les candidats peuvent :
- Créer et gérer leur **profil candidat**
- Compléter leur profil (obligatoire pour postuler)
- Uploader un **CV** et des documents personnels
- Postuler à des offres (une seule candidature par offre)
- Suivre l’état de leurs candidatures

---

### 🛠️ Administration
L’administrateur dispose d’un **back-office EasyAdmin** :
- Gestion des candidats
- Gestion des recruteurs
- Gestion des offres d’emploi
- Gestion des candidatures
- Création des comptes recruteurs à partir des demandes de contact

---

## 🔐 Comptes de démonstration

### 👑 Administrateur
- **Email** : `admin@admin.com`
- **Mot de passe** : `adminadmin`

### 🧑‍💼 Recruteur
- **Email** : `leo.marchand@corp.com`
- **Mot de passe** : `leoleo`

## 🚀 Installation du projet Luxury Service

Suivez ces étapes pour lancer le projet en local :

### 1️⃣ Cloner le projet
```bash
git clone https://github.com/Meikaziku/luxury-service.git ./
```

### 2️⃣ Installer les dépendances
```bash
composer install
```

### 3️⃣ Configurer l’environnement

Copier .env → .env.local :

```bash
cp .env .env.local
```

Modifier DATABASE_URL :

```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_la_db?serverVersion=8.0"
```
### 4️⃣ Créer la base de données
```bash
symfony console doctrine:database:create
```

### 5️⃣ Appliquer les migrations
```bash
symfony console doctrine:migrations:migrate
```

### 6️⃣ Lancer le serveur local
```bash
symfony server:start
```


Accédez ensuite au site via : http://adresseIp

### 7️⃣ Créer un compte administrateur

La base de données est vide : vous devez créer un compte admin et lui attribuer le rôle ROLE_ADMIN pour accéder au panel admin.



