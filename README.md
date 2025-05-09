<style>
        body {
            background-color: #f4f4f4;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
        }
        h1 {
            color:#4c11cb;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        strong {
            color: #2a5d9f;
            font-weight: bold;
        }

        strong {
            color: #2a5d9f;
            font-weight: bold;
        }

        code {
            background-color: #f4f4f4;
            color: #b30059;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
        }
        hr {
            width: 100%;
            height: 3px;
            background-color: purple;
            margin: 20px 0;
        }
</style>


# Projet : GreenDelivery - Tests unitaires et fonctionnels

## Contexte professionnel

Vous travaillez pour une startup qui développe une application nommée "GreenDelivery" permettant aux utilisateurs de calculer et de compenser l'empreinte carbone de leurs livraisons. L'entreprise souhaite garantir la fiabilité de son application, notamment pour les calculs d'émission de CO2 qui constituent le cœur de sa proposition de valeur.

Votre mission est de développer et tester une partie cruciale du système : le module de calcul d'empreinte carbone et le service de recommandation pour réduire l'impact environnemental des livraisons.

## Objectifs pédagogiques

- Concevoir et implémenter des tests unitaires pour vérifier le comportement des fonctions individuelles
- Développer des tests fonctionnels pour valider les interactions entre composants
- Comprendre l'importance des tests dans un projet professionnel
- Gérer les cas limites et exceptions

## Technologies autorisées

- JavaScript avec Jest
- PHP avec PHPUnit

## Fonctionnalités à développer et tester

### 1. Calculateur d'empreinte carbone

Développez une classe `CarbonCalculator` qui contient les méthodes suivantes :

- `calculateDeliveryEmission(distance, transportType, weight)` : calcule les émissions de CO2 en kg pour une livraison
- `getEmissionFactor(transportType)` : renvoie le facteur d'émission pour un type de transport donné
- `validateInputs(distance, weight)` : vérifie si les entrées sont valides


Le calcul doit tenir compte de la distance (en km), du poids (en kg) et du type de transport selon la formule :
```bash
émission = distance × facteur d'émission × (1 + (weight / 100))
```

### 2. Service de recommandation écologique

Développez une classe `GreenRecommendationService` qui contient les méthodes suivantes :

- `getSuggestedTransport(distance, weight, deadline)` : recommande le moyen de transport le plus écologique en fonction de la distance, du poids et du délai de livraison
- `calculateTimeEstimation(distance, transportType)` : estime le temps de livraison
- `isDeadlineFeasible(transportType, distance, deadline)` : vérifie si le délai est tenable avec un moyen de transport donné


#### Types de transport à prendre en compte pour le calcul des émissions 

Selon le type de transport, les émissions de CO2 par km sont les suivantes :

- Vélo : 0 g CO2/km
- Véhicule électrique : 20 g CO2/km
- Scooter : 70 g CO2/km
- Voiture essence : 120 g CO2/km
- Camionnette diesel : 180 g CO2/km
- Poids lourd : 220 g CO2/km


#### Vitesses moyennes de déplacement par type de transport

Pour vos calculs, utilisez les vitesses moyennes suivantes :

- Vélo : 15 km/h
- Véhicule électrique : 40 km/h
- Scooter : 30 km/h
- Voiture essence : 50 km/h
- Camionnette diesel : 45 km/h
- Poids lourd : 35 km/h

#### Limites de poids maximales par type de transport

Respectez les limites de poids suivantes pour chaque type de transport :

- Vélo : 10 kg maximum
- Véhicule électrique : 100 kg maximum
- Scooter : 20 kg maximum
- Voiture essence : 300 kg maximum
- Camionnette diesel : 800 kg maximum
- Poids lourd : 5000 kg maximum

## Livrables attendus

1. **Code source** des classes implémentant les fonctionnalités décrites
2. **Tests unitaires** couvrant :
   - Les calculs d'émission de CO2 (cas normaux et limites)
   - La validation des entrées
   - Les facteurs d'émission pour différents types de transport
   - Les recommandations de transport
   - Les estimations de temps

3. **Tests fonctionnels** pour :
   - Le flux complet de calcul et recommandation



## Critères d'évaluation

- **Qualité des tests** : pertinence, lisibilité, maintenabilité
- **Gestion des cas limites** : les tests couvrent des scénarios variés (valeurs négatives, nulles, extrêmes)
- **Respect des bonnes pratiques** : nommage clair, tests indépendants, utilisation de fixtures ou mocks si nécessaire
- **Fonctionnalités** : toutes les fonctionnalités demandées sont implémentées et correctement testées

## Exemples de tests attendus

### Tests unitaires

- Vérifier que le calcul d'émission fournit le bon résultat pour différentes combinaisons de distance, poids et transport
- Tester que la validation rejette correctement les valeurs négatives ou nulles
- Vérifier que les recommandations de transport sont cohérentes avec les contraintes fournies

### Tests fonctionnels

- Vérifier que le système de recommandation et de calcul d'émission fonctionnent correctement ensemble
- Tester que les données sont correctement traitées de bout en bout
- S'assurer que le calcul d'émission et les recommandations sont cohérents

## Conseils

- N'oubliez pas de tester les cas limites et les exceptions
- Organisez vos tests de manière logique et maintenable
- Documentez vos décisions de conception et les compromis effectués

## Ressources supplémentaires


- [Guide sur les bonnes pratiques de test](https://github.com/goldbergyoni/javascript-testing-best-practices/blob/master/readme-fr.md)

## Modalités de rendu

Le projet est à réaliser individuellement ou en binôme. Le code source doit être hébergé sur un dépôt Git (GitHub, GitLab).

- Ajoutez un fichier `README.md` à la racine de votre projet si besoin.# GreenDeliveryTestExercice
