# Cahier des Charges - SAE3.01

**PASSOUBADY Maden / LAUDAT Séraphin**  
**SCHENDEL Léa / VIEIRA Lucas**  

## Cahier des Charges SAE3.01

---

## Sommaire :

### I. Objectif :
- A. Informations générales
- B. Objectifs du document
- C. Documents référencés 

### II. Enoncé :
- A. Description détaillée
- B. Contexte
- C. Objectif du projet

### III. Contraintes :
- A. Les contraintes techniques et fonctionnelles

### IV. Pré-Requis :
- A. Connaissances requises
- B. Ressources matérielles et logicielles
- C. Compétences nécessaires

### V. Priorités :
- A. Les priorités éventuelles du développement si elles ont été fixées avec    l’accord du client

---

## I. Objectif :

### A. Informations générales : ✅
Ce document vise à présenter le cahier des charges pour le développement d’une application web de calculs, conçue pour être utilisée par divers types d’utilisateurs.L’objectif principal de l’application est de permettre aux utilisateurs d’effectuer des calculs de cryptographie et de probabilité. Cela avec des droits d’accès différenciés selon le profil de l’utilisateur.

### B. Objectifs du document : ✅
L’objectif de ce document est de définir précisément les besoins de l’application, les fonctionnalités attendues et les contraintes liées au développement	 de l’application web de calculs. Ce document servira de référence pour l’ensemble de l’équipe, en détaillant les attentes du projet, le contexte de son utilisation, ainsi que les pré-requis techniques et fonctionnels. Il permet de s’assurer que la solution finale répond bien au besoin du client, tout en prenant en compte les spécificités du déploiement du Raspberry Pi 4.

### C. Documents référencés : ✅
Pour l’élaboration de ce document, nous nous sommes basés sur le cahier des charges fourni par M. HOGUIN ainsi que plusieurs ressources fournies par M. DJERROUD.

---

## II. Enoncé :

### A. Description détaillée : ✅
Le projet consiste à mettre en place une application web qui propose divers modules de calculs, notamment un module de cryptographie et un module de probabilités. 
Cette application doit prendre en compte quatres types d’utilisateurs : 
- Le visiteur, qui doit pouvoir accéder à l’application web, peut consulter la page d’accueil, la vidéo d’information ainsi que le formulaire d’inscription. Cependant, il ne peut pas accéder à son espace de membre car il ne possède pas de compte ni aux modules de calculs. 

- L’utilisateur inscrit possède les mêmes accès que le visiteur, cependant il peut se connecter à son espace de membre afin d’accéder aux modules de calculs. Il a aussi la possibilité de stocker le résultat dans un historique.
Enfin, il peut accéder à sa page d’information où il peut modifier son mot de passe.  

- L’administrateur web a pour but de gérer les comptes utilisateurs. Il peut les consulter, en créer et en supprimer.

- L’administrateur système a accès aux journaux d’activités de l’application web. 

Afin de garantir la sécurité de l’application, certaines mesures doivent êtres mise en place. Le formulaire d’inscription doit être protégé en intégrant un CAPTCHA sous forme de calcul simple, comme une soustraction ou une multiplication que l’utilisateur devra résoudre pour confirmer son inscription. Le but est d’éviter les attaques de robots ou de spams.

### B. Le contexte : ✅
Le projet s'inscrit dans le cadre de la création et de la mise en place d’une application qui permet d’effectuer divers opérations mathématiques. L’application doit être accessible pour tous types d’utilisateurs avec des accès différents en fonction du profil de chacun, sans nécessiter une configuration particulière côté client.

L’application sera déployée sur un Raspberry PI 4 capable de servir des serveurs web. Pour maximiser son efficacité, l’appareil fonctionnera sous le système d’exploitation Linux réputé pour sa stabilité et son optimisation des ressources.
L’hébergement des services web sera assuré par un serveur Apache, tandis que les données des utilisateurs et les résultats de calculs seront stockées dans une base de données MySQL.

Afin de permettre une gestion à distance pour les administrateurs, l’accès au Raspberry Pi 4 se fera via SSH, offrant une couche de sécurité supplémentaire.
Le projet vise donc à proposer une plateforme performante capable de servir des besoins de différents types d’utilisateurs	 tout en restant léger avec l’utilisation du Raspberry Pi 4 comme support matériel.

### C. Objectif du projet : ✅
L’objectif principal de ce projet est de développer une application qui propose un ensemble de modules de calcul accessibles selon le profil des utilisateurs. Cette application vise à être conviviale et sécurisée en prenant en compte quatre types d'utilisation : les visiteurs, les utilisateurs inscrits, l’administrateur web et l’administrateur système.

La plateforme permettra aux utilisateurs inscrits d’effectuer divers opérations mathématiques. 

Les utilisateurs non-inscrits (visiteurs) auront seulement accès à la page d’accueil offrant une présentation de l’application, incluant un texte explicatif et une vidéo visant à les inciter à s’inscrire. 

L’administrateur web devra lui assurer un suivi des actions administratives. Il pourra gérer les utilisateurs inscrits.

L’administrateur système ne possède donc pas le même rôle. Il aura pour but de garder un bon fonctionnement de l’application.

De plus, ce projet a pour objectif de garantir la sécurité des accès, de faciliter l’inscription des nouveaux utilisateurs et d’assurer la gestion des comptes via les fonctionnalités comme l’importation de compte via un fichier CSV.

Ce projet doit notamment être sécurisé en intégrant un CAPTCHA pour finaliser l’inscription d’un nouvel utilisateur pour vérifier qu’il ne s’agit pas d’un robot. Il suffira d’effectuer une simple opération de type addition ou multiplication pour finaliser son inscription.

---

## III. Contraintes :

### A. Les contraintes techniques et fonctionnelles : ✅
Le développement de cette application doit respecter plusieurs contraintes techniques et fonctionnelles pour garantir une expérience utilisateur fluide et une sécurité efficace au sein de celui-ci.

Tout d’abord, l’application sera déployée sur un Raspberry Pi 4, ce qui impose une utilisation des ressources optimisée pour éviter de surcharger le système. En plus de sa capacité limitée, il est donc essentiel de gérer efficacement la mémoire du Raspberry Pi 4 pour assurer une performance satisfaisante en cas d’utilisation.

La sécurité est la deuxième priorité. Pour éviter les inscriptions automatiques, l’application devra être dotée d’un CAPTCHA lors de la création de comptes. L’accès distant au système se fera via SSH avec des protocoles sécurisés pour protéger les données. 

Les droits d’accès doivent être bien différenciés selon le rôle de l’utilisateur entre les visiteurs, les utilisateurs inscrits, l’administrateur web et l’administrateur système.

Pour finir, l’application devra fournir des résultats de calcul fiables et offrir une gestion intuitive des utilisateurs. Les administrateurs doivent pouvoir facilement gérer les utilisateurs (ajouter ou supprimer) et consulter les journaux d’activités sans difficulté.

Ces contraintes visent donc à assurer une plateforme fonctionnelle, sécurisée et adaptée aux besoins des divers utilisateurs.

---

## IV. Pré-Requis : 

### A. Connaissances requises : ✅
Les utilisateurs auront besoin de certaines connaissances pour utiliser efficacement cette application.

Les visiteurs et les utilisateurs inscrits devront être à l’aise avec la navigation sur une plateforme web. Ils devront savoir effectuer des opérations simples comme la création de leur compte, la connexion à leur espace personnel et la saisie de données pour les modules de calculs.

Pour les utilisateurs inscrits, il sera nécessaire d'être familiarisé avec la gestion du profil dans le cas d’un changement de mot de passe ou encore une modification de données personnelles.

Du côté des administrateurs, des compétences techniques plus avancées sont requises. 

L’administrateur web devra être en mesure de gérer les comptes utilisateurs, manipuler les fichiers CSV pour importer les listes d’utilisateurs, et gérer l’ajout et la suppression des comptes.   

L’administrateur système devra posséder une bonne maîtrise des protocoles de sécurité et des accès SSH, ainsi qu’une capacité à analyser les journaux d’activités pour surveiller le fonctionnement de la plateforme et assurer sa sécurité.

Ces connaissances permettront à chaque catégorie d’utilisateur de profiter pleinement des fonctionnalités de cette application.

### B. Ressources matérielles et logicielles : ✅
Du côté des ressources matérielles, l’application sera déployée sur un Raspberry Pi 4, qui servira de serveur pour héberger l’application.

Le stockage sera assurée par une carte SD sur laquelle seront installés le système d’exploitation, le serveur web, la base de données, ainsi que les fichiers relatifs à l’application.

Du côté des ressources logicielles, pour un bon fonctionnement de l’application, le système d’exploitation installé sur le Raspberry Pi 4 sera un système Linux.

Le serveur web Apache sera utile pour héberger l’application PHP. L’application web nécessite notamment un serveur MySQL pour la gestion des bases de données utilisateurs et des historiques de calculs.

En terme de développement, le langage PHP permettra de créer des pages web dynamiques et d'interagir avec les bases de données. Les outils HTML, CSS et JavaScript serviront à la partie front-end pour l’interface utilisateur.

### C. Compétences nécessaires : ✅
Les compétences nécessaires pour utiliser cette application sont nombreuses et demandent une certaine familiarité avec les outils numériques.

Les utilisateurs devront tout d'abord savoir naviguer sur une plateforme web. Cela inclut la capacité à se déplacer entre les pages de l'application, telles que la page d'accueil, la page d'inscription et le tableau de bord, ainsi que remplir des formulaires en ligne, comme ceux pour la création de compte ou la modification de mot de passe.

Ensuite, pour utiliser les modules de calcul, les utilisateurs devront comprendre comment entrer des données, exécuter des calculs et consulter les résultats. Ils devront également savoir comment enregistrer leurs résultats dans un historique personnel, afin de pouvoir y accéder plus tard.

Enfin, les utilisateurs devront savoir gérer leur tableau de bord qui leur permet de voir l'historique de leurs calculs. Ils devront être capables de gérer ces résultats selon leurs besoins.

En somme, les compétences nécessaires pour utiliser l’application sont basées sur une utilisation courante d’internet et d’interface web, la gestion d’un compte utilisateur et la manipulation simple de modules de calcul pour effectuer des opérations et gérer ces résultats. 	


## V. Priorités : 

### A. Les priorités éventuelles du développement si elles ont été fixées avec l’accord du client :  ✅

Les priorités de développement ont été établies afin d’assurer une mise en œuvre de l’application correcte et cohérente, avec une progression par étapes entre les différents besoins identifiés par le client pour le bon fonctionnement de l’application.

Premièrement, il serait essentiel de sécuriser les accès à l'application et gérer les utilisateurs. Cela inclut la mise en place des différents types de comptes et droits d’accès, ainsi que l’ajout du CAPTCHA pour sécuriser les inscriptions et éviter les inscriptions indésirables (spam…).

Deuxièmement, le développement se concentrera sur l’implémentation des modules de calculs dans l’application. Ces modules devront être fonctionnels et simples à utiliser pour les utilisateurs inscrits, avec des calculs et des résultats fiables pour ne pas induire en erreurs les utilisateurs. De plus, ces résultats seront stockés dans un historique personnel pour chaque utilisateur.

Une fois des éléments mis en place, il faudra se concentrer sur la conception du tableau de bord des utilisateurs inscrits. Ce tableau de bord permettra à l’utilisateur d’accéder aux modules de calculs et à son historique personnel pour consulter ces opérations, favorisant donc une utilisation fluide et intuitive de l’application.

De plus, les fonctionnalités administratives devront être mises en place dans l'application permettant la gestion des comptes pour l’administrateur web, et l’organisation de l’accès à distance pour les administrateur système via SSH.

Cette progression permettra donc de mettre en place ces éléments prioritaires et essentiels pour garantir un bon fonctionnement de l’application, tout en intégrant progressivement les fonctionnalités.
