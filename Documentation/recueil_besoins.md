# Recueil des besoins SAE

**PASSOUBADY Maden / LAUDAT Séraphin**  
**SCHENDEL Léa / VIEIRA Lucas**  

## Recueil des besoins 2024/2025

---

## Sommaire :

### I. Chapitre 1 – Objectif et portée :
- A. Quels sont la portée et les objectifs généraux ?
- B. Les intervenants. (Qui est concerné ?)
- C. Qu’est-ce qui entre dans cette portée ? Qu’est-ce qui est en dehors ?

### II. Chapitre 2 – Terminologie employée / Glossaire

### III. Chapitre 3 – Les cas d’utilisation
- A. Les acteurs principaux et leurs objectifs généraux.
- B. Les cas d’utilisation métier (concepts opérationnels).
- C. Les cas d’utilisation système.

### IV. Chapitre 4 – La technologie employée
- A. Quelles sont les exigences technologiques pour ce système ?
- B. Avec quels systèmes ce système s'interfacera-t-il et avec quelles exigences ?

### V. Chapitre 5 – Autres exigences
- A. Processus de développement
  - a. Qui sont les participants au projet ?
  - b. Quelles valeurs devront être privilégiées ?
  - c. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires souhaitent-ils ?
  - d. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?
  - e. Quelles sont les autres exigences du processus ? (exemple : tests, installation, etc...)
  - f. À quelle dépendance le projet est-il soumis ?
- B. Règles métier
- C. Performances
- D. Opérations, sécurité, documentation
- E. Utilisation et utilisabilité
- F. Maintenance et portabilité
- G. Questions non résolues ou reportées à plus tard

### VI. Chapitre 6 – Recours humain, questions juridiques, politiques, organisationnelles
- A. Quel est le recours humain au fonctionnement du système ?
- B. Quelles sont les exigences juridiques et politiques ?
- C. Quelles sont les conséquences humaines de la réalisation du système ?
- D. Quels sont les besoins en formation ?
- E. Quelles sont les hypothèses et les dépendances affectant l’environnement humain ?

---
## Chapitre 1 – Objectif et portée : 

### A. Quels sont la portée et les objectifs généraux ? ✅
L’objectif de ce projet est de développer une application web permettant d’effectuer des calculs mathématiques. Ceci est destiné à offrir des outils de calculs via une interface en ligne sécurisée. Cette application sera déployée sur un Raspberry PI permettant ainsi de proposer une solution adaptée aux besoins du client.

La portée du projet inclut la mise en place de fonctionnalités clés telles que la gestion des utilisateurs avec des niveaux d’accès différents, l’intégration de modules mathématiques performants et fiables, ainsi qu’une interface utilisateur intuitive et sécurisée. De plus, l’application sera déployée de manière à enregistrer et gérer les résultats des calculs dans un historique personnel accessible depuis un tableau de bord.
<br>

### B. Les intervenants ✅
L’application implique plusieurs types d'intervenants, chacun ayant un rôle spécifique et des besoins distincts.

**Les visiteurs** représentent le premier groupe d'intervenants. Ce sont des utilisateurs non inscrits qui peuvent accéder uniquement à la page de garde qui comportant une vidéo et un texte explicatif. La vidéo a pour but de démontrer les avantages de s’inscrire sur l’application. Le texte en revanche va démontrer l’objectif de ceci.  
Ils n’ont pas accès aux fonctionnalités avancées, comme les modules de calculs, ni au tableau de bord.

**Les utilisateurs inscrits** constituent le deuxième groupe d’intervenants. Après avoir créé un compte via un formulaire sécurisé, ils bénéficient d’un accès complet en termes de fonctionnalités de l’application. Ils peuvent utiliser les différents modules de calcul, consulter et gérer les résultats de leurs opérations précédentes dans le tableau de bord personnalisé, et modifier leurs informations personnelles comme leur mot de passe.

**Les administrateurs web** forment le troisième groupe d’intervenants. Ce sont des personnes clés pour le bon fonctionnement de l’application. Ils ont pour mission de superviser la liste des utilisateurs inscrits, de gérer leurs comptes et leurs historiques de calcul. Ils ont également accès aux fichiers de logs pour assurer le suivi des activités sur la plateforme.

**Les administrateurs système** forment donc le dernier groupe d’intervenants. Ils se concentrent sur la supervision technique et la maintenance en cas de problème. Ils accèdent aux journaux d’activité du système via une interface dédiée et veillent à ce que le Raspberry Pi 4 hébergeant l’application reste performant et sécurisé.

Ces intervenants permettent donc une organisation claire des rôles garantissant une utilisation fluide et sécurisée de l’application.
<br>

### C. Qu’est-ce qui entre dans cette portée ? Qu’est-ce qui est en dehors ? ✅

Cette application a une portée définie qui se concentre sur les fonctionnalités essentielles nécessaires à son bon fonctionnement et à la satisfaction du client.

Dans cette portée, on inclut tout d’abord **la gestion des utilisateurs et des droits d’accès**. Cela comprend la possibilité pour les visiteurs de s’inscrire via un **formulaire sécurisé intégrant un CAPTCHA** ainsi que l’attribution des rôles distincts avec des droits spécifiques. Les utilisateurs inscrits pourront accéder au **tableau de bord** pour consulter leur historique des opérations et modifier leurs informations personnelles.

Ensuite, la portée prend en compte **l’intégration des modules de calcul**. Ces modules doivent être fiables, performants et permettre de stocker les résultats dans une **base de données** pour un accès ultérieur dans l’historique.

**La gestion administrative** rentre aussi dans cette portée. L’administrateur web pourra superviser la liste des utilisateurs, créer ou supprimer des comptes, et consulter des fichiers de logs.

L’administrateur système aura, lui, accès aux **journaux d’activité du système** pour garantir le bon fonctionnement de l’application.

Enfin, la portée inclut **les aspects de sécurité et d’accessibilité**. Un **accès sécurisé via SSH** sera mis en place pour la gestion à distance, et les bonnes pratiques de protection des données et des accès seront respectées.

En revanche, **certaines fonctionnalités sont exclues** de cette portée :
- Lors de l’inscription, **pas de confirmation par SMS ou par mail**.
- Exclusion de la **modification avancée des informations personnelles** et des accès aux historiques.
- **Pas de développement d'application mobile**, le projet se limite à une **plateforme web accessible via un navigateur**.

---
## Chapitre 2 – Terminologie employée / Glossaire : 
### Terminologie employée / Glossaire ✅

Ce chapitre à pour objectif de définir les termes clés utilisés dans le cadre de ce projet afin d’assurer une compréhension claire et précise et éviter toute ambiguïté entre les différents parties prenantes du projet. Un glossaire clair facilite la communication et permet d’assurer la cohérence tout au long du projet.

**Le visiteur** est un utilisateur qui n’est pas inscrit à l’application. Il possède un accès très limité et peut consulter seulement la page de garde et la page de création de compte dans le cas où il cherche à s’inscrire.  
Il ne possède aucun accès aux modules de calcul et donc à l'historique personnel.

**Les utilisateurs inscrits** sont des personnes qui ont créé un compte sur la plateforme. Il peut accéder à un tableau de bord personnalisé ou il pourra utiliser les modules de calculs, consulter l’historique de ses résultats et modifier ses informations personnelles comme son mot de passe.

**L’administrateur web** est une personne ayant des droits d’accès avancés sur la plateforme. Il est responsable de la gestion des utilisateurs. Cela comprend la création de nouveaux comptes ou la suppression de nouveaux comptes et la gestion de l’historique de chaque utilisateur. Il peut également consulter les fichiers logs pour suivre l’activité des utilisateurs.

**L’administrateur système** est responsable de la gestion technique de la plateforme. Il supervise l’installation et la maintenance du serveur web, s’assure du bon fonctionnement du système et accéder aux journaux d’activité pour surveiller l’intégrité et la sécurité de l’application. Il n’est pas impliqué dans la gestion des utilisateurs ou des données fonctionnelles de l’application.

**Un module de calcul** est un outil disponible sur la plateforme permettant aux utilisateurs inscrits de réaliser des calculs (probabilité et cryptographie). Les résultats de ces calculs sont stockés dans un historique pour consultation ultérieure.

**Le tableau de bord** est l’interface personnalisée dans laquelle les utilisateurs inscrits accèdent une fois connectés. Il affiche les modules de calcul disponibles, les résultats passés, et permet la gestion du compte personnel.

**La base de données MySQL** est le système de gestion de base de données utilisé pour stocker les informations relatives aux utilisateurs (identifiants, historiques) et aux calculs effectués.

**L’utilisation du protocole SSH** permet la communication sécurisée permettant d’accéder à distance au serveur, de manière cryptée, pour effectuer des tâches d’administration ou de maintenance. L’accès SSH est limité aux administrateurs système.

---
## Chapitre 3 – Cas d'utilisation : 
### Cas d’utilisation ✅

Les cas d’utilisation vont permettre d’expliciter le comportement de l’application. Diverses conditions peuvent affecter un comportement différent de la plateforme.  
Divers scénarios peuvent prendre place en fonction des requêtes effectuées par les intervenants.

---
| **Cas d’utilisation**  | **Se connecter à son compte** |
|------------------------|--------------------------------|
| **Description**        | Permettre à un utilisateur inscrit de s’authentifier sur la plateforme en saisissant ses identifiants et d’accéder à son espace personnel sécurisé. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateurs inscrits |
| **Conditions Initiales** | - L’utilisateur doit posséder un compte valide sur la plateforme. <br> - L’utilisateur doit connaître son login et son mot de passe. |
| **Scénario Nominal**  | 1. L’utilisateur accède à la page de connexion de la plateforme. <br> 2. Il saisit son nom d’utilisateur et son mot de passe dans les champs dédiés. <br> 3. Le système vérifie les informations d’authentification. <br> 4. Si les informations sont valides, l’utilisateur est redirigé vers son tableau de bord. |
| **Scénario Alternatif** | - Si les informations sont incorrectes : <br> - Le système affiche un message d’erreur précisant que les identifiants sont invalides. <br> - L’utilisateur peut réessayer s’il s’est trompé sur un caractère. |
| **Exception**         | - En cas de problème technique : <br> - Le système affichera un message informant que la connexion est temporairement indisponible. |
<br><br>
---

| **Cas d’utilisation**  | **Création de compte** |
|------------------------|------------------------|
| **Description**        | Permet à un visiteur de s’inscrire sur la plateforme en remplissant un formulaire d’inscription. Une fois les informations validées, un compte utilisateur est créé. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateur (Visiteur) |
| **Conditions Initiales** | - L’utilisateur n’a pas de compte existant sur la plateforme. <br> - La plateforme est accessible via un navigateur web. |
| **Scénario Nominal**  | 1. L’utilisateur accède à la page d’inscription. <br> 2. Il remplit le formulaire avec les informations requises. <br> 3. Il résout un CAPTCHA simple. <br> 4. Le système vérifie que les informations sont complètes et que l’identifiant n’est pas déjà utilisé. <br> 5. Le compte est créé et enregistré dans la base de données. <br> 6. Un message de confirmation est affiché indiquant que l’inscription a été réussie. |
| **Scénario Alternatif** | - Si l’identifiant est déjà utilisé : <br> - Le système affiche un message d’erreur demandant à l’utilisateur de choisir un autre identifiant. <br> - Si le CAPTCHA n’est pas correctement résolu : <br> - Le système demande de résoudre un nouveau CAPTCHA. |
| **Exception**         | - Le système affiche un message informant que l’inscription a échoué et suggère de réessayer. |
<br><br>
---


| **Cas d’utilisation**  | **Connexion au compte administrateur** |
|------------------------|------------------------------------------|
| **Description**        | Permet à l’administrateur de s’authentifier sur la plateforme à l’aide de ses identifiants pour accéder à des fonctionnalités spécifiques de gestion ou de supervision. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Administrateur (web et système) |
| **Conditions Initiales** | - L’administrateur possède un compte avec des identifiants et mot de passe valides. |
| **Scénario Nominal**  | 1. L’administrateur accède à la page de connexion dédiée. <br> 2. Il saisit son identifiant et son mot de passe. <br> 3. Le système vérifie les informations d’authentification. <br> 4. Si les informations sont correctes, l’administrateur est redirigé vers son interface d’administration. |
| **Scénario Alternatif** | - Si les informations saisies sont incorrectes : <br> - Le système affiche un message d’erreur précisant que les identifiants sont invalides. <br> - L’administrateur peut réessayer. |
| **Exception**         | - En cas de problème technique : <br> - Le système affiche un message informant que le service est momentanément indisponible. 
<br><br>
---



| **Cas d’utilisation**  | **Consulter la liste des utilisateurs inscrits** |
|------------------------|--------------------------------------------------|
| **Description**        | Permet à l’administrateur web d’accéder à une vue listant les utilisateurs enregistrés sur la plateforme, ainsi que leurs informations principales. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Administrateur web |
| **Conditions Initiales** | - L’administrateur web est connecté à son compte avec des identifiants valides. <br> - La plateforme est opérationnelle et les données des utilisateurs sont accessibles dans la base de données. |
| **Scénario Nominal**  | 1. L’administrateur web accède à l’interface d’administration. <br> 2. Il clique sur l’option permettant de consulter la liste des utilisateurs inscrits. <br> 3. Le système récupère les données des utilisateurs depuis la base de données. <br> 4. Une page s’affiche avec la liste des utilisateurs et leurs informations principales. |
| **Scénario Alternatif** | - Si aucun utilisateur ne s’est créé de compte sur la plateforme : <br> - Un message s’affiche comme quoi il n’y a aucun utilisateur d’inscrit sur la plateforme. |
| **Exception**         | - En cas de non-fonctionnement de la base de données ou erreur technique : <br> - Le système affiche un message d’erreur indiquant que la liste des utilisateurs est momentanément indisponible. |
<br><br>
---

| **Cas d’utilisation**  | **Supprimer des résultats enregistrés** |
|------------------------|------------------------------------------|
| **Description**        | Permet à l’utilisateur de supprimer des résultats qu’il ne souhaite plus garder dans son historique. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Utilisateur inscrit |
| **Conditions Initiales** | - L’utilisateur doit être connecté sur son compte pour accéder à son tableau de bord. <br> - L’utilisateur doit avoir enregistré au moins un calcul dans l’historique. |
| **Scénario Nominal**  | 1. L’utilisateur accède à son historique via le tableau de bord. <br> 2. L’utilisateur sélectionne le résultat qu’il souhaite supprimer. <br> 3. L’utilisateur clique sur “Supprimer”. <br> 4. Un message de confirmation s’affiche pour la suppression. <br> 5. L’utilisateur confirme la suppression. <br> 6. Si tout est bien supprimé, elle sera également supprimée dans la base de données. |
| **Scénario Alternatif** | - S’il n'y a aucun résultat sélectionné : <br> - Un message s’affiche comme quoi aucun résultat n’a été sélectionné. |
| **Exception**         | - Si une erreur se produit entre la connexion avec la base de données : <br> - Un message s'affiche pour indiquer à l’utilisateur qu’il y a un problème de connexion entre la base de données et la plateforme. |
<br><br>
---

| **Cas d’utilisation**  | **Utiliser un module de calcul** |
|------------------------|--------------------------------|
| **Description**        | Permet à un utilisateur inscrit de choisir et d’utiliser un module proposé par la plateforme. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateur inscrit |
| **Conditions Initiales** | - L’utilisateur est connecté à son compte. <br> - La plateforme est opérationnelle et propose des modules de calcul. |
| **Scénario Nominal**  | 1. L’utilisateur connecté accède à son tableau de bord. <br> 2. Il sélectionne le module de calcul qu’il souhaite utiliser. <br> 3. Le système affiche l’interface du module sélectionné par l’utilisateur avec les champs nécessaires. <br> 4. L’utilisateur entre les données nécessaires pour le calcul et soumet l’opération. <br> 5. Le système affiche le résultat. <br> 6. Si l’utilisateur souhaite, il peut effectuer un autre calcul ou revenir à son tableau de bord. |
| **Scénario Alternatif** | - Si l’utilisateur entre des données incorrectes : <br> - Le système affiche un message d’erreur lui demandant de corriger les données. <br> - Si l'utilisateur décide d’annuler le calcul avant de soumettre les données : <br> - Le système retourne à la page d’accueil du module sans enregistrer les données. |
| **Exception**         | - En cas de problème technique ou d’erreur dans le calcul : <br> - Le système affiche un message d’erreur indiquant que le calcul a échoué et invite l’utilisateur à réessayer plus tard. |
<br><br>
---

| **Cas d’utilisation**  | **Accéder aux journaux d’activités** |
|------------------------|----------------------------------------------|
| **Description**        | Permet à l’administrateur système d’accéder aux journaux d’activités de la plateforme pour surveiller et analyser l’activité du système, notamment les connexions, les modifications de comptes et les éventuelles anomalies. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Administrateur Système |
| **Conditions Initiales** | - L’administrateur système est connecté avec des identifiants. <br> - Les journaux d’activités sont disponibles et à jour. |
| **Scénario Nominal**  | 1. L’administrateur système accède à l’interface de gestion depuis la page d’accueil de la plateforme. <br> 2. Il sélectionne l’option permettant de consulter les journaux d’activités. <br> 3. Le système affiche une liste détaillée des activités récentes. |
| **Scénario Alternatif** | - Si aucun journal d’activité récent n’est disponible : <br> - Le système affiche un message d’erreur informant qu’il n’y a pas d’activités à afficher pour la période sélectionnée. |
| **Exception**         | - En cas de problème technique ou d'indisponibilité des journaux : <br> - Le système affiche un message d’erreur indiquant que les journaux ne peuvent pas être consultés pour le moment. |
<br><br>
--- 

| **Cas d’utilisation**  | **Accéder à son profil pour modifier son mot de passe** |
|------------------------|----------------------------------------------------------|
| **Description**        | Permet à un utilisateur de consulter son profil et de modifier son mot de passe afin d’assurer la sécurité et la personnalisation de son compte. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateur Inscrit |
| **Conditions Initiales** | - L’utilisateur est connecté avec ses identifiants valides. <br> - Le profil de l’utilisateur est accessible dans la base de données. |
| **Scénario Nominal**  | 1. L’utilisateur accède à son tableau de bord après s’être connecté. <br> 2. Il se rend dans l’onglet “Mon profil”. <br> 3. Le système affiche les informations du profil de l’utilisateur. <br> 4. L’utilisateur sélectionne l’option “Modifier le mot de passe”. <br> 5. Il entre son mot de passe actuel pour vérification. <br> 6. Il entre son nouveau mot de passe et le confirme. <br> 7. Le système valide le nouveau mot de passe et le met à jour dans la base de données. |
| **Scénario Alternatif** | - **Si l’utilisateur saisit un mot de passe incorrect :** <br> - Le système affiche un message d’erreur indiquant que le mot de passe actuel est invalide. <br> - **Si le nouveau mot de passe ne respecte pas les critères de sécurité :** <br> - Le système affiche un message d’erreur précisant les règles à suivre pour le mot de passe. |
| **Exception**         | - **En cas de problème technique ou d’indisponibilité du système :** <br> - Le système affiche un message d’erreur informant que la modification du mot de passe n’est pas possible pour le moment et invite l’utilisateur à réessayer plus tard. |
<br><br>
---

| **Cas d’utilisation**  | **Connexion SSH au serveur Raspberry Pi 4** |
|------------------------|----------------------------------------------|
| **Description**        | Permet aux administrateurs d’établir une connexion sécurisée au serveur hébergé sur un Raspberry Pi 4 pour effectuer des tâches de maintenance ou de supervision. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Administrateur Système |
| **Conditions Initiales** | - Le Raspberry Pi 4 est allumé et accessible via le réseau. <br> - L’administrateur dispose des identifiants nécessaires pour établir la connexion SSH. <br> - Le port SSH est configuré et ouvert sur le Raspberry Pi 4. |
| **Scénario Nominal**  | 1. L’administrateur ouvre le terminal ou un client SSH. <br> 2. Il saisit l’adresse IP ou le nom de domaine du Raspberry Pi 4. <br> 3. Il entre le port SSH. <br> 4. Le système demande les identifiants d’accès. <br> 5. L’administrateur fournit les identifiants requis. <br> 6. Le serveur authentifie l’administrateur et établit la connexion. <br> 7. Une session terminal est ouverte, permettant à l’administrateur d'interagir avec le système. |
| **Scénario Alternatif** | - **Si une clé privée est utilisée pour l’authentification :** <br> - L’administrateur spécifie le chemin vers la clé privée dans le client SSH. <br> - Le serveur authentifie la clé et autorise l’accès. |
| **Exception**         | - **Si l’adresse IP ou le nom d’hôte est incorrect :** <br> - Le système retourne un message d’erreur. <br> - **Si les identifiants fournis sont incorrects :** <br> - Le système affiche un message d’échec d'authentification. <br> - **Si le port SSH est fermé ou bloqué par un pare-feu :** <br> - Le client retourne une erreur de connexion. <br> - **Si le système SSH sur le serveur est indisponible :** <br> - Le client retourne une erreur indiquant que le service est inaccessible. <br> - Un message s’affiche comme quoi le serveur est indisponible en plus de l’erreur retournée. |
<br><br>
---

| **Cas d’utilisation**  | **Suppression d’un utilisateur** |
|------------------------|----------------------------------|
| **Description**        | Permet à l’administrateur web de supprimer un utilisateur inscrit ainsi que son historique de calculs. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Administrateur web |
| **Conditions Initiales** | - L’administrateur web est connecté à son compte. <br> - L’utilisateur à supprimer est présent dans la base de données. |
| **Scénario Nominal**  | 1. L’administrateur web accède à la liste des utilisateurs. <br> 2. Il sélectionne l’utilisateur à supprimer. <br> 3. La plateforme demande une confirmation de suppression. <br> 4. L’administrateur confirme la suppression. <br> 5. L’utilisateur et son historique de calculs sont supprimés de la base de données. |
| **Scénario Alternatif** | - **Si l’utilisateur sélectionné n’existe pas :** <br> - Un message d’erreur s’affiche. |
| **Exception**         | - **Si le serveur est indisponible :** <br> - La suppression ne peut pas être effectuée, et un message d’erreur est affiché. |
<br><br>
---

| **Cas d’utilisation**  | **Création de compte utilisateurs depuis un fichier CSV** |
|------------------------|------------------------------------------------------------|
| **Description**        | Permet à l’administrateur web d’ajouter plusieurs utilisateurs à la plateforme en important un fichier CSV. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Administrateur Web |
| **Conditions Initiales** | - L’administrateur web est connecté à son compte. <br> - Un fichier CSV est disponible et accessible. |
| **Scénario Nominal**  | 1. L’administrateur web accède à la page de gestion des utilisateurs. <br> 2. Il clique sur l’option d’importation de fichier CSV. <br> 3. La plateforme lui permet de sélectionner un fichier CSV depuis son ordinateur. <br> 4. Le fichier est envoyé au serveur et son contenu est vérifié. <br> 5. Si tout est correct, les utilisateurs sont créés dans la base de données, et une confirmation est affichée. |
| **Scénario Alternatif** | - **Si le fichier CSV contient des erreurs :** <br> - Un message d’erreur détaillé s’affiche. |
| **Exception**         | - **Si le fichier CSV est inexploitable ou corrompu :** <br> - La procédure est annulée, et un message d'échec est affiché. |
<br><br>
---

| **Cas d’utilisation**  | **Affichage de l’historique de calculs** |
|------------------------|-------------------------------------------|
| **Description**        | Permet à l’utilisateur de consulter son historique des calculs qu’il a réalisés sur la plateforme. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateur Inscrit |
| **Conditions Initiales** | - L’utilisateur est connecté à son compte et a effectué des calculs précédemment. |
| **Scénario Nominal**  | 1. L’utilisateur se connecte à son compte et accède à son tableau de bord. <br> 2. Il clique sur l’option “Historique des calculs”. <br> 3. L’historique des calculs précédemment effectués s’affiche avec les résultats. |
| **Scénario Alternatif** | - **Si l'utilisateur n’a pas effectué de calculs précédemment :** <br> - Un message s’affiche en lui indiquant qu’il n’a jamais effectué de calcul sur cette plateforme. |
| **Exception**         | - **Si le serveur rencontre un problème lors du chargement de l’historique :** <br> - Un message d’erreur est affiché. |
<br><br>
---

| **Cas d’utilisation**  | **Effectuer un calcul et afficher le résultat** |
|------------------------|--------------------------------------------------|
| **Description**        | Permet à l’utilisateur de faire le calcul de son choix d’après les différentes propositions du site web. |
| **Portée**            | Boîte Blanche |
| **Niveau**            | Stratégique |
| **Acteur principal**  | Utilisateur |
| **Conditions Initiales** | - L’utilisateur doit être connecté à son compte. |
| **Scénario Nominal**  | 1. L’utilisateur accède au tableau de bord. <br> 2. Il clique sur l’onglet des modules de calcul. <br> 3. Il sélectionne le type de calcul qu’il souhaite réaliser. <br> 4. L’utilisateur entre les données demandées en fonction de son type de calcul sélectionné. <br> 5. Le système effectue l’opération et affiche le résultat. |
| **Scénario Alternatif** | - **Si un champ est laissé vide :** <br> - Un message s'affiche indiquant qu'il manque un champ à remplir. |
| **Exception**         | - **Si une erreur intervient :** <br> - Un message s'affiche indiquant que le service est momentanément indisponible et d’essayer à nouveau dans quelques minutes. |
<br><br>
---

| **Cas d’utilisation**  | **Visualiser la vidéo explicative** |
|------------------------|--------------------------------------|
| **Description**        | Permet aux visiteurs de visualiser une vidéo explicative de l’application, leur laissant le choix de s’inscrire pour bénéficier des différentes fonctionnalités. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Utilisateur |
| **Acteur principal**  | Utilisateur (Visiteur) |
| **Conditions Initiales** | - Le visiteur doit accéder à la page d’accueil du site web. <br> - La vidéo explicative est disponible et fonctionnelle pour la visualisation. |
| **Scénario Nominal**  | 1. L’utilisateur accède à la plateforme pour visualiser la vidéo. <br> 2. Il clique sur la vidéo pour la lancer et peut visualiser la vidéo. <br> 3. La vidéo se lance. |
| **Scénario Alternatif** | - **Si l’utilisateur ne peut pas lire la vidéo :** <br> - Un message s’affiche pour indiquer que la vidéo est momentanément indisponible. |
| **Exception**         | - **S’il y a un problème technique :** <br> - Un message s’affiche en indiquant qu’il y a un problème avec la vidéo. |
<br><br>
---

| **Cas d’utilisation**  | **Insérer des paramètres pour effectuer un calcul** |
|------------------------|------------------------------------------------------|
| **Description**        | Permet à l’utilisateur de saisir les données ou paramètres nécessaires afin que le système puisse effectuer le calcul demandé. |
| **Portée**            | Boîte Noire |
| **Niveau**            | Sous-Fonction |
| **Acteur principal**  | Utilisateur |
| **Conditions Initiales** | - L’utilisateur doit être connecté au système et avoir accès au module de calcul correspondant. |
| **Scénario Nominal**  | 1. L’utilisateur se connecte à son compte pour accéder au tableau de bord. <br> 2. L’utilisateur accède à la page du module de calcul. <br> 3. Le système affiche les champs nécessaires pour saisir les paramètres. <br> 4. L’utilisateur valide la saisie en cliquant sur le bouton “Valider”. <br> 5. Le système reçoit les paramètres et les traite pour exécuter le calcul. <br> 6. Le résultat est affiché à l’utilisateur. |
| **Scénario Alternatif** | - **Si les paramètres sont incomplets ou si les champs ne sont pas remplis :** <br> - Un message s’affiche demandant de compléter les champs manquants. |
| **Exception**         | - **Si une erreur empêche le calcul :** <br> - L’utilisateur est informé qu'une action est impossible et invité à réessayer plus tard. |
<br><br>
---


## Chapitre 4 – La technologie employée : 

### A. Quelles sont les exigences technologiques pour ce système ? ✅
Le système nécessite des technologies spécifiques pour assurer son bon fonctionnement, sa sécurité et sa performance. L’application sera déployée sur un Raspberry Pi 4, compact et performant, fonctionnant sous le système d’exploitation Linux (Debian). Il offre un environnement idéal pour supporter une application légère tout en restant accessible en termes de coût et de maintenance.

Du côté de l'hébergement de l'application, un serveur web Apache sera utilisé. Sa robustesse et sa compatibilité avec les technologies PHP permettent de gérer efficacement les requêtes HTTP. La gestion des données sera confiée à un serveur de gestion de base de données MySQL qui permettra de garantir un stockage des données utilisateurs, des logs et des résultats de calcul sécurisé et structuré.
La plateforme nécessitera également d’un accès SSH pour permettre une administration à distance. Ce protocole offre une communication cryptée et sécurisée, indispensable pour les tâches techniques comme la maintenance ou la gestion des journaux d’activité.

Pour finir, il faut inclure la bonne mise en œuvre de la gestion des utilisateurs assurant des droits d’accès différenciés (visiteur, utilisateur inscrit, administrateur web et administrateur système). Ces technologies doivent être intégrées de manière cohérente pour garantir le bon fonctionnement de la plateforme en répondant ainsi aux besoins du client.

### B. Avec quels systèmes ce système s’interfacera-t-il et avec quelles exigences ? ✅
Tout d’abord, l’application s'interfacera avec un serveur de base de données MySQL qui jouera un rôle crucial dans la gestion de données. Ce serveur permettra de stocker les données des utilisateurs, les résultats de calculs, comptes et mot de passe des utilisateurs, ainsi que les journaux d’activité. 
L’intégration devra garantir la sécurité des données grâce à l’utilisation de connexions sécurisées et à un gestion stricte des privilèges, afin d’empêcher tout accès non autorisé.

Le système collaborera également avec un serveur web Apache, chargé de traiter les requêtes HTTP et d’héberger l’application. Cette interconnexion devra être optimisée pour assurer une performance élevée et une compatibilité totale avec les technologies web modernes, comme HTML5 et CSS3.

Par ailleurs, le système devra s’interfacer avec le protocole SSH qui permettra une administration à distance de manière sécurisée. Ce protocole sera essentiel pour les tâches de maintenance par l’administrateur système.

De plus, des systèmes d’administration et de gestion des journaux d’activité permettent aux administrateurs de surveiller l’utilisation de la plateforme. Ces journaux devront être facilement consultables et présenter les informations nécessaires pour assurer un suivi précis des actions effectuées sur le système.

En conclusion, l’application devra interagir avec ces systèmes de manière fluide, tout en répondant aux exigences de sécurité, de performance et de compatibilité.

---
## Chapitre 5 – Autres Exigences :
### A. Processus de développement : ✅

- **a. Qui sont les participants au projet ? ✅**

Plusieurs acteurs interviennent dans le développement de l’application web, chacun jouant un rôle crucial et spécifique à la réussite du projet.

Tout d’abord, le client. Il est à l’origine du projet en définissant les besoins et les objectifs à atteindre. Il fournit également un cahier des charges détaillé et intervient à chaque étape pour valider les avancées du développement à apporter des ajustements si nécessaire.

Ensuite, l’équipe de développement. Cette équipe est responsable de toutes les étapes techniques du projet, incluant l’analyse des besoins, le choix des technologies, le développement du code, les tests et le déploiement final.

Pour finir, les utilisateurs. Bien qu’ils interviennent pas directement dans le développement, jouent un rôle clé dans la validation fonctionnelle. Leur retour d’expérience sera essentiel pour ajuster l’application afin qu’elle réponde pleinement à leurs attentes en termes d’utilisabilité et de fonctionnalités.

Ces différents participants collaborent pour garantir que le projet respecte les délais, les contraintes techniques et les objectifs définis dès le départ.


- **b. Quelles valeurs devront être privilégiées ? ✅**

Pour assurer la réussite du projet, plusieurs valeurs fondamentales devront être intégrées dans le processus de développement. Ces valeurs garantiront que l’application réponde aux attentes des utilisateurs tout en respectant les objectifs fixés.

L’interface utilisateur doit être conçue de manière intuitive, permettant aux utilisateurs, même les moins expérimentés, de naviguer et d’utiliser les fonctionnalités sans difficulté. La simplicité est essentielle pour encourager l’adoption de la plateforme par tous les types d’utilisateurs.

La protection des données des utilisateurs est une priorité absolue. Cela inclut des mesures de sécurité robustes, telles que la gestion stricte des droits d’accès en fonction des rôles (visiteur, utilisateur inscrit, administrateur web et administrateur système) et l’intégration d’un CAPTCHA pour prévenir les inscriptions frauduleuses.

L’application doit offrir des résultats précis et garantir un fonctionnement stable. Elle doit être capable de traiter les demandes des utilisateurs sans erreurs majeures, tout en assurant la conservation et la gestion des données, comme les historiques de calcul.

La plateforme peut être accessible à tout moment sauf en cas de maintenance. Cela implique une optimisation des ressources pour garantir des temps de réponse rapides et une disponibilité maximale, même sur une infrastructure limitée comme le Raspberry Pi 4.

Le système doit être notamment conçu de manière à pouvoir ajouter de nouvelles fonctionnalités ou étendre des capacités existantes en réponse aux besoins des utilisateurs.

Ces valeurs, appliquées à chaque étape du développement permettront de créer une application performante, sécurisée et en cohérence aux besoins du client.


- **c. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires souhaitent-ils ? ✅**

La réussite du projet repose sur une communication efficace et une transparence constante, afin de répondre aux attentes des différents intervenants. Les utilisateurs et commanditaires souhaitent des retours clairs ainsi qu’une visibilité régulière sur l’avancement et la qualité du projet.

Pour les **utilisateurs**, leur priorité est de disposer d’un système fonctionnel répondant à leurs besoins : 
Une information claire sur les fonctionnalités disponibles, notamment via une page d’accueil explicative (vidéo et texte explicatif) qui met en avant les avantages de la plateforme.
Une expérience fluide et intuitive lors de l’utilisation des fonctionnalités, comme l’accès aux modules de calcul et à l’historique.

Les **administrateurs** ont besoin d’une visibilité claire pour superviser et gérer le système : 
L’accès à des journaux d’activité détaillées pour surveiller les connexions, les inscriptions et les actions réalisées par les utilisateurs
Un tableau de bord administratif pour gérer efficacement les comptes utilisateurs, consulter les logs, et superviser les performances du système.

- **d. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?✅**

Dans le cadre du développement de cette plateforme web dédiée aux calculs mathématiques, il est essentiel de distinguer ce que nous pouvons acheter et ce que nous devons construire.

Concernant les achats, des matériels de base tels que le RaspBerry Pi, constituent un élément important à acquérir.
Cet outil sera accompagné d’une carte SD pour stocker d'éventuelles données.
Sur le plan logiciel, il est indispensable de se procurer un outil comme Debian.

La plateforme web devra également être développée par rapport aux besoins spécifiques du client, et des différents utilisateurs (visiteurs, utilisateurs inscrits, administrateurs web et administrateurs système). 

Cela inclût la création des modules de calculs adaptés et d’un système de gestion des utilisateurs permettant la gestion des rôles, des connexions et des journaux d’activité.
Une attention particulière sera apportée sur la conception de l’interface utilisateur qui devra être intuitive, fluide et accessible pour garantir une expérience optimale pour chaque type d’utilisateur.

- **e. Quelles sont les autres exigences du processus ? (exemple : tests, installation, etc...) ✅**

En plus des exigences liées à la visibilité du projet, plusieurs autres éléments sont essentiels pour garantir le succès du développement de l’application. Cela concerne les tests, l’installation, la maintenance, la documentation afin d’assurer une évolution sans faille.

Des **tests** doivent être effectués à chaque étape du développement pour s’assurer que l’application fonctionne correctement et respecte les exigences des utilisateurs. Il faut inclure divers types de tests : 

- Les **tests de performance** qui vérifient la réactivité de l’application sur une machine comme le Raspberry Pi 4.

- Les **tests fonctionnels** vérifient que chaque fonctionnalité fonctionne comme prévu.

- Les **tests de sécurité** qui visent à vérifier la solidité de l’application face aux inscriptions malveillantes ou l’accès non autorisé aux données.

Une fois le développement terminé, l’application doit être installée et déployée correctement : 

- Il faudra effectuer l’installation de l’application dans le Raspberry Pi 4 y compris l’installation des composants nécessaires tels qu’Apache, MySQL etc…

- Une fois l’installation terminée, un processus de déploiement doit être mis en place pour rendre l’application accessible aux utilisateurs autorisés.

Après le déploiement, un suivi de la maintenance et des mises à jour sera nécessaire pour assurer la durabilité de l'application : 

- Les composants de l’application, les modules de calcul et la sécurité pourront être mis à jour régulièrement en fonction des retours des utilisateurs ou de l'avancée technologique.

- Il faudra surveiller de prêt la performance de la plateforme et du serveur pour éviter tout ralentissement dû aux ressources limitées du Raspberry Pi 4.

Une documentation est essentielle pour le bon fonctionnement de l’application :

- Une vidéo explicative sur les avantages d’utilisation de l’application sera présente dans la page d’accueil.

- Un texte explicatif de l’application sera également dans la page d’accueil pour une explication claire et précise de la plateforme.

- Une potentielle documentation détaillant la structure du code, des bases de données et des technologies utilisées afin de faciliter la maintenance de l’application.

Ces exigences garantiront que le projet soit fonctionnel, performant, sécurisé et évolutif sur le long terme, tout en répondant aux attentes des utilisateurs et des commanditaires.

- **f. À quelle dépendance le projet est-il soumis ? ✅**

Ce projet est soumis à plusieurs dépendances qu’elles soient techniques, matérielles ou humaines... Ces dépendances doivent être prises en compte pour garantir une gestion optimale du projet.

Du côté des **dépendances matérielles**, le projet repose sur un Raspberry Pi 4 comme serveur principal, ce qui crée une dépendance vis-à-vis de la disponibilité et des capacités de ce matériel.
Bien que ce Raspberry Pi 4 possède des ressources limitées (processeur, mémoire, stockage) qui peuvent restreindre la performance de l’application, elle devra être gérée et surveillée de prêt pour garantir une expérience utilisateur fluide sans surcharge du système. 

Du côté des **dépendances logicielles**, le projet repose sur l’utilisation de technologies spécifiques comme l'utilisation du système d’exploitation Linux (Debian), le serveur web Apache et une base de données MySQL.
Ces technologies sont interconnectées et nécessitent une configuration précise pour assurer le bon fonctionnement de l’application. En cas de changement de technologie, cela pourrait affecter la stabilité ou la compatibilité du système global.

Du côté des **dépendances humaines**, le succès du projet dépend également de la disponibilité des ressources humaines. Le développement de l'application nécessite l’intervention de développeurs pour la création du code, d’administrateur pour la gestion du serveur et des bases de données, et de testeurs pour assurer la qualité du produit final. La capacité de ces intervenants à respecter les délais et à travailler efficacement ensemble représente une dépendance pour le bon déroulement du projet.

Du côté des **dépendances organisationnelles**, le projet est soumis à l’organisation du travail. Des décisions organisationnelles, telles que l’attribution des tâches, la planification et la gestion des priorités, peuvent influencer l’avancement du projet. 

Il faut également prendre en compte les dépendances réglementaires et juridiques. Le respect de confidentialité des données personnelles est crucial si l’application collecte des informations sur les utilisateurs. Ces exigences peuvent entraîner des ajustements techniques et des contraintes supplémentaires dans le développement de l’application.

En somme, ces dépendances doivent être prises en compte et doivent être gérées de manière à minimiser les risques et éviter les retards de livraison. En respectant tout cela, on peut mener ce projet au succès.


### B. Règles Métier : ✅

Les règles métiers définissent les principes et les contraintes du fonctionnement du système. Elles garantissent également que les objectifs du projet sont respectés. Ces règles assurent une expérience utilisateur cohérente tout en protégeant la sécurité de la plateforme.

Tout d’abord, les utilisateurs sont classés par catégories avec des rôles distincts  : le visiteur, les utilisateurs inscrits, l’administrateur web et l’administrateur système. 

Chaque rôle possède des permissions spécifiques adaptées à ses besoins.
Les visiteurs ont un accès très limité à la page d’accueil et à une vidéo explicative, tandis que les utilisateurs inscrits peuvent accéder à des modules de calcul, gérer leur profil, et consulter un historique des résultats. Les administrateurs, quant à eux, bénéficient de droits supplémentaires pour superviser ou gérer les utilisateurs et les journaux d’activités.

Ensuite, l’inscription des utilisateurs doit être protégée grâce à un CAPTCHA simple, tel qu’une simple opération mathématique.

Enfin, des principes de sécurité et de confidentialité sont appliqués. Les données des utilisateurs et les résultats des calculs doivent être stockés de manière sécurisée.

Ces règles métiers permettent donc de maintenir un système organisé, sécurisé, et centré sur les besoins des différents acteurs, tout en répondant aux exigences techniques et fonctionnelles du projet.

### C. Performances : ✅

L’application doit répondre à des exigences de performance pour garantir une expérience utilisateur fluide et fiable, tout en prenant compte des contraintes imposées par l’environnement matériel et logiciel. 

Les modules de calculs doivent fournir des résultats de manière très rapide, même en cas de saisies complexes.
La navigation entre les différentes pages (connexion, tableau de bord, profil…) doit être également rapide et sans délai perceptible pour l’utilisateur.

L’application doit pouvoir accueillir plusieurs utilisateurs actifs simultanément sans dégradation des performances, en tenant compte des ressources limitées du Raspberry Pi 4.

Étant donné l’utilisation du Raspberry Pi 4, l’application doit être optimisée pour minimiser la consommation de la RAM et de l’espace de stockage de cet outil. Cela inclût donc des algorithmes efficaces et légers.

Les résultats produits par les modules de calcul doivent être conformes aux attentes fonctionnelles, même en cas de saisie multiple ou inhabituelle.

Bien que l’application soit déployée sur un Raspberry Pi 4, elle doit être conçue de manière à pouvoir la modifier facilement en cas de maintenance.

Les journaux d’activité doivent être enregistrés sans ralentir le système ou affecter les performances globales.

Ces exigences de performances sont essentielles pour assurer la qualité et la durée de vie de l’application, tout en répondant aux besoins des utilisateurs et aux contraintes de l’environnement matériel.


### D. Opérations, sécurité, documentation : ✅

L’application doit garantir une gestion efficace des opérations pour assurer sa disponibilité et son bon fonctionnement. Elle doit être accessible en continue, avec des temps d’arrêt planifiés uniquement pour les tâches de maintenance. Toutes les actions importantes comme les connexions, inscriptions ou suppressions, seront consignées dans les journaux d’activités permettant un suivi complet de ce qu’il se passe. Les administrateurs doivent disposer d’outils pour superviser les indicateurs clés de performances et intervenir rapidement en cas de problème.

La sécurité est un aspect primordial de l’application. Des restrictions d’accès seront également protégées en fonction du type d’utilisateur. Les communications seront sécurisées avec HTTPS et SSH, limitant les risques de perte de données. De plus, des mécanismes préventifs comme le CAPTCHA pour les inscriptions seront implémentés pour prévenir les abus et les attaques.

Enfin, une documentation complète est essentielle pour assurer la durée de vie et la facilité d’utilisation du système. Une documentation technique détaillera les étapes simplifiera l’apprentissage des fonctionnalités pour les utilisateurs finaux. Les journaux d’activité seront également organisés de manière claire pour permettre aux administrateurs de superviser efficacement l'application. Ces éléments garantissent une adoption fluide et un fonctionnement sécurisé de l’ensemble de la plateforme.

### E. Utilisation et utilisabilité : ✅

Le système doit être conçu de manière à offrir une expérience utilisateur intuitive et adaptée aux besoins des différents profils d’utilisateurs.

Les visiteurs doivent pouvoir naviguer facilement sur la page d’accueil pour comprendre l’objectif de la plateforme, consulter les informations disponibles et visionner la vidéo explicative. L’inscription doit être rapide, avec un processus sécurisé mais simple notamment via l’utilisation du CAPTCHA. Pour les utilisateurs inscrits, le tableau de bord doit être structuré de manière claire, mettant en avant les modules de calcul et les options de gestion du profil et de l’historique.

Enfin, l'application devra inclure des feedbacks visuels comme des messages de confirmation ou des messages d’erreurs pour guider les utilisateurs dans leurs actions.

En adoptant ces principes, la plateforme assure une prise en main rapide, une satisfaction des utilisateurs et une réduction des erreurs d’utilisation.


### F. Maintenance et portabilité: ✅

La plateforme doit être développée de manière à faciliter sa maintenance, tout en garantissant une portabilité adaptée à différents environnements techniques. Cela permettra de maintenir un fonctionnement optimal de la plateforme, même en cas d’évolution des besoins ou des infrastructures.

Sur le plan de la maintenance, le code doit être bien structuré, documenté et conforme aux bonnes pratiques de développement, ce qui facilitera également les maintenances en cas de problème. De plus, des sauvegardes régulières de la base de données doivent être prévues pour assurer la continuité des services en cas d’incident.

En termes de portabilité, bien que l’application soit initialement déployée sur un Raspberry Pi 4, elle doit être conçue de manière à pouvoir être facilement transférée vers des environnements plus robustes si nécessaire. Cela inclut donc l’utilisation de technologies standardisées comme PHP et MySQL avec le respect des normes web. 

En adoptant ces pratiques, l’application pourra évoluer avec les besoins des utilisateurs en minimisant l'effort de maintenance.

### G. Questions non résolues ou reportées à plus tard: ✅

Certaines questions liées au projet nécessitent à être reportées à une phase ultérieure pour éviter le développement initial. 

La méthode de récupération de mot de passe par exemple, bien que le lien “Mot de passe oublié” soit présent, la fonctionnalité n’a pas été définie dans le cahier des charges, cependant, il est imposé de diriger ce lien vers une page indiquant que ce service est en maintenance.

De plus, la plateforme est prévue pour être en français, mais la possibilité d’inclure d’autres langues n’a pas encore été étudiée.





















