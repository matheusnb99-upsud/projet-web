Le ficher docs contient une documentation plus elaboré et il est separé en differents fichers.

# Ceci est un projet web pour mon s3

IUT d'Orsay
Dpt. Informatique
Projet tutoré S3 (Base de Données Avancées/Programmation Web)
Resp. du cours : Nicolas Férey

# Sujet: réseau social de démocratie participative

Le projet tutoré de S3 est un projet de mise en situation professionnelle, vous permettant de mettre en pratique tout ce que vous avez appris dans en S1, S2 et S3.

Le projet est partiellement encadré dans deux modules de S3 : le module de base de données avancée et le module de programmation web, avec deux rapports à rendre pour ces deux modules, en plus des codes que vous aurez à produire en BD et en PHP.

Vous effectuerez d'abord la conception et l'implémentation de la base de données, puis après avoir rendu le rapport correspondant, il s'agira de concevoir et d'implémenter le site web dynamique en PHP, connecté à la base de données.

Vous avez la responsabilité de mettre en place toute l'infrastructure et les outils de développement nécessaires à la bonne réalisation du projet, et vous pouvez demander l'aide du CCRI si besoin.

Le projet doit être effectué en binôme, et les membres du binôme doivent appartenir à un même TP.

## Description de la problématique

En 2020, ce sont les élections municipales, et l’heure est à la démocratie participative. Il vous
est donc demandé de réaliser une plateforme web pour qu’un groupe de citoyens, puisse faire
des propositions, les commenter, et s’exprimer par un « j’aime » ou un « j’aime pas » pour
savoir quelles propositions attirent l’adhésion de la majorité dans ce groupe

## Les utilisateurs

Tout le monde peut créer un groupe sur la plateforme web. Ensuite cette personne qui devient
l’administrateur du groupe y ajoute tous les membres du groupe concerné, sous forme d’une
liste d’adresses de courriel. Tous les membres du groupe peuvent alors proposer, commenter
et s’exprimer pour ou contre les propositions des autres membres du groupe. Ce site étant un
réseau social de démocratie participative, qui dit démocratie, dit transparence, tous les
membres du groupe doivent pouvoir être identifiés par son nom et son prénom.

## Les fonctionnalités de l’application

### Création d’un groupe

Arrivé sur le site, après avoir créé un compte, incluant login (courriel), un mot de passe, nom et
prénom, on peut créer un nouveau groupe. A la création d’un groupe, on donne simplement le
libellé de ce groupe, puis on invite les personnes qu’on souhaite voir rejoindre le groupe en
donnant la listes des courriels des membres du groupe. Ces personnes recevront un courriel
pour les inviter à rejoindre ce groupe sur le site en créant auparavant un compte. Tous les
courriels sont vérifiés par l’envoi d’un courriel contenant un lien de validation de son compte,
envoyé à chaque nouvel utilisateur du site.

### Créer des catégories dans un groupe pour classer les propositions

Dans le groupe, les propositions peuvent être classées dans différentes catégories.
L’administrateur du groupe doit donc pouvoir ajouter des catégories dans le groupe.

### Effectuer une nouvelle proposition

Chaque membre invité puis enregistré sur le site peut effectuer une proposition, avec une
description courte de quelques mots, et une description détaillée. Au moment de créer une
proposition, il lui est demandé de l’associer s’il le souhaite à une ou à deux catégories, primaire
et secondaire. Par défaut, tous les membres voient la totalité des votes pour et contre, et il n’y a
pas de limite de date au vote.
On peut aussi configurer une proposition comme pour un véritable vote : avec une date de
clôture du vote, avant laquelle personne ne peut voir le nombre de votants contre ou en faveur
de cette proposition. Il vous est demandé d’ajouter cette fonctionnalité afin de pouvoir configurer
une proposition avec une date de clôture, et éventuellement un vote fermé, afin que personne
ne puisse voir les résultats intermédiaires des votes avant la date de clôture. Vous utiliserez les
outils à disposition de votre SGBD pour automatiquement empêcher les votes et rendre visible
les résultats à la date de clôture du vote d’une proposition

### Consulter les propositions

Tous les membres peuvent consulter les propositions, les trier par catégorie ou par popularité.

### Commenter une proposition

Les membres peuvent commenter les propositions émises par les autres membres. Les auteurs
des commentaires apparaissent clairement.

### S’exprimer pour ou contre une proposition

Chaque membre du groupe peut voter en faveur ou contre une proposition, en cliquant sur une
icone « j’aime » ou « j’aime pas ».

### Signaler un commentaire ou une proposition

Les membres peuvent à tout moment signaler un commentaire ou une proposition qui lui
semble inappropriée. C’est l’administrateur qui reçoit ces signalements, et qui peut si c’est
nécessaire supprimer ce commentaire ou cette proposition, et exclure un membre.

### Autres fonctionnalités

Tout autre fonctionnalité qui vous semblera essentielle ou utile sera à ajouter dans votre projet.
Les données de l’application
Pour chaque membre on mémorise ses informations habituelles, nom, prénom, son courriel
constituant son login, et son mot de passe de manière sécurisée. Par ailleurs, toutes les
données concernant les propositions, les catégories, les groupes, les votes des membres, les
commentaires et les données associées à chaque proposition, doivent être enregistrées, et on
doit pouvoir avoir tout l’historique de l’activité du site, incluant les dates de création de groupe,
d’ajout de propositions...

### Les contraintes de l’application

Il est important de noter que les utilisateurs ne sont pas nécessairement familiers avec
l‘informatique. L’interface doit être pensée pour être la plus efficace possible, pour rapidement
effectuer toutes les fonctionnalités de l’application. De plus, l’application web doit être utilisable
sur n’importe quel terminal mobile comme sur ordinateur de bureau classique.
Vous devez fournir un code professionnel, modulaire, évolutif, et facilement maintenable, c’est
la raison pour laquelle il est demandé que vous suiviez une approche modèle-vue-contrôleur,
de la conception à l’implémentation. Ainsi, le modèle étant la base de données, il s’agira côté
programmation web de séparer tout ce qui est fonctionnel (requête dans les scripts php par
exemple) dans une couche contrôleur qui fera le lien avec ce qui relève de la présentation à
l’utilisateur dans la couche vue (vue, formulaire, css, aspect graphique et interactif).
Pour finir, l’accès à l’application pour chaque utilisateur devra être sécurisé par un login et un
mot de passe validés par mail au moment de l’ajout de chaque utilisateur.

### Pour aller plus loin

D’autre part, il est désormais possible qu’un site web soit aussi une application utilisable aussi
sur téléphone mobile sur toutes les plateformes en tant que véritable application, sans trop
modifier le code du site web. C’est ce qu’on appelle les Progressive Web App, PWA pour les
intimes. Nous vous invitons à vous informer et à vous former sur le fonctionnement de ce type
de nouvelle application web mobile
